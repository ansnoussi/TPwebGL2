<?php
session_start();
require_once('_header.php');
?>
    <div class="container">
        <div class="alert alert-primary" role="alert">
            Welcome To Our first Project In PHP:
            <?php
            if(isset($_SESSION['user'])) {
                echo $_SESSION['user']['name'];
            } else {
                echo 'User innexistant';
            }                
            ?>
        </div>
        <a class="nav-link" href="logout.php">Logout</a>
    </div>
<?php
require_once('_footer.php');
?>
