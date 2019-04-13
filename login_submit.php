<?php
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $options = [
        'cost' => 12,
    ];
    $email = $_POST['email'];
    $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
    require_once('db_connection.php');
    $stmt = $conn->prepare("SELECT * FROM users WHERE `email`=:email LIMIT 1");
    try {
        $stmt->execute([':email' => $email ]);
    } catch (PDOException $e) {
        echo( "Connection failed: " . $e->getMessage() );
        header('Location: login.php');
    }
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    foreach($stmt->fetchAll() as $item){
    if(password_verify($_POST['password'], $item['password'])){
    session_start();
    $_SESSION['user'] = [
        'name' => $item['name'],
        'email' => $item['email'],
        'connection_time' => time()
        ];
    header('Location: index.php');
    exit(200);
    $conn = null; 
    }else{
    die("password_verify didn't work");
    header('Location: login.php');
    }
    }
}

