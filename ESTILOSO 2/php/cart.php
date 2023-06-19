<?php
session_start();

require('../php-processes/connect.php');

if (isset($_POST['update_btn'])) {
    $update_value = $_POST['update_quantity'];
    // $update_total_item_price = $_POST['total_item_price'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value'  WHERE product_id = '$update_id'");
    if ($update_quantity_query) {
        header('location:cart.php');
    };
} elseif (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE item_ID = '$remove_id'");
    header('location:cart.php');
} elseif (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso : My Cart</title>
    <link rel="stylesheet" href="../css/view-tables.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="cart view-tables">

        <section class="header">

            <div class="header-inner">
                <div class="logo">
                    <a href="index.php">
                        <img src="../resources/estiloso-logo.png" alt="estiloso-logo" class="image">
                    </a>
                </div>

                <div class="title">
                    <a href="index.php">
                        <h1>ESTILOSO</h1>
                    </a>
                </div>

            </div>

            <article class="navigation">
                <nav>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <a href="admin-navigation.php" title="<?php echo $_SESSION['username']; ?>">
                            <span class="material-icons md-36">person</span>
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


        <section class="main">
            <div class="title">
                <h1>My Cart</h1>
            </div>

            <div class="content">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `cart` WHERE `username` = '{$_SESSION['username']}'";

                $result = mysqli_query($conn, $sql);
                ?>
                <table>
                    <thead>
                        <th><u>Product Name</u></th>
                        <th><u>Product Image</u></th>
                        <th><u>Unit Price</u></th>
                        <th><u>Number Of Items</u></th>
                        <th><u>Total Item Price</u></th>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $rows['product_name']; ?></td>

                                <td style="width: 10%;"><img style="width: 100%;" src="../php-processes/uploads/<?php echo $rows['product_image']; ?>" alt=""></td>
                                <td><?php echo "Kshs ".$rows['unit_price']; ?></td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $rows['product_id']; ?>">
                                        <input type="text" name="update_quantity" min="1" value="<?php echo $rows['quantity']; ?>">
                                        <input type="submit" value="update" name="update_btn">
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    $item_total = number_format($rows['unit_price'] * $rows['quantity']);
                                    echo "Kshs " . $item_total;
                                    ?>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
                <div class="cart-summary">
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
                </div>
                <div class="button">
                    <a href="checkout.php" title="Fill in more details that are unavailable">Proceed to Shipping</a>
                </div>
            </div>
        </section>
    </div>
</body>