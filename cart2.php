<?php
session_start();
$status = "";

if (isset($_POST['action']) && $_POST['action'] == "remove") {
    if (!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["code"] == $key) {
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='box' style='color:red;'>Product is removed from your cart!</div>";
            }
            if (empty($_SESSION["shopping_cart"])) {
                unset($_SESSION["shopping_cart"]);
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["shopping_cart"] as &$value) {
        if ($value['code'] === $_POST["code"]) {
            $value['quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <title>Demo Shopping Cart - AllPHPTricks.com</title>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <div style="width:700px; margin:120 auto;">
        <div class="cart">
            <?php
            if (isset($_SESSION["shopping_cart"])) {
                $total_price = 0;
                ?>
                <table class="table bg-light">
                    <tbody>
                        <tr class='bg-light'>
                            <td></td>
                            <td>ITEM NAME</td>
                            <td>QUANTITY</td>
                            <td>UNIT PRICE</td>
                            <td>ITEMS TOTAL</td>
                        </tr>
                        <?php
                        foreach ($_SESSION["shopping_cart"] as $product) {
                            ?>
                            <tr>
                                <td><img src='files/<?php echo $product["image"]; ?>' width="80" height="60" /></td>
                                <td><?php echo $product["name"]; ?><br />
                                    <form method='post' action=''>
                                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                        <input type='hidden' name='action' value="remove" />
                                        <button type='submit'
                                            class='remove border-1 text-white bg-danger'>Remove Item</button>
                                    </form>
                                </td>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                        <input type='hidden' name='action' value="change" />
                                        <select name='quantity' class='quantity' onchange="this.form.submit()">
                                            <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo "<option " . ($product["quantity"] == $i ? "selected" : "") . " value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </td>
                                <td><?php echo "Rs." . $product["price"]; ?></td>
                                <td><?php echo "Rs." . $product["price"] * $product["quantity"]; ?></td>
                            </tr>
                        <?php
                        $total_price += ($product["price"] * $product["quantity"]);
                    }
                    ?>
                        <tr>
                            <td colspan="5" align="right">
                                <strong>TOTAL: <?php echo "rs" . $total_price; ?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<h3>Your cart is empty!</h3>";
            }
            ?>
        </div>
        <div style="clear:both;"></div>
        <div class="message_box" style="margin:10px 0px;">
            <?php echo $status; ?>
        </div>
        <form action="" method="post">
            <button type="submit" name="upload">Checkout</button>
        </form>
        <br /><br />
        <?php
        if (isset($_POST['upload'])) {
            if (empty($_SESSION['username'])) {
                header("location:form.php");
            } elseif (empty($_SESSION['shopping_cart'])) {
                echo "Your cart is empty";
            } else {
                header("location:bill.php");
            }
        }
        ?>
    </div>
</body>

</html>
