<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=mainDB","root",'');
}
catch (PDOException $e){
    echo $e;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $postUser = "INSERT INTO users (login, pass) VALUES ('$login', '$password');";
        $conn->exec($postUser);  
    }
    catch(Exception $err){
        echo json_encode(false);
    } finally {
        if(!(isset($err))){
            echo json_encode(true);
        }
    }
    
}



?>