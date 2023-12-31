<?php
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        
        $query = $pdo->prepare("SELECT password, role, id FROM users WHERE email = :username");
        //if the query used was valid
        if ($query) {
            //bind the username to the previous query
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            //execute the query
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            
            $storedPassword = $result['password'];
            $role = $result['role'];
            $id = $result['id'];
            
            if (password_verify($password,$storedPassword)){
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['id'] = $id;
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