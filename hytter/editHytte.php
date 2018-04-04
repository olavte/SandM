<!DOCTYPE html>

<?php
include "/var/www/html/connectToDatabase.php";
session_start();
$loggedIn = $_SESSION['loggedin'];


$HytteID = $_POST['HytteID'];
$HytteNavn = $_POST['HytteNavn'];
$HytteAns = $_POST['Ansvarlig'];
$HytteSize = $_POST["Størrelse"];
$HytteKom = $_POST['Kommentar'];
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
        <div id="hytteSheet">
            <div id="editHytteSpace">
                <form action="saveHytteOptions.php" method="post">
                    <input type="text" value="<?php echo $HytteID; ?>" name="HytteID">
                    <input type="text" value="<?php echo $HytteNavn; ?>" name="HytteNavn">
                    <p>Størrelse:</p>
                    <input type="number" max="12" min="4" value="<?php echo $Størrelse; ?>" name="Størrelse">
                    <input type="text" value="<?php echo $HytteCom ?>" name="HytteNavn">
                    <input list="unasigned" name="browser">
                    <datalist id="unasigned">
                        <?php
                        $unassignedQuery = "SELECT * FROM Billetter WHERE billettId NOT "
                                . "IN (SELECT idTicket FROM TicketHytteRelationship)";
                        $unassignedTickets = mysqli_query($connection, $unassignedQuery);
                        while ($unassignedTicket = mysqli_fetch_assoc($unassignedTickets)) {
                            $ticketName = $unassignedTicket["kundeNavn"];
                            echo '<option value="'.$ticketName.'">';
                        }
                        ?>
                    </datalist>
                    <input type="submit" value="Neste Side">
                </form>
            </div>
        </div>
        <script src="editjs.js"></script>
    </body>
</html>

