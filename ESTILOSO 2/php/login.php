<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso - Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="login">
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
                    <span class="material-icons md-36">person</span>
                    <a href="register.php">Register Instead</a>
                </nav>
            </article>

        </section>
        <section class="main">

            <?php
            if (@$_GET['Warning'] == true) { ?>
                <div class="alert">
                    <h2><?php echo $_GET['Warning'] ?></h2>
                </div>
            <?php } ?>

            <form action="../php-processes/login-register-process.php" method="post" id="login">
                <fieldset>
                    <div class="form-name">
                        <label>Login Page</label>
                    </div>
                    <div class="field">
                        <label for="username">Username :</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="field">
                        <label for="password">Password :</label>
                        <input type="text" name="password" required>
                        <span class="material-icons md-24">lock</span>
                    </div>
                    <input type="submit" name="login" value="Login Now" form="login">

                </fieldset>
            </form>

        </section>
    </div>
</body>

</html>