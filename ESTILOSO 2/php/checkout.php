<?php
session_start();

require('../php-processes/connect.php');

if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $username = $_SESSION['username'];
    $address = $_POST['address'];   
    $city = $_POST['city'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];

    $sql = "INSERT INTO `shipping_and_payment_info`(`fullname`, `username`, `address`, `city`, `card_name`, `credit_card_number`, `expiry_month`, `expiry_year`, `cvv`) 
    VALUES ('$fullname','$username','$address','$city','$cardname','$cardnumber','$expiry_month','$expiry_year','$cvv')";

    if (mysqli_query($conn, $sql)) {
        // echo '<script>alert("")</script>';
        header("location:checkout.php?Warning= Shipping address and payment method added succesfully <div><a href='order.php'>Proceed To Orders</a></div>");
        echo "";
    } else {
        echo '<script>alert("There is an Error' . mysqli_error($conn) . ' ")</script>';
        // include('main-menu.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTILOSO - Checkout Procedure</title>
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="checkout">
        <section class="header">
            <div class="header-inner">
                <div class="logo">
                    <img src="../resources/estiloso-logo.png" alt="estiloso-logo" class="image">
                </div>

                <div class="title">
                    <h1>ESTILOSO</h1>
                </div>
            </div>
            <article class="navigation">
                <nav>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <a href="admin-navigation.php" title="<?php echo $_SESSION['username']; ?>">
                            <span><i class="fa fa-user"></i></span>
                        </a>
                    <?php } else { ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php } ?>
                    <div>
                        <span class="mini-nav">
                            <a href="">Settings</a>
                        </span>
                        <span class="mini-nav">
                            <a href="">Notifications</a>
                        </span>
                        <span class="mini-nav">
                            <a href="cart.php">My Cart</a>
                        </span>
                    </div>
                </nav>
            </article>
        </section>
        <?php
        if (@$_GET['Warning'] == true) { ?>
            <div class="alert">
                <h2><?php echo $_GET['Warning'] ?></h2>
            </div>
        <?php } ?>
        <section class="main row">

            <article class="billing-address col-75">
                <div class="form-container">
                    <form action="" method="post">

                        <div class="row inner-1">
                            <div class="billing-info col-50">
                                <h3>Billing Address</h3>

                                <div class="field">
                                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Name">
                                </div>

                                <div class="field">
                                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                    <input type="text" id="adr" name="address" placeholder="Address">
                                </div>

                                <div class="field">
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city" placeholder="City">
                                </div>


                                <h4>Modes of Payment</h4>
                                <span class="field"><label for="card"><i class="fa fa-money-bill	"></i>Cash </label></span>
                                <span class="field"><label for="card"><i class="fa fa-mobile-alt	"></i>Mobile Banking</label></span>
                                <span class="field"><label for="card"><i class="fa fa-credit-card	"></i>Cards</label></span>

                            </div>

                            <div class="col-50">
                                <h3>Card Payment Details </h3>

                                <div class="field">
                                    <label for="cname"><i class="fa fa-credit-card	"></i> Name on Card</label>
                                    <input type="text" id="cname" name="cardname" placeholder="Card name">
                                </div>

                                <div class="field">
                                    <label for="ccnum">Credit card number</label>
                                    <input type="text" id="ccnum" name="cardnumber" placeholder="Credit card cardnumber">
                                </div>

                                <div class="field">
                                    <label for="expmonth">Exp Month</label>
                                    <input type="text" id="expmonth" name="expiry_month" placeholder="Month">
                                </div>

                                <div class="row inner-2">
                                    <div class="col-50">
                                        <label for="expyear">Exp Year</label>
                                        <input type="text" id="expyear" name="expiry_year" placeholder="Expire year">
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="CVV">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <label>
                            <input type="checkbox" checked="checked" name=""> Shipping address same as billing
                        </label>
                        <input type="submit" name="submit" value="Place Your Order" class="btn">
                    </form>
                </div>
            </article>

            <article class="cart col-25">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `cart` WHERE `username` = '{$_SESSION['username']}'";

                $result = mysqli_query($conn, $sql);
                ?>
                <div class="cart-container">
                    <h4>Cart
                        <span class="price" style="color:black">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                    </h4>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_array($result)) {
                    ?>
                            <div class="sub-totals">
                                <a href=""><?php echo $rows['product_name']; ?></a>
                                <span class="price"><?php echo "Kshs " . $rows['unit_price']; ?></span>
                            </div>
                    <?php }
                    } ?>
                    <hr>
                    <?php
                    require('../php-processes/connect.php');

                    $sql = "SELECT  SUM(total_product) from `cart` WHERE `username` = '{$_SESSION['username']}'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) != 0) {
                    ?>
                        <div class="sub-totals">Total
                            <span class="price" style="color:black">
                                <b>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "Kshs " . $row['SUM(total_product)'];
                                    }
                                    ?>
                                </b>
                            </span>
                        </div>
                    <?php
                    } else {
                        echo "<h3>No Point of Totals; Your Cart is Empty!</h3>";
                    } ?>
                </div>
            </article>

        </section>
    </div>
</body>

</html>