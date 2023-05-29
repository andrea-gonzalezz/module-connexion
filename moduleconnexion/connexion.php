<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if (isset($_POST['formconnexion'])) {
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $passwordconnect = htmlspecialchars($_POST['passwordconnect']);
    if (!empty($loginconnect) && !empty($passwordconnect)) {
        $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $requser->execute(array($loginconnect, $passwordconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['password'] = $userinfo['password'];
           
            header("Location: profil.php?id=".$_SESSION['id']);
           
        } 
        else 
        {
            $erreur = "Wrong login or password!";
        }
    } else {
        $erreur = "All fields must be completed!";
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container" align="center">
        <h2>Login</h2>
        <br /><br />
        <form method="POST" action="">
            <input type="text" name="loginconnect" placeholder="your login">
            <br>
            <input type="password" name="passwordconnect" placeholder="password">
            <br> 
            <br>   
            <button type="submit" name="formconnexion" value="Login">LOGIN</button>

        </form>
        <?php
        if(isset($erreur))
        {
            echo '<br><font color="red">'.$erreur."</font>";
        }

        ?>
    
    </div>
   
    
</body>
</html>