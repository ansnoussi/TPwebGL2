<?php
session_start();
if(isset($_SESSION['user'])){
session_destroy();
session_write_close();
}
header('Location: index.php');
?>
