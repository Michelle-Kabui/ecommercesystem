<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso - Sub-Categories</title>
    <link rel="stylesheet" href="../css/general-forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="product-data">
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
                </nav>
            </article>

        </section>

        <?php
        if (isset($_POST['update_user'])) { ?>

            <section class="main users">

                <?php
                if (@$_GET['Warning'] == true) { ?>
                    <div class="alert">
                        <h2><?php echo $_GET['Warning'] ?></h2>
                    </div>
                <?php } ?>

                <form action="../php-processes/data-manipulation-processes.php" method="post" id="users">
                    <?php

                    require("../php-processes/connect.php");

                    $update_id = $_POST['update_id'];

                    $sql_default = "SELECT * FROM `users` WHERE user_id = '$update_id'";

                    $update_item = mysqli_query($conn, $sql_default);

                    $row = mysqli_fetch_array($update_item);
                    // while ($row = mysqli_fetch_array($update_item)) {
                    ?>
                    <fieldset>

                        <div class="form-name">
                            <label>Edit User Details</label>
                            <input type="hidden" name="user_id" value="<?php echo $update_id; ?>">
                        </div>
                        <div class="field">
                            <label>Change Email :</label>
                            <input type="text" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                        <div class="field">
                            <label>Change Password :</label>
                            <input type="text" name="password" value="<?php echo $row['password']; ?>">
                        </div>
                        <div class="field">
                            <label>Change Username :</label>
                            <input type="text" name="username" value="<?php echo $row['username']; ?>">
                        </div>
                        <div class="field">
                            <label>Change Role :</label>
                            <input type="text" name="role" value="<?php echo $row['role']; ?>">
                        </div>

                        <input type="submit" name="update_users" value="Change Details" form="users">

                    </fieldset>
                </form>

            </section>

        <?php
        } elseif (isset($_POST['update_item'])) { ?>

            <section class="main items">

                <?php
                if (@$_GET['Warning'] == true) { ?>
                    <div class="alert">
                        <h2><?php echo $_GET['Warning'] ?></h2>
                    </div>
                <?php } ?>

                <form action="../php-processes/data-manipulation-processes.php" method="post" id="update-items">
                    <?php

                    require("../php-processes/connect.php");

                    $update_id = $_POST['update_id'];

                    $sql_default = "SELECT * FROM `product` WHERE product_id = '$update_id'";

                    $update_item = mysqli_query($conn, $sql_default);

                    $row = mysqli_fetch_array($update_item);

                    $sql1 = "SELECT * FROM categories";
                    $all_ctgr = mysqli_query($conn, $sql1);

                    $sql2 = "SELECT * FROM subcategories";
                    $all_subctgr = mysqli_query($conn, $sql2);

                    ?>
                    <fieldset>
                        <div class="form-name">
                            <label>Update Product Form</label>
                            <input type="hidden" name="product_id" value="<?php echo $update_id; ?>">
                        </div>
                        <div class="field">
                            <label>Change Category Name :</label>
                            <select name="category_name" id="category_name"><br>
                                <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                                <?php
                                while ($category = mysqli_fetch_assoc($all_ctgr)) :;
                                ?>
                                    <option value="<?php echo $category["category_name"]; ?>">
                                        <?php
                                        echo $category["category_name"];
                                        ?>

                                    </option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="field">
                            <label>Change Sub-Category Name :</label>
                            <select name="sub_category_name" id="sub_category_name"><br>
                                <option value="<?php echo $row['sub_category_name']; ?>"><?php echo $row['sub_category_name']; ?></option>
                                <?php
                                while ($subcategory = mysqli_fetch_assoc($all_subctgr)) :;
                                ?>
                                    <option value="<?php echo $subcategory["sub_category_name"]; ?>">
                                        <?php
                                        echo $subcategory["sub_category_name"];
                                        ?>

                                    </option>
                                <?php
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="field">
                            <label>Change Product Name :</label>
                            <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>">
                        </div>
                        <div class="field">
                            <label>Change Product Descripton :</label>
                            <input type="text" name="product_description" value="<?php echo $row['product_description']; ?>">
                        </div>
                        
                        <div class="field">
                            <label>Change Unit Price :</label>
                            <input type="text" name="unit_price" value="<?php echo $row['unit_price']; ?>">
                        </div>
                        <div class="field">
                            <label>Change Availabe Quantity :</label>
                            <input type="text" name="available_quantity" value="<?php echo $row['available_quantity']; ?>">
                        </div>
                        <!-- <div class="field">
                            <label>Edited at :</label>
                            <input type="datetime-local" name="edited_at" required>
                        </div> -->
                        <input type="submit" name="update_items" value="Change Details" form="update-items">
                    </fieldset>
                </form>

            </section>

        <?php }
        ?>


    </div>
</body>

</html>