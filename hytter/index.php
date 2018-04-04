<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include "/var/www/html/connectToDatabase.php";
session_start();
$loggedIn = $_SESSION['loggedin'];

$sname = "";
$sorder = "";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../hytteStylesheet.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
    <body>
        <canvas id="canvas"></canvas>
        <img src="../image/addiconBlue.png" style="width:150px;" id="addNewHytte" onclick="goModal()">
        <div id="myModal" class="modal">
            <div id="addHytteModalContent">
                <span class="close">&times;</span>
                <p>Lag ny hytte</p>
                <form id="addNewHytteForm" action="addHytte.php" method="post">
                    <p>Navn:</p>
                    <input type="text" name="hytteNavn" placeholder="Navn.."><br>
                    <p>Størrelse:</p>
                    <input type="number" name="størrelse"><br>
                    <p>Nr.:</p>
                    <input type="text" name="hytteNr" placeholder="Nr.."><br>
                    <p>Ansvarlig:</p>
                    <input type="text" name="ansvarlig" placeholder="Ansvarlig.."><br>
                    <p>Kommentar:</p>
                    <input type="text" name="comment" placeholder="Kommentar.."><br>
                    <input type="submit">
                </form>
            </div>
            <div id="deleteHytteModalContent">
                <span class="close">&times;</span>
                <p>Endre på hytte</p>
                <p id="hytteId_delete"></p>
                <form id="deleteHytteForm" action="deleteHytte.php" method="post">
                    <input id="deleteHytteID" type = "hidden" name = "idHytte"><br>
                    <input type="submit">
                </form>
                <button id="cancelButton">Avbryt</button>
            </div>
        </div>
        <div id="hytteSheet">
            <?php
            $hytteQuery = "SELECT * FROM Hytte";
            $hytter = mysqli_query($connection, $hytteQuery);
            while ($hytte = mysqli_fetch_assoc($hytter)) {

                $currentTakenSpace = 0;
                $HytteID = $hytte["idHytte"];
                $HytteNavn = $hytte["navn"];
                $HytteNum = $hytte["hytteNr"];
                $HytteSize = $hytte["størrelse"];
                $HytteAns = $hytte["ansvarlig"];
                $HytteCom = $hytte["kommentar"];
                echo '<div class="hytte"><ul class="hytteTopBar"><li>';

                echo '<div class="editHytte">
                   <form class="editHytte" action= "editHytte.php" method="POST">
                   <input type="hidden" name="HytteID" value= ' . "'$HytteID'" . '>
                   <input type="hidden" name="HytteNavn" value= ' . "'$HytteNavn'" . '>
                   <input type="hidden" name="Størrelse" value= ' . "'$HytteSize'" . '>
                   <input type="hidden" name="Ansvarlig" value= ' . "'$HytteAns'" . '>    
                   <input type="hidden" name="Kommentar" value= ' . "'$hytteCom'" . '>
                   <input class="editHytteImage" type="image" src="../image/edit.png" name="submit">
                   </form></div></li>';

                echo    '<li style="float:right"><img src="../image/x.png"'.
                        ' onclick="deleteCurrentSelectedHytte('.
                        $HytteID.')"></li></ul>';

                echo '<ul class="hytteNameIDBar">' .
                '<li>' . $HytteNavn . ', Nr: ' . $HytteNum . '</li>' .
                '<li style="float:right">ID: ' . $HytteID . '</li></ul>' .
                '<div class="hytteContent">' .
                '<div class="leftHytte"><p>Ansvarlig: ' . $hytteAns .
                '</p><p>Størrelse: ' . $HytteSize .
                '</p><p>Kommentar: <br>' . $HytteCom . '</p></div>' .
                '<div class="rightHytte"><div class="rightHytteTicketsTopBar">' .
                'Medlemmer:</div><div class="rightHytteTickets">' .
                '<ul class="TicketInHytteList">';
                $assignedQuery = "SELECT * FROM TicketHytteRelationship, Billetter WHERE idHytte = $HytteID and idTicket = billettId";
                $assignedTickets = mysqli_query($connection, $assignedQuery);
                while ($assignedTicket = mysqli_fetch_assoc($assignedTickets)) {
                    $currentTakenSpace++;
                    $TicketNavn = $assignedTicket["kundeNavn"];
                    echo '<li>' . $TicketNavn .
                    '</li>';
                }
                echo '</ul></div><p class="availablePlacesInHytte">ledig: ' . ($HytteSize - $currentTakenSpace);
                echo '</p></div></div></div>';
            }
            ?>
        </div>
        <script src="hytterjs.js"></script>
    </body>
</html>
