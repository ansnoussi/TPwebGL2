<?php
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $options = [
        'cost' => 12,
    ];
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    require_once('db_connection.php');
    $query = "INSERT INTO users (name, email, password) VALUES('$fullName', '$email', '$userPassword')";
    try {
        $conn->exec($query);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: register.php');
    }
    $conn = null;
    header('Location: login.php');
} else {
    header('Location: register.php');
}

