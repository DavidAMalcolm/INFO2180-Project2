<?php
ini_set("error_reporting", E_ALL);
$pdo = new PDO("mysql:host=localhost;dbname=dolphin_crm","root","");

if (!$pdo) {
    die("Connection failed");
}

$query = $pdo->prepare("SELECT firstname, lastname, id FROM users");

if ($query->execute()){
    $people = array();

    while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
        $person = array(
            'id' => $rows['id'],
            'name' => $rows['firstname'] . " " . $rows['lastname'],
        );

        $people[] = $person;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="contact.css">
    <script src="add.js"></script>
</head>
        <h1>New Contact</h1>
        <form action="register.php" method="POST" id="addForm">
            <div class="together">
                <label for="title">Title</label>
                <select name="titles" id="title">
                    <option value="Mr">
                        Mr
                    </option>
                    <option value="Ms">
                        Ms
                    </option>
                    <option value="Mrs">
                        Mrs
                    </option>
                </select>
            </div>
            <div class="together">
                <label for="first">First Name</label>
                <input type="text" placeholder="Jane" id="first" name="firstname" require>
            </div>
            <div class="together">
                <label for="last">Last Name</label>
                <input type="text" placeholder="Doe" id="last" name="lastname" require>
            </div>
            <div class="together">
                <label for="mail">Email</label>
                <input type="text" placeholder="something@example.com" id="mail" name="email" require>
            </div>
            <div class="together">
                <label for="number">Telephone</label>
                <input type="tel" id="number" name="tele" require>
            </div>
            <div class="together">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" require>
            </div>
            <div class="together">
                <label for="job">Type</label>
                <select name="jobs" id="job">
                    <option value="Sales Lead">
                        Sales Lead
                    </option>
                    <option value="Support">
                        Support
                    </option>
                </select>
            </div>
            <div class="together">
                <label for="assign">Assigned To</label>
                <select name="assigned" id="assign">
                    <?php foreach ($people as $person):?>
                        <option value="<?=$person['id']?>">
                            <?=$person['name']?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="submit" value="Save" id="sub" onclick="contactAdd(event)">
        </form>
</html>