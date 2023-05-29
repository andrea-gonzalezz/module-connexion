<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
</head>
<body>

    <ul>

    <?php while($u = $utilisateurs -> fetch()) { ?>

        <li><?= $u['id'] ?> : <?= $u['login']  ?> : <?= $u['firstname']  ?> : <?= $u['lastname']  ?> : <?= $u['password']  ?> </li>
        <?php } ?>



    </ul>
    
</body>
</html>