<?php
include '/var/www/html/connectToDatabase.php';

$HytteID = ($_POST['idHytte']);
$_HytteID = mysqli_real_escape_string($connection,$_POST['idHytte']);
$query = "DELETE FROM Hytte WHERE idHytte = '$_HytteID'";
$data = mysqli_query($connection, $query) or die(mysqli_error($connection));

header("location: ../hytter");