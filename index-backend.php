<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=mainDB","root",'');
}
catch (PDOException $e){
    echo $e;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $content = json_decode(file_get_contents("php://input"));

    $user = $content->user;
    $tasks = $content->tasks;

    $login = $user->login;
    $password = $user->password;
    var_dump($tasks);
    $tasks = json_encode($tasks);
    var_dump("<br>");
    var_dump($tasks);
    $checkDB = "SELECT * FROM users WHERE pass = '$password' AND login = '$login';";
    $answer = $conn->query($checkDB);
    $row = $answer->fetch();

    if($row == false){
        echo json_encode($row);
    } else {
        $updateTasks = "UPDATE users SET tasks = '$tasks' WHERE login = '$login'";
        $conn->query($updateTasks);
    }
    
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
        echo $row["tasks"];
    }
}
?>