<?php
    session_start();
     $id = $_SESSION['id'];

    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    $email = $_POST['email'];

    $query = $pdo->prepare("UPDATE contacts SET assigned_to=:id, updated_at=NOW() WHERE email=:email");

    $query->bindParam(':id', $id);
    $query->bindParam(':email', $email);


    if ($query->execute()){
        echo "success";
    }
    else{
        echo "failure";
    }
?>