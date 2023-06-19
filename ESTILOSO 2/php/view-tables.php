<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso : Database Viewing</title>
    <link rel="stylesheet" href="../css/view-tables.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="view-tables">
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
                            <a style="cursor: pointer;" id="defaultOpen" class="tablinks" onclick="switchcommon(event, 'main-1')" title="User Table">View-Users</a>
                        </span>
                        <span class="mini-nav">
                            <a style="cursor: pointer;" class="tablinks" onclick="switchcommon(event, 'main-2')" title="Item Table">View-Items</a>
                        </span>
                        <span class="mini-nav">
                            <a style="cursor: pointer;" class="tablinks" onclick="switchcommon(event, 'main-3')" title="Orders Table">Orders-Table</a>
                        </span>
                    </div>
                </nav>
            </article>

        </section>

        <section class="main tabcontent" id="main-1">
            <div class="title">
                <h1>View Users Table</h1>
            </div>

            <div class="content">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `users` WHERE 1";

                $result = mysqli_query($conn, $sql);
                ?>
                <table>
                    <thead>
                        <th><u>User ID</u></th>
                        <th><u>Full Name</u></th>
                        <th><u>Email</u></th>
                        <th><u>Password</u></th>
                        <th><u>Username</u></th>
                        <th><u>Gender</u></th>
                        <th><u>Role</u></th>
                        <th><u>update</u></th>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $rows['user_id']; ?></td>
                                <td><?php echo $rows['fullname']; ?></td>
                                <td><?php echo $rows['email']; ?></td>
                                <td><?php echo $rows['password']; ?></td>
                                <td><?php echo $rows['username']; ?></td>
                                <td><?php echo $rows['gender']; ?></td>
                                <td><?php echo $rows['role']; ?></td>
                                <td>
                                    <form action="update.php" method="POST" id="udpdate">
                                        <input type="hidden" name="update_id" value="<?php echo $rows['user_id']; ?>">
                                        <input type="submit" value="Update User Info" name="update_user">
                                    </form>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </section>

        <section class="main tabcontent" id="main-2">
            <div class="title">
                <h1>View Users Table</h1>
            </div>

            <div class="content">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `product` WHERE 1";

                $result = mysqli_query($conn, $sql);
                ?>
                <table>
                    <thead>
                        <th><u>Product Name</u></th>
                        <th><u>Product Description</u></th>
                        <th><u>Product Image</u></th>
                        <th><u>Unit Price</u></th>
                        <th><u>Available Quantity</u></th>
                        <th><u>Category</u></th>
                        <th><u>Sub-Category</u></th>
                        <th><u>update</u></th>
                    </thead>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $rows['product_name']; ?></td>
                                <td><?php echo $rows['product_description']; ?></td>
                                <td style="width: 10%;"><img style="width: 100%;" src="../php-processes/uploads/<?php echo $rows['product_image']; ?>" alt=""></td>
                                <td><?php echo $rows['unit_price']; ?></td>
                                <td><?php echo $rows['available_quantity']; ?></td>
                                <td><?php echo $rows['category_name']; ?></td>
                                <td><?php echo $rows['sub_category_name']; ?></td>
                                <td>
                                    <form action="update.php" method="POST" id="udpdate">
                                        <input type="hidden" name="update_id" value="<?php echo $rows['product_id']; ?>">
                                        <input type="submit" value="Update Product" name="update_item">
                                    </form>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </section>

        <section class="main tabcontent" id="main-3">
            <div class="title">
                <h1>Orders Table</h1>
            </div>

            <div class="content">
                <?php
                require('../php-processes/connect.php');

                $sql = "SELECT * FROM `product` WHERE 1";

                $result = mysqli_query($conn, $sql);
                ?>
                <table border=3px class="table">
                    <thead>
                        <th scope="col">ORDER ID</th>
                        <th scope="col"> Shipping and Payment ID</th>
                        <th scope="col">Cart ID</th>
                        <th scope="col">Grand Totals</th>
                        <th scope="col">Username</th>
                    </thead>
                    <tbody>
                        <?php include "fetchorders.php";  ?>
                        <?php if ($result->num_rows > 0) : ?>
                            <?php while ($array = mysqli_fetch_row($result)) : ?>

                                <tr>
                                    <th scope="row"> <?php echo $array[0]; ?> </th>
                                    <th><?php echo $array[1]; ?></th>
                                    <th><?php echo $array[2]; ?></th>
                                    <th><?php echo "Kshs ".$array[3]; ?></th>
                                    <th><?php echo $array[4]; ?></th>
                                </tr>

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
        </section>

    </div>

    <script>
        function switchcommon(evt, mainName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(mainName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</body>

</html>