<?php
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    if (isset($_POST['first'])){
        $firstname = $_POST['first'];
        $lastname = $_POST['last'];
        $email = $_POST['email'];
        $password = password_hash($_POST['pass'],PASSWORD_DEFAULT);
        $role = $_POST['role'];
        var_dump($firstname);
        $query = $pdo->prepare("INSERT INTO users(firstname,lastname,password,email,role,created_at) VALUES(:firstname,:lastname,:password,:email,:role,NOW()");
        //if the query used was valid
        if ($query) {
            //bind the parameters to the previous query
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':password', $password);
            $query->bindParam(':email', $email);
            $query->bindParam(':role', $role);
            //execute the query
            if ($query->execute()){
                echo "success";
            }
            else{
                echo "failure";
            }
        }
        else{
            echo "Error";
        }   
    }
?>