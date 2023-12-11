<?php
   ini_set("error_reporting", E_ALL);
   $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
   
   if (!$pdo) {
       die("Connection failed");
   }

   session_start();
   $id = $_SESSION['id'];
   
   if (isset($_GET['mail'])){
    $email = $_GET['mail'];
   }

   $query = $pdo->prepare("SELECT id, firstname, lastname, email, title, telephone, type, company, assigned_to, created_by, DATE_FORMAT(created_at, '%m-%d-%Y') AS formatted_date, DATE_FORMAT(updated_at, '%m-%d-%Y') AS updated_date FROM contacts where email = :email");

   $query->bindParam(':email', $email);

   if ($query->execute()){
   
      if ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
           $person = array(
                'id' => $rows['id'],
               'company' => $rows['company'],
               'title' => $rows['title'],
               'name' => $rows['firstname'] . " " . $rows['lastname'],
               'email' => $rows['email'],
               'type' => $rows['type'],
               'creater' => $rows['created_by'],
               'created' => $rows['formatted_date'],
               'updated' => $rows['updated_date'],
               'tele' => $rows['telephone'],
               'assign' => $rows['assigned_to']
           );
       }
   }

   $upperquery = $pdo->prepare("SELECT firstname, lastname FROM users where id = :id");

   $upperquery->bindParam(':id', $person['creater']);

   if ($upperquery->execute()){
   
      if ($rows = $upperquery->fetch(PDO::FETCH_ASSOC)) {
           $manager = array(
               'name' => $rows['firstname'] . " " . $rows['lastname'],
           );
       }
   }

   $lowerquery = $pdo->prepare("SELECT firstname, lastname FROM users where id = :id");

   $lowerquery->bindParam(':id', $person['assign']);

   if ($lowerquery->execute()){
   
      if ($rows = $lowerquery->fetch(PDO::FETCH_ASSOC)) {
           $assign = array(
               'name' => $rows['firstname'] . " " . $rows['lastname'],
           );
       }
   }

   $noteQuery = $pdo->prepare("SELECT created_by, comment, created_at FROM notes WHERE contact_id=:contact_id");
   
   $noteQuery->bindParam(':contact_id', $person['id']);
   
   $notes = array();

    if ($noteQuery->execute()) {
        $resultNotes = $noteQuery->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultNotes as $note) {
            $noteData = array(
                'createdBy' => '', 
                'comment' => $note['comment'],
                'createdAt' => DateTime::createFromFormat('Y-m-d H:i:s', $note['created_at']),
            );

            $userQuery = $pdo->prepare("SELECT firstname, lastname FROM users WHERE id = :userId");
            $userQuery->bindParam(':userId', $note['created_by']);

            if ($userQuery->execute()) {
                $user = $userQuery->fetch(PDO::FETCH_ASSOC);
                $noteData['createdBy'] = $user['firstname'] . ' ' . $user['lastname'];
            }

            $notes[] = $noteData;
        }
    }

   $dateTimeUpdated = DateTime::createFromFormat('m-d-Y', $person['updated']);

   if ($dateTimeUpdated !== false) {
       $person['updated'] = $dateTimeUpdated->format('F j, Y');
   } 
   
   $dateTimeCreated = DateTime::createFromFormat('m-d-Y', $person['created']);
   
   if ($dateTimeCreated !== false) {
       $person['created'] = $dateTimeCreated->format('F j, Y');
   } 
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="css/details.css">
</head>
<div id="toppings">
    <div id="Profile">
        <img src="img/user.svg" alt="Profile Picture" id="profilemg">
        <div>
            <h1><?=$person['title']?> <?=$person['name']?></h1>
            <p>Created on <?=$person['created']?> by <?=$manager['name']?></p>
            <p>Updated on <?=$person['updated']?></p>
        </div>
    </div>
    
    <div id="buttons">
        <button id="assign" onclick="assignMe(event)">Assign to me</button>
        <button id="switch" onclick="switchMe(event)">Switch to <?php echo (strpos($person['type'], "Support") !== false) ? "Sales Lead" : "Support"; ?></button>
    </div>
</div>

<div id="info">
    <div class="organ">
        <h4>Email</h4>
        <p id="emailer"><?=$person['email']?></p>
    </div>
    <div class="organ">
        <h4>
            Telephone
        </h4>
        <p><?=$person['tele']?></p>
    </div>
    <div class="organ">
        <h4>Company</h4>
        <p><?=$person['company']?></p>
    </div>
    <div class="organ">
        <h4>Assigned To</h4>
        <p><?=$assign['name']?></p>
    </div>  
</div>

<div id="notes">
    <h3>Notes</h3>
    <?php foreach ($notes as $note): ?>
        <div id="noted">
            <div class="grouping">
                <h4><?= $note['createdBy'] ?></h4>
                <p><?= $note['comment'] ?></p>
                <p class="date"><?= $note['createdAt']->format('F j, Y \a\t g:ia') ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <div id="noteAdder">
        <h4>Add a note about <?=$person['name']?></h4>
        <textarea type="text" id="text-box" >Add Details Here</textarea>
        <button id="addNote" onclick="notePress(event)">Add Note</button>
    </div>
</div>

</html>