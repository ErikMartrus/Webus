<?php
require __DIR__ . '/lib/PayPalDemo.php';
$app = new PayPalDemo();
if (!empty($_POST['btnAddProduct'])) {
    $product_id = $_POST['product_id'];
    $product = $app->get_product_details($product_id);
}
if (isset($_GET['status']) && $_GET['status'] == FALSE) {
    $message = 'Your payment transaction failed!';
}
if (isset($_POST['submit'])) {
    foreach ($_POST['cantidad'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['cantidad'] = $val;
        }
    }
}
$cart = (!empty($_SESSION['cart']) ? $_SESSION['cart'] : []);
$total = (!empty($_SESSION['cart']) ? $app->_get_sum() : 0);
$i = 0;
$posicion = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Práctica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/stylesPayPal.css">
</head>
<body>


<div class="container">


    <div class="row">
        <div class="col-md-12">
            <h2>
                Shopping Cart
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">

            <?php
            if (isset($message) && $message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $message . '</div>';
            }
            ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        My Cart ("set quantity to 0 to delete an item")
                    </h3>
                </div>
                <div class="panel-body">
                    <?php if (count($cart) > 0) { ?>
                    <form method="post" action="shopping-cart.php">
                        <table class="table table-striped table-bordered table-responsive">
                            <tr>
                                <th>Name.</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM productos WHERE id IN (";
                            foreach ($_SESSION['cart'] as $id => $value) {
                                $sql .= $id . ",";
                            }
                            $totalprice = 0;
                            $sql = substr($sql, 0, -1) . ") ORDER BY nombre ASC";
                            if ($query = mysqli_query($con,$sql)) {
                            while ($row = mysqli_fetch_array($query)) {
                                $subtotal = $_SESSION['cart'][$row['id']]['cantidad'] * $row['precio'];
                                $product_id=$row['id'];
                                $totalprice += $subtotal;
                                if ( $_SESSION['cart'][$row['id']]['cantidad']>= $_SESSION['cart'][$row['id']]['stock']){
                                    $_SESSION['cart'][$row['id']]['cantidad']= $_SESSION['cart'][$row['id']]['stock'];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td><input type="number" name="cantidad[<?php echo $row['id'] ?>]" size="5" min="0" max="<?php echo $_SESSION['cart'][$row['id']]['stock'] ?>"
                                               value="<?php echo $_SESSION['cart'][$row['id']]['cantidad'] ?>"/></td>
                                    <td><?php echo $_SESSION['cart'][$row['id']]['cantidad'] * $row['precio'] ?></td>
                                </tr>
                                <?php
                                $posicion = $posicion + 1;
                            } ?>
                            <tr>
                                <td align="right"><b>Total</b></td>
                                <td colspan="4" align="right">
                                    <span class="price"><?php echo $totalprice ?> USD</span>
                                </td>
                            </tr>
                        </table>
                        <?php }
                        } else { ?>
                            <div class="form-group">
                                <p>Your shopping cart is empty you don't have selected any of the product to purchase <a
                                            href="products.php">click here</a> to add products. </p>
                            </div>
                        <?php } ?>

                        <a class="btn btn-success" href="products.php"> Continue Shopping</a>
                        <input class="btn btn-success" type="submit" name="submit" value="Actualizar Cantidades">
                    </form>
                    <?php
                    if (isset($_SESSION["user"])) {
                        ?>
                        <div class="pull-right"><?php (count($cart) > 0 ? require 'pay-with-paypal.php' : '') ?></div>
                    <?php } ?>
                </div>
            </div>
            <?php if (count($cart) > 0) { ?>
                <h3>
                    Cuenta de prueba
                </h3>
                <p>
                    Email: <b>sb-4ahl43603521@personal.example.com</b>
                </p>
                <p>
                    Password: <b>ventana123</b>
                </p>
            <?php } ?>
        </div>

    </div>
</div>

</body>
</html>