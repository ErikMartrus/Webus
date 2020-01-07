<?php

/**
 * Verify transaction is authentic
 *
 * @param array $data Post data from Paypal
 * @return bool True if the transaction is verified by PayPal
 * @throws Exception
 */
function verifyTransaction($data) {
	global $paypalUrl;

	$req = 'cmd=_notify-validate';
	foreach ($data as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
		$req .= "&$key=$value";
	}

	$ch = curl_init($paypalUrl);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	$res = curl_exec($ch);

	if (!$res) {
		$errno = curl_errno($ch);
		$errstr = curl_error($ch);
		curl_close($ch);
		throw new Exception("cURL error: [$errno] $errstr");
	}

	$info = curl_getinfo($ch);

	// Check the http response
	$httpCode = $info['http_code'];
	if ($httpCode != 200) {
		throw new Exception("PayPal responded with http code $httpCode");
	}

	curl_close($ch);

	return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid) {
	global $db;

	$txnid = $db->real_escape_string($txnid);
	$results = $db->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

	return ! $results->num_rows;
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data) {
	global $db;

	if (is_array($data)) {
		$stmt = $db->prepare('INSERT INTO `payments` (txnid, payment_amount, estado, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
		$stmt->bind_param(
			'sdsss',
			$data['txn_id'],
			$data['payment_amount'],
			$data['estado'],
			$data['item_number'],
			date('Y-m-d H:i:s')
		);
		$stmt->execute();
		$stmt->close();

		return $db->insert_id;
	}

	return false;
}

function addPaymentToDatabse($data) {
    insertPaymentToOrdersTable($data);
}

function insertPaymentToOrdersTable($data)
{
    $host = "localhost";
    $database = "laboratorio";
    $user = "root";
    $databasePassword = "";

    // 1 Stablishing connection to Database
    $connection = mysqli_connect($host, $user, $databasePassword, $database);

    // 2. Managing errors

    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }

    $idCliente = $data["userID"];
    $transaccion = $data["tx"];
    $total = $data["amt"];
    $fecha = $data["fecha"];
    $estado = $data["st"];

    $sql = "INSERT INTO orden (id_cliente, transaccion, total, fecha, estado)
                VALUES ('$idCliente', '$transaccion', '$total', '$fecha', '$estado')";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";

        $sql = "SELECT * FROM orden WHERE transaccion='$transaccion'";

        $idOrden = "";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $idOrden = $row["id"];
            }
        }

        insertPaymentToOrdersDetailsTable($data, $idOrden);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
    mysqli_close($connection);
}

function insertPaymentToOrdersDetailsTable($data, $idOrden)
{
    $host = "localhost";
    $database = "laboratorio";
    $user = "root";
    $databasePassword = "";

    $connection = mysqli_connect($host, $user, $databasePassword, $database);

    foreach ($_SESSION['carrito'] as $key => $valor) {
        $idProducto = $key;
        $cantidadProducto = $valor;

        $sql = "INSERT INTO detalleorden (id_orden, id_producto, cantidad)
                VALUES ('$idOrden', '$idProducto', '$cantidadProducto')";

        if (mysqli_query($connection, $sql)) {

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }

    mysqli_close($connection);

    unset($_SESSION["carrito"]);

    $_SESSION["compraExitosa"] = 1;

    header('Location: ../carrito.php');
    exit;
}