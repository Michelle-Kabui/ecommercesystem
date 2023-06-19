<?php
session_start();
require('../php-processes/connect.php');
if (isset($_SESSION['username'])) :
    $sql = "SELECT * FROM `shipping_and_payment_info` WHERE username='" . $_SESSION['username'] . "' ";
else :
    echo 'YOU ARE NOT LOGGED IN';
endif;

$result = mysqli_query($conn, $sql);

$rows2 = mysqli_fetch_array($result);

if (isset($_POST['place_order'])) {

    if (!empty($_SESSION['username'])) {

        require('../php-processes/connect.php');
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`WHERE `username` = '{$_SESSION['username']}'");
        $grand_total = 0;
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

                $username = $_SESSION['username'];
                $cart_ID = $fetch_cart['cart_ID'];
                $SPI_id = $rows2['SPI_id'];
                $grand_total = $_POST['grand_total'];

                $sql = "INSERT INTO `orders`( `username`, `cart_id`,`SPI_id`, `grand_total`) VALUES ('$username','$cart_ID','$SPI_id','$grand_total')";
                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("Order placed succesfully")</script>';
                    header("location:cart.php");
                } else {
                    echo '<script>alert("There is an Error' . mysqli_error($conn) . ' ")</script>';
                    // include('main-menu.php');
                }
            }
        }
    } else {
        // header('location:../html/login-register.php?Invalid= Kindly-Login-First');
        echo '<script>alert("Kindly Login First to access cart")</script>';
        // header("location:main-menu.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTILOSO</title>
    <link rel="stylesheet" href="../css/view-tables.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="index">

        <section class="header">

            <div class="header-inner">
                <div class="logo">
                    <img src="../resources/estiloso-logo.png" alt="estiloso-logo" class="image">
                </div>

                <div class="title">
                    <h1>ESTILOSO</h1>
                </div>
            </div>

            <?php if (isset($_SESSION['username'])) : ?>
                <div class="username">
                    <p><?php echo $_SESSION['username']; ?>'s Order Info</p>
                </div>
            <?php endif ?>
        </section>
        <hr>
        <section class="main">
            <form action="" method="POST">
                <article class="main-1">
                    <div class="address-wrapper">
                        <div>
                            <h1>My Shipping Details</h1>
                        </div>

                        <table border=3px class="table">
                            <thead>
                                <th scope="col">Fullname</th>
                                <th scope="col">Username</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result) > 0) :
                                    while ($rows = mysqli_fetch_array($result)) : ?>
                                        <tr>
                                            <th><?php echo $rows[1]; ?></th>
                                            <th><?php echo $rows[2]; ?></th>
                                            <th><?php echo $rows[3]; ?></th>
                                            <th><?php echo $rows[4]; ?></th>
                                        </tr>

                                    <?php endwhile; ?>
                                <?php else : ?>

                                    <tr>
                                        <td colspan="7" rowspan="1" headers="">No Data</td>
                                    </tr>

                                <?php endif; ?>
                                <?php mysqli_free_result($result); ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="paying-info">
                        <span class="field">
                            <?php
                            require('../php-processes/connect.php');

                            $sql = "SELECT  SUM(total_product) from `cart` WHERE `username` = '{$_SESSION['username']}'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) != 0) {
                            ?>
                                <h3>Sub-Total :</h3>
                                <div class="sub-total">
                                    <h4><?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "Kshs " . $row['SUM(total_product)'];
                                        }
                                        ?>
                                    </h4>
                                </div>

                            <?php
                            } else {
                                echo "<h3>No Point of Totals; Your Cart is Empty!</h3>";
                            } ?>
                        </span>
                        <span class="field">
                            <h3>Shipping Fees :</h3>
                            <h4>Kshs 3028</h4>
                        </span>
                        <span class="field">
                            <h3>Grand-Total :</h3>
                            <?php
                            require('../php-processes/connect.php');

                            $sql = "SELECT  SUM(total_product) from `cart` WHERE `username` = '{$_SESSION['username']}'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) != 0) {
                            ?>

                                <h4><?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        $sub_total = $row['SUM(total_product)'];
                                    }
                                    $grand_total = $sub_total + 3028;
                                    echo "Kshs " . $grand_total;
                                    ?>
                                </h4>
                                <div class="info">
                                    <!-- hiiden input over here -->
                                    <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                                </div>
                            <?php } ?>
                        </span>
                        <div class="submitting"><input type="submit" name="place_order" value="Submit Order to Pay"></div>
                    </div>
                </article>

                <article class="order-content">
                    <div class="order-wrapper">
                        <div>
                            <h1>MY ORDERS</h1>
                        </div>

                        <table border=3px class="table">
                            <thead>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Product Price</th>
                            </thead>
                            <tbody>
                                <?php

                                require('../php-processes/connect.php');
                                if (isset($_SESSION['username'])) :
                                    $sql = "SELECT * FROM `cart` WHERE `username` = '{$_SESSION['username']}'";
                                else :
                                    echo 'YOU ARE NOT LOGGED IN';
                                endif;
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) :
                                    while ($rows = mysqli_fetch_array($result)) : ?>
                                        <tr>
                                            <th><?php echo $rows['product_name']; ?></th>
                                            <td style="width: 10%;"><img style="width: 100%;" src="../php-processes/uploads/<?php echo $rows['product_image']; ?>" alt=""></td>
                                            <th><?php echo $rows['unit_price']; ?></th>
                                            <th><?php echo $rows['quantity']; ?></th>
                                            <th><?php echo $rows['total_product']; ?></th>
                                        </tr>
                                        <!-- hiiden input over here -->
                                        <input type="hidden" name="cart_id" value="<?php echo $rows['cart_ID']; ?>">
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" rowspan="1" headers="">No Data</td>
                                    </tr>
                                <?php endif; ?>
                                <?php mysqli_free_result($result); ?>
                            </tbody>
                        </table>
                    </div>
                </article>
            </form>
        </section>
    </div>
</body>

</html>