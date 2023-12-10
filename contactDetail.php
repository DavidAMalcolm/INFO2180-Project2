<?php
   ini_set("error_reporting", E_ALL);
   $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
   
   if (!$pdo) {
       die("Connection failed");
   }
   
   if (isset($_GET['mail'])){
    $email = $_GET['mail'];
   }

   $query = $pdo->prepare("SELECT firstname, lastname, email, title, telephone, type, company, assigned_to, created_by, DATE_FORMAT(created_at, '%m-%d-%Y') AS formatted_date, DATE_FORMAT(updated_at, '%m-%d-%Y') AS updated_date FROM contacts where email = :email");

   $query->bindParam(':email', $email);

   if ($query->execute()){
   
      if ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
           $person = array(
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


   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="details.css">
</head>
<div id="toppings">
    <div id="Profile">
        <img src="user.svg" alt="Profile Picture" id="profilemg">
        <div>
            <h1><?=$person['title']?> <?=$person['name']?></h1>
            <p>Created on <?=$person['created']?> by <?=$manager['name']?></p>
            <p>Updated on <?=$person['updated']?></p>
        </div>
    </div>
    
    <div id="buttons">
        <button id="assign">Assign to me</button>
        <button id="switch">Switch to <?=$person['type']?></button>
    </div>
</div>

<div id="info">
    <div class="organ">
        <h4>Email</h4>
        <p><?=$person['email']?></p>
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
    <div id="noted">
        <div class="grouping">
            <h4>Jane Doe</h4>
            <p>lroeaojgnson fasp ofaosjfo asoij foajfoij aojoasjof asjfo a aosj ojaofj oasjfo sjaofjsaodfjosajfoasjfo a fo as ofjaso?</p>
            <p class="date">November 4, 2022 at 4pm</p>
        </div>
    </div>
    <div id="noteAdder">
        <h4>Add a note about <?=$rows['firstname']?></h4>
        <textarea type="text" id="text-box" >Add Details Here</textarea>
        <button id="addNote">Add Note</button>
    </div>
</div>

</html>