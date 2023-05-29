<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if (isset($_POST['forminscription'])) {
    if (!empty($_POST['login']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        $login = htmlspecialchars($_POST['login']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Password verification
        $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";

        // Verify if the login already exists
        $reqlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $reqlogin->execute(array($login));
        $loginexist = $reqlogin->rowCount();

        if ($loginexist == 0) {
            // Verify if the password is valid
            if (!preg_match($passwordPattern, $password)) {
                $erreur = "Your password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, and 1 number!";
            } else {
                // Check if the passwords match
                if ($password !== $password2) {
                    $erreur = "Your passwords don't match!";
                } else {
                    // Insert the user into the database
                    $insertmbr = $bdd->prepare("INSERT INTO utilisateurs (login, firstname, lastname, password) VALUES (?, ?, ?, ?)");
                    $insertmbr->execute(array($login, $firstname, $lastname, $password));

                    $erreur = "Your account has been created! <a href=\"connexion.php\">Sign in</a>";
                    header("Location: connexion.php");
                    exit();
                }
            }
        } else {
            $erreur = "This login is already taken!";
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
    <title>Document</title>
</head>
<body>
    <div class = "container" align="center">
        <h2>Inscription</h2>
        <br /><br />
        <form method="POST" action="">
                <table>
                    <tr>
                    <td>
                        <label for="login">Login :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your login" name="login">
                    </td>
                    <tr>
                    <td>
                        <label for="firstname">Firstname :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your firstname" name="firstname">
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="lastname">Lastname :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Your lastname" name="lastname">
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="password">Password :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Your password" name="password">
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <label for="password">Confirm your password :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirm your password" name="password2">
                    </td>
                     </tr>
                </table>
                <br /><br />
                <button type="submit" name="forminscription" value="Sign up">Sign up</button>




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