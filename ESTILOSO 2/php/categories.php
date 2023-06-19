<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso - Categories</title>
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

        <section class="main">

            <article class="action-list">

                <div class="action">
                    <a href="categories.php">
                        <span>
                            <p>Create</p>
                            <h2>Category</h2>
                        </span>
                    </a>
                </div>

                <div class="action">
                    <a href="sub-categories.php">
                        <span>
                            <p>Create</p>
                            <h2>Sub-Category</h2>
                        </span>
                    </a>
                </div>

                <div class="action">
                    <a href="product-item.php">
                        <span>
                            <p>Create</p>
                            <h2>Item</h2>
                        </span>
                    </a>
                </div>

            </article>

            <?php
            if (@$_GET['Warning'] == true) { ?>
                <div class="alert">
                    <h2><?php echo $_GET['Warning'] ?></h2>
                </div>
            <?php } ?>

            <form action="../php-processes/data-manipulation-processes.php" method="post" id="categories">
                <fieldset>
                    <div class="form-name">
                        <label>Categories Form</label>
                    </div>
                    <div class="field">
                        <label for="full_name">Category Name :</label>
                        <input type="text" name="category_name" required>
                    </div>
                    <input type="submit" name="categories" value="Submit Category" form="categories">
                </fieldset>
            </form>

        </section>
    </div>
</body>

</html>