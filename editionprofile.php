<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=network_days', "root", "",);


if(isset($_SESSION['id']))
{
        $requser = $pdo->prepare("SELECT * FROM nd_users WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();

        if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
        {
            $newpseudo = htmlspecialchars($_POST['newpseudo']);
            $insertpseudo = $pdo->prepare("UPDATE nd_users SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        }


        if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['pseudo'])
        {
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $pdo->prepare("UPDATE nd_users SET mail = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        }

        if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
        {
            $mdp1 = sha1($_POST['newmdp']);
            $mdp2 = sha1($_POST['newmdp2']);

            if($mdp1 == $mdp2 )
            {
                $insertmdp == $pdo->prepare("UPDATE nd_users SET motdepasse = ? WHERE =?");
                $insertmdp->execute(array($newmdp, $_SESSION['id']));
                header('Location: profile.php?id='.$_SESSION['id']);
            }
            else
            {
                $msg  = "Vos deux mot de passe ne correspondent pas";
            }
        }

            if(isset($_FILES['avatar']) AND !empty($_FILES ['avatar']['name']))
        {
            // TAILLE MEGAOCTED
            $taillemax =   2097152;
            $extensionValides = array('jpg', 'gif', 'png',);
            if($_FILES['avatar']['size'] <= $taillemax)
            {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionValides))
                {
                    $chemin = "membres/avatar/".$_SESSION['id'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                    if($resultat)
                    {
                        $updateavatar = $pdo->prepare('UPDATE nd_users SET avatar = :avatar WHERE id = :id');
                        $updateavatar->execute(array(
                          'avatar' =>  $_SESSION['id']. ".".$extensionUpload,
                           'id' => $_SESSION['id']
                        ));
                        header('Location: profile.php?id='.$_SESSION['id']);

                    }
                    else
                    {
                        $msg  = "Erreure durant l'importation de votre photo de profil ";
                    }
                }
                else
                {
                    $msg = "Votre Photo de profil  doit être sous format jpg, jpeg, gif ou png ";

                }
            }
            else
            {
                $msg = "Votre Photo de profil ne doit pas dépasser 2Mo";
            }
        }

?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div align="center">
        <h2>Editon de mon profil</h2>
        <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
                    <label for="">Pseudo :</label>
                    <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
                    <label for="">Mail :</label>
                    <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
                    <label for="">Mot de passe</label>
                    <input type="password" name="newmdp" placeholder="Mot de passe" /><br /><br />
                    <label for="">Confirmation mot de passe</label>
                    <input type="password" name="newmdp2" placeholder="Confirmation mot de passe" /><br /<br />
                    <label for="">Avatar :</label>
                    <input type="file" name="avatar"> <br><br>
                    <input type="submit" value="Mettre a jour mon profil">
                
                </form>
                <?php
                if(isset($msg)) { echo $msg; }
                ?>
            </div>
        </div>
</body>
</html>
<?php 
}
else
{
    header("Location: connexion.php");
}
?>