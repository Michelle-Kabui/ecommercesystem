<?php session_start();

require('../php-processes/connect.php');

if (isset($_POST['cart_btn'])) {

    if (!empty($_SESSION['username'])) {

        $username = $_SESSION['username'];
        $product_id = $_POST['product_id'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $unit_price = $_POST['unit_price'];
        $quantity = 1;

        $sql = "INSERT INTO `cart`(`username`, `product_id`, `product_image`, `product_name`, `unit_price`, `quantity`) 
        VALUES ('$username','$product_id','$product_image','$product_name','$unit_price','$quantity')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Product Added to cart succesfully")</script>';
            header("location:main-menu.php");
        } else {
            echo '<script>alert("There is an Error' . mysqli_error($conn) . ' ")</script>';
            // include('main-menu.php');
        }

    } else {

        echo '<script>alert("Kindly Login First to access cart")</script>';
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTILOSO : Main-Menu</title>
    <link rel="stylesheet" href="../css/main-menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>

    <div class="main-menu">
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
            <div class="item-display">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `product` WHERE 1";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <form action="" method="POST" id="menu-item">
                        <article class="item">
                            <a href="" title="product info" class="core-item">
                                <div class="item-image">
                                    <img src="../php-processes/uploads/<?php echo $row['product_image']; ?>" alt="">
                                </div>
                                <div class="item-info">
                                    <h3 class="name"><?php echo $row['product_name']; ?></h3>
                                </div>
                                <div class="pricing">
                                    <span class="new-price"><?php echo "Kshs " . $row['unit_price']; ?></span>
                                </div>
                                <div class="item-input">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                    <input type="hidden" name="unit_price" value="<?php echo $row['unit_price']; ?>">
                                </div>
                            </a>
                            <footer class="cart-btn">
                                <input type="submit" class="btn-cart" value="Add To Cart" name="cart_btn">
                            </footer>
                        </article>
                    </form>
                <?php }
                mysqli_close($conn);
                ?>
            </div>
        </section>
    </div>

</body>

</html>