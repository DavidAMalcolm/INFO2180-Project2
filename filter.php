<?php
    session_start();
    $id = $_SESSION['id'];
    ini_set("error_reporting", E_ALL);

    $pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");
    
    if (!$pdo) {
        die("Connection failed");
    }

    $selectedType = isset($_GET['type']) ? $_GET['type'] : 'all';
    if($selectedType=="assigned"){
        $query = $pdo->prepare("SELECT firstname, lastname, email, title, type, company FROM contacts WHERE assigned_to = :assignedType");
        $query->bindParam(':assignedType', $id);
    }
    else if($selectedType=="all"){
        $query = $pdo->prepare("SELECT firstname, lastname, email, title, type, company FROM contacts");
    }
    else{
        $query = $pdo->prepare("SELECT firstname, lastname, email, title, type, company FROM contacts WHERE type = :selectedType");
        $query->bindParam(':selectedType', $selectedType);
    }

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

        foreach ($people as $person) {
            echo "<tr>
                    <td>{$person['title']} {$person['name']}</td>
                    <td>{$person['email']}</td>
                    <td>{$person['company']}</td>
                    <td class='" . (strpos($person['type'], 'Support') !== false ? 'support' : 'sales') . "'>{$person['type']}</td>
                    <td><a href=# class='views' data-custom-value='{$person['email']}' onclick='detailView(event)'>View</a></td>
                </tr>";
        }
    }
?>