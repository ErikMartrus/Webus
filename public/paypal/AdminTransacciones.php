<?php
require __DIR__ . '/lib/PayPalDemo.php';
if (empty($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}
$app = new PayPalDemo();
if (isset($_GET['status']) && $_GET['status'] == TRUE) {
    $message = 'Your payment transaction has been successfully completed.';
}
$user = $app->getUserDetails($_SESSION['user']);
$orders = $app->getAllTransferencias();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesPayPal.css">

</head>
<body>
<?php require 'navigation.php'; ?>

<div class="container">


    <div class="row">
        <div class="col-md-12">
            <h2>
                Transactions
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8" style="width: auto">
            <?php if (isset($_GET["transaccion_id"])) {
                $id = $_GET["transaccion_id"];
                $sql = "SELECT * FROM factura WHERE id='$id'";
                if ($result = mysqli_query($con, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaccion_id = $row["id"];
                        foreach ($app->getTransferenciaItems($id) as $orden) {
                            ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?php echo "Transaccion id: " . $id; ?>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Orden id</th>
                                            <th>Transacción id</th>
                                            <th>Cliente</th>
                                            <th>payer id</th>
                                            <th>payer email</th>
                                            <th>Estado</th>
                                            <th>Action</th>
                                        </tr>

                                            <tr>
                                                <td>
                                                    <?php echo $orden['orden_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $orden['id_transaccion']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $orden['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $orden['payer_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $orden['payer_email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $orden['estado']; ?>
                                                </td>
                                                <td>
                                                    <a href="AdminOrdenes.php?orden_id=<?php echo $orden["orden_id"] ?>">
                                                        <button class="btn btn-primary">Ver Orden</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                    <h4>
                                        Total = <?php foreach ($orders as $order) {
                                            if ($order["id"] == $id) {
                                                echo $order["total"] . " USD";
                                            }
                                        }
                                        ?>
                                    </h4>
                                </div>
                            </div>
                        <?php
                    }
                }
            } else { ?>


                <?php if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        ?>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Transaction @ <?php echo $order['fecha'] ?>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Orden id</th>
                                        <th>Transacción id</th>
                                        <th>Cliente</th>
                                        <th>payer id</th>
                                        <th>payer email</th>
                                        <th>Estado</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php foreach ($app->getTransferenciaItems($order['id']) as $item) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $item['orden_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $item['id_transaccion']; ?>
                                            </td>
                                            <td>
                                                <?php echo $item['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $item['payer_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $item['payer_email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $item['estado']; ?>
                                            </td>
                                            <td>
                                                <a href="AdminOrdenes.php?orden_id=<?php echo $item["orden_id"] ?>">
                                                    <button class="btn btn-primary">Ver Orden</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <h4>
                                    Total: <?php echo $order['total'] . " " . $order['moneda']; ?>
                                </h4>

                            </div>
                        </div>

                    <?php }
                } else { ?>
                    <p>
                        You don't have any orders yet, visit <a href="products.php">Products</a> to order.
                    </p>
                <?php }
            }?>

        </div>
    </div>
</div>

</body>
</html>