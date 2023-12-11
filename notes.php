<?php
    session_start();
     $id = $_SESSION['id'];
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }

    if (isset($_POST['note'])){
        $comment = htmlspecialchars($_POST['note']);
        $email = $_POST['email'];
    }

    $getContactIdQuery = $pdo->prepare("SELECT id FROM contacts WHERE email = :email");
    $getContactIdQuery->bindParam(':email', $email);
    if ($getContactIdQuery->execute()) {
        $contactId = $getContactIdQuery->fetchColumn();
    }
    else{
        echo "FailAtEmail";
    }
    
    $query = $pdo->prepare("INSERT INTO notes (contact_id, comment, created_by, created_at) VALUES(:id,:comment,:created_by,NOW())");

    $query->bindParam(':id', $contactId);
    $query->bindParam(':comment', $comment);
    $query->bindParam(':created_by', $id);

    if ($query->execute()){
        $updateContactQuery = $pdo->prepare("UPDATE contacts SET updated_at = NOW() WHERE id = :id");
        $updateContactQuery->bindParam(':id', $contactId);
        if ($updateContactQuery->execute()){
            echo "success";
        }
        else{
            echo "failure";
        }
    }

    
?>