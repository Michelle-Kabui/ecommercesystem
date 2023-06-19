<?php

require('../php-processes/connect.php');
if (isset($_SESSION['username'])) :
$sql = "SELECT * FROM orders WHERE username='".$_SESSION['username']."'";
else:
    echo 'YOU ARE NOT LOGGED IN';
endif;
$result = mysqli_query($conn, $sql);

?>
