<?php
    session_start();
     $role = $_SESSION['role'];
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    $query = $pdo->prepare("SELECT firstname, lastname, email, title, type, company FROM contacts");

    if ($query->execute()){
        $people = array();
    
        while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
            $person = array(
                'company' => $rows['company'],
                'title' => $rows['title'],
                'name' => $rows['firstname'] . " " . $rows['lastname'],
                'email' => $rows['email'],
                'type' => $rows['type'],
            );

            $people[] = $person;
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dash.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
</head>
<body>
    <div id="heading">
        <h1>Dashboard</h1>
        <button id="contact">Add Contact</button>
    </div>
        <div id="contraband">
            <div id="selection">
                <p>Filter By: </p>
                <button class="sorting">All</button>
                <button class="sorting">Sales Lead</button>
                <button class="sorting">Support</button>
                <button class="sorting">Assigned to me</button>
            </div>
            <table id="userList">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($people as $person):?>
                        <tr>
                            <td><?=$person['title'] . " " . $person["name"]?></td>
                            <td><?=$person['email']?></td>
                            <td><?=$person['company']?></td>
                            <td><?=$person['type']?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>
