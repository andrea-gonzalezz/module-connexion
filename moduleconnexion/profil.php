<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
    <div align="center">
        <h2>My profile</h2>
        <br /><br />
        <p>Welcome back <?php echo $userinfo['login'] ?> ! </p>
        <?php
        if(isset($erreur))
        {
            echo '<br><font color="red">'.$erreur."</font>";
        }

        ?>
        <br /><br />
        <div class="links">
        <a  href="editprofil.php">Edit my profile</a>
        <br /><br />
        <a href="deconnexion.php">Logout</a>
        <br><br>
        <a href="admin.php">Admin</a>
    </div>
    
    </div>
   
    
</body>
</html>
<?php

}

?>