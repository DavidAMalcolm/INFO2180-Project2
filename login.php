<?php
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    if (isset($_POST['username'])){
        $username = isset($_POST['username']) ? $mysqli->real_escape_string($_POST['username']) : '';
        $password = $_POST['password'];
        
        $query = $pdo->prepare("SELECT password FROM dorm WHERE username = :username");
        //if the query used was valid
        if ($query) {
            //bind the username to the previous query
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            //execute the query
            $query->execute();
            $storedPassword = $query->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password,$storedPassword)){
                session_start();
                $_SESSION['user'] = $username;
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