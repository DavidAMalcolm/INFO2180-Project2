<?php
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm", "root", "");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    $email = $_POST['email'];


    $getCurrentType = $pdo->prepare("SELECT type FROM contacts WHERE email = :email");
    $getCurrentType->bindParam(':email', $email);

    if ($getCurrentType->execute()) {
        $currentType = $getCurrentType->fetchColumn();


        $newType = ($currentType == 'Support') ? 'Sales Lead' : 'Support';


        $query = $pdo->prepare("UPDATE contacts SET type = :newType, updated_at = NOW() WHERE email = :email");
        $query->bindParam(':newType', $newType);
        $query->bindParam(':email', $email);

        if ($query->execute()) {
            echo "success";
        } else {
            echo "failure";
        }
    } else {
        echo "failure";
    }
?>