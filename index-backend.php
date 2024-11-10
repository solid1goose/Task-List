<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=mainDB","root",'');
}
catch (PDOException $e){
    echo $e;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $postUser = "INSERT INTO users (login, pass) VALUES ('$login', '$password');";
    $conn->exec($postUser);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $login = $_GET['login'];
    $password = $_GET['password'];
    $checkDB = "SELECT * FROM users WHERE pass = '$password' AND login = '$login';";
    $answer = $conn->query($checkDB);
    $row = $answer->fetch();
    
    if($row == false){
        echo json_encode($row);
    } else {
        echo json_encode(true);
    }
}
?>