
<?php @session_start();

if(empty($_SESSION['is_logged_in'])) {
    header('location:login.php');
    exit();
}
?>


<?php

require_once 'app/index.php';
