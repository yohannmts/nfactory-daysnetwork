<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=network_days', "root", "",);


if(isset($_GET['id']) AND $_GET['id'] > 0 )
{

    $getid = intval($_GET['id']);
    $requser = $pdo->prepare('SELECT * FROM nd_users WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo['pseudo'];?></h2>
        <br /><br />
        <?php if(!empty($userinfo['avatar']))
        {
            ?>
            <img src="membres/avatar/<?php echo $userinfo['avatar']; ?>"  width="150" >
            <?php
        }
        ?>
        <br>
        Pseudo  <?php echo $userinfo['pseudo'];?>
        <br />
        Mail  <?php echo $userinfo['mail'];?>
        <br />
       <?php 
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
        {
            ?>
            <a href="editionprofile.php">Editer mon profile</a>
            <a href="deconnexion.php">Se deconnecter</a>

            <?php
        }
      ?>
    </div>
</body>
</html>
<?php 
}
?>