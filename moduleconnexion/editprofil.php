<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if (isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if (isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $user['login']) {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array($newlogin, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
        
    }

    if (isset($_POST['newfirstname']) && !empty($_POST['newfirstname']) && $_POST['newfirstname'] != $user['firstname']) {
        $newfirstname = htmlspecialchars($_POST['newfirstname']);
        $insertfirstname = $bdd->prepare("UPDATE utilisateurs SET firstname = ? WHERE id = ?");
        $insertfirstname->execute(array($newfirstname, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
        
    }

    if (isset($_POST['newlastname']) && !empty($_POST['newlastname']) && $_POST['newlastname'] != $user['lastname']) {
        $newlastname = htmlspecialchars($_POST['newlastname']);
        $insertnewlastname = $bdd->prepare("UPDATE utilisateurs SET lastname = ? WHERE id = ?");
        $insertnewlastname->execute(array($newlastname, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
        
    }

    if (isset($_POST['newpassword']) && !empty($_POST['newpassword']) && $_POST['newpassword'] != $user['password']) {
        $newpassword = htmlspecialchars($_POST['newpassword']);
        $insertnewpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
        $insertnewpassword->execute(array($newpassword, $_SESSION['id']));
        header('Location: profil.php?id=' . $_SESSION['id']);
        
    }






} else {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= stylesheet href="style.css">
    <title>Edit my profile</title>
</head>
<body>

    <div class="container" align="center">  
    <h2>Edit my profile</h2>      
    <form method="POST" action="">
                <table>
                    <tr>
                    <td>
                        <label for="login">Login :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your new login" name="newlogin" value="<?php echo $user['login']?>">
                    </td>
                    <tr>
                    <td>
                        <label for="firstname">Firstname :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your new firstname" name="newfirstname" value="<?php echo $user['firstname']?>" >
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="lastname">Lastname :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your new lastname" name="newlastname"  >
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="password">Password :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Your password" name="newpassword"> 
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="password">Confirm your password :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirm your password" name="confnewpassword">
                    </td>
                     </tr>
                </table>
                <br /><br />
                <button type="submit" name="forminscription" value="Sign up">Sign up</button>
</div>


</body>
</html>
