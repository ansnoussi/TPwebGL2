<?php
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $options = [
        'cost' => 12,
    ];
    $email = $_POST['email'];
    $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    require_once('db_connection.php');
    $stmt = $conn->prepare("SELECT * FROM users WHERE `email`=:email AND `password`=:password LIMIT 1");
    try {
        $stmt->execute([':email' => $email, ':password' => $userPassword]);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: login.php');
    }
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if (count($stmt->fetchAll()) > 0) {
        header('Location: index.php');
        exit(200);
    }
    $conn = null;
}
header('Location: login.php');