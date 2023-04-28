<?php

//phpinfo();

$connect = new PDO('mysql:host=localhost:3306;dbname=html_db', 'nathan', 'test');

if (!$connect) {
        die('Could not connect : ' . mysql_error());
}

if ($_POST) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dns = $_POST['dns'];

        $result = shell_exec("/var/www/html/createUser.sh $username $password $dns");
        $dbResult = shell_exec("/var/www/html/createDB.sh $dns $username $password");
        $backups =  shellexec('tar -cvzf backupsdate +%d-%m-%y.tar.gz backups');

}

$AccountSize = shell_exec("du -sh /home/nathan | awk '{print $1}'");
echo "<pre>Espace consommé : $AccountSize<\pre>"

$DBSize = shell_exec("sudo du -sh /var/lib/mysql/nathan | awk '{print $1}'");
echo "<pre>Base de donnée : $DBSize<\pre>";

?>
<!DOCTYPE html>
<html>
<head>
<title>Accueil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/></head>
<body class="w-75 m-auto">

<h1 class="text-center">Bienvenue !</h1>
<form method="post">
        <div class="row">
                <div class="col">
                        <label for="username">Utilisateur</label>
                        <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="col">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="password">
                </div>
        </div>
        <label for="dns">DNS</label>
        <input type="text" name="dns" class="form-control" id="dns">
        <input type="submit" class="my-3 btn btn-primary" value="Envoyer">
</form>

<pre>
        <?php
                echo shell_exec('du -a -h /var/www/html | sort -hr');
                echo $backups;
                echo $result;
                echo $dbResult;
        ?>
</pre>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NT></html>