<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTILOSO</title>
    <link rel="stylesheet" href="../css/index.css">
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

            <article class="navigation">
                <nav>
                    <a href="#">New stock </a>
                    <a href="#">Men </a>
                    <a href="#">Women</a>
                    <a href="#">Kids </a>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <!-- once you make your main menu that displays products change the below link to that page -->
                        <a href="main-menu.php" title="<?php echo $_SESSION['username']; ?>">
                            <span class="material-icons md-36">person</span>
                            <?php echo $_SESSION['username'];?>
                        </a>
                    <?php } else { ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php } ?>

                    <form action="" method="POST">
                        <input type="text" name="search" placeholder="Search..">
                    </form>
                </nav>
            </article>

        </section>


        <section class="main">

            <article class="main-1">

                <div class="content c1">
                    <h3>"Where Passion Meets Fashion"</h3>
                </div>
                <br>
                <div class="content c2">
                    <h4>"We believe in bringing confidence to people using fashion at affordable prices and all styles"
                    </h4>
                </div>
                <br>
                <div class="content c3">
                    <h4>Want to turn heads by how you dress? Look Unique?</h4>
                </div>
                <br>
                <div class="button-1">
                    <a href="">Shop With Us Now</a>
                </div>
            </article>

            <article class="main-2">

                <div class="sample s1">
                    <img src="../resources/men.png" alt="">
                    <div class="info">
                        <h5 class="man">Sharp as always.</h5>
                    </div>
                </div>

                <div class="sample s2">
                    <img src="../resources/children.png" alt="">
                    <div class="info">
                        <h5 class="kids">Don't forget the kids.</h5>
                    </div>
                </div>

                <div class="sample s3">
                    <img src="../resources/women.png" alt="">
                    <div class="info">
                        <h5 class="lady">It's all in the details.</h5>
                    </div>
                </div>

            </article>

            <article class="mini">
                <div class="new-title">
                    <h4> Winter Is Here!</h4>
                    <h5> Current Trends!</h5>
                </div>
            </article>

            <article class="main-3">

                <div class="sample s1">
                    <img src="../resources/marvins.png" alt="">
                    <div class="info">
                        <h5 class="beanie">Brave the cold!</h5>
                    </div>
                </div>
                <!-- <br>
                <div>
                    <h4 class="word">Season's</h4>
                </div> -->
                <br>
                <div class="sample s2">
                    <img src="../resources/scarves.png" alt="">
                    <div class="info">
                        <h5 class="scarf">Ready for winter?</h5>
                    </div>
                </div>
                <!-- <br>
                <div>
                    <h4 class="word2">Best </h4>
                </div> -->
                <br>
                <div class="sample s3">
                    <img src="../resources/coats.png" alt="">
                    <div class="info">
                        <h5 class="coat">Warm and classy.</h5>
                    </div>
                </div>

            </article>

        </section>


        <section class="footer">

            <article class="links">
                <div><a href="#">Terms and Conditions</a></div>
                <br>
                <div><a href="#">My account</a></div>
                <br>
            </article>

            <article class="contacts">
                <div class="more-info">
                    <span>
                        For more information: Call:0716636272<br>
                        Email: estil-oso.gmail.com<br>
                    </span>
                </div>
                <div class="socials">
                    <span>Facebook: Estil fashions</span>
                    <span>Instagram: Estil.fashion</span>
                </div>
            </article>

        </section>
    </div>
</body>

</html>