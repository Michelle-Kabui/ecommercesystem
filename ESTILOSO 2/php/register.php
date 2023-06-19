<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estiloso - Register</title>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../resources/estiloso-logo.png">
</head>

<body>
    <div class="register">
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
                    <a href="login.php">Login Instead</a>
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

            <form action="../php-processes/login-register-process.php" method="post" id="register">
                <fieldset>
                    <div class="form-name">
                        <label>Registration Form</label>
                    </div>
                    <div class="field">
                        <label for="full_name">Full Name :</label>
                        <input type="text" name="full_name" required>
                    </div>
                    <div class="field">
                        <label for="email">Email :</label>
                        <input type="text" name="email" required>
                        <span class="material-icons md-24">mail</span>
                    </div>
                    <div class="field">
                        <label for="password">Password :</label>
                        <input type="password" name="password" required>
                        <span class="material-icons md-24">lock</span>
                    </div>
                    <div class="field">
                        <label for="username">Username :</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="field">
                        <label for="gender">Gender :</label>
                        <input type="text" name="gender" required>
                    </div>
                    <input type="submit" name="register" value="Register Now" form="register">
                </fieldset>
            </form>

        </section>
    </div>
</body>

</html>