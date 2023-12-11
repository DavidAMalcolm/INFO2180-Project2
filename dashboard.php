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
    <link rel="stylesheet" href="css/dash.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
    <script src="js/dash.js"></script>
</head>
<body>
    <div id="heading">
        <h1>Dashboard</h1>
        <button id="contact" onclick="addContact(event)">Add Contact</button>
    </div>
        <div id="contraband">
            <div id="selection">
                <p>Filter By: </p>
                <button class="sorting select" onclick="filterTable(event)" data-type="all">All</button>
                <button class="sorting" onclick="filterTable(event)" data-type="Sales Lead">Sales Lead</button>
                <button class="sorting" onclick="filterTable(event)" data-type="support">Support</button>
                <button class="sorting" onclick="filterTable(event)" data-type="assigned">Assigned to me</button>
            </div>
            <table id="userList">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($people as $person):?>
                        <tr>
                            <td><?=$person['title'] . " " . $person["name"]?></td>
                            <td><?=$person['email']?></td>
                            <td><?=$person['company']?></td>
                            <td class="<?php echo (strpos($person['type'], 'Support') !== false) ? 'support' : 'sales'; ?>"><?=$person['type']?></td>
                            <td><a href=# class="views" data-custom-value="<?=$person['email']?>" onclick="detailView(event)">View</a></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </body>
</html>
