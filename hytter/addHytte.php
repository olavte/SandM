<?php

include '/var/www/html/connectToDatabase.php';


$Hyttenavn = ($_POST['hytteNavn']);
$størrelse = ($_POST['størrelse']);
$hytteNr = $_POST['hytteNr'];
$responsible = $_POST['ansvarlig'];
$coment = $_POST['comment'];


$sql = "INSERT INTO Hytte (navn, størrelse, hytteNr, ansvarlig, kommentar)
        VALUES ('$Hyttenavn', $størrelse, '$hytteNr', '$responsible', '$coment')";

mysqli_query($connection, $sql) or die(mysqli_error($connection));

header("location: ../hytter");