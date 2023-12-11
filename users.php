<?php
    session_start();
     $role = $_SESSION['role'];
    ini_set("error_reporting", E_ALL);
    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }
    
    $query = $pdo->prepare("SELECT firstname, lastname, email, role, created_at FROM users");

    if ($query->execute()){
        $people = array();
    
        while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
            $person = array(
                'role' => $rows['role'],
                'name' => $rows['firstname'] . " " . $rows['lastname'],
                'email' => $rows['email'],
                'created_at' => $rows['created_at'],
            );

            $people[] = $person;
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/users.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <?php if(strpos($role, "Admin") !== false):?>
        <h1>Users</h1>
        <div id="contraband">
        <table id="userList">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($people as $person):?>
                    <tr>
                        <td><?=$person['role']?></td>
                        <td><?=$person['name']?></td>
                        <td><?=$person['email']?></td>
                        <td><?=$person['created_at']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php else:?>
            <script>alert("Need Admin Priveledges to View Users");</script>
        <?php endif;?>
    </div>
</body>
</html>
