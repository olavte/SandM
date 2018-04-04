<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '/var/www/html/connectToDatabase.php';

$query = "SELECT * FROM Billetter WHERE billettId NOT IN (SELECT idTicket FROM TicketHytteRelationship)";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$name = $result["kundeNavn"];

 while($row = mysqli_fetch_a($result)){
 array_push($result, array('item'=>$row[0]));
 }
 
 echo '<option>testtest</option>testtest';
 
 ?>
