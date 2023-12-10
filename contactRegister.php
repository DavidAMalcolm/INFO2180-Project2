<?php
    session_start();
    $id = $_SESSION['id'];
    ini_set("error_reporting", E_ALL);

    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    if (isset($_POST['first'], $_POST['last'], $_POST['email'], $_POST['tele'], $_POST['company'], $_POST['jobs'], $_POST['titles'], $_POST['assigned'])){
        $firstname = trim($_POST['first']);
        $lastname = trim($_POST['last']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $telephone = trim($_POST['tele']);
        $company = trim($_POST['company']);
        $job = trim($_POST['jobs']);
        $title = trim($_POST['titles']);
        $assigner = trim($_POST['assigned']);


        $query = $pdo->prepare("INSERT INTO contacts(title,firstname,lastname,email,telephone,company,type,assigned_to, created_by, created_at, updated_at) VALUES(:title,:firstname,:lastname,:email,:telephone,:company, :type, :assigned_to, :created_by, NOW(), NOW())");
        //if the query used was valid
        if ($query) {

            //bind the parameters to the previous query
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':lastname', $lastname);
            $query->bindParam(':email', $email);
            $query->bindParam(':telephone', $telephone);
            $query->bindParam(':company', $company);
            $query->bindParam(':type', $job);
            $query->bindParam(':assigned_to', $assigner);
            $query->bindParam(':created_by', $id);
            $query->bindParam(':title', $title);

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
    else{
        echo "Failure";
    }
?>