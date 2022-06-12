<?php
  header('Content-Type: text/xml');
  header('Cache-Control: no-cache, must-revalidate');
    include "conn.php";
    $actor = $_GET['actor']; 
    $sqlSelect = $dbh->prepare(
    "SELECT * FROM $db.actor
    inner join $db.film_actor on $db.actor.id_actor = $db.FILM_actor.FID_actor
    inner join $db.film on $db.film_actor.fid_film = $db.film.id_film
    where $db.actor.name = :actor"
    );
    $sqlSelect->execute(array('actor' => $actor));
    echo '<?xml version="1.0" encoding="utf-8"?>';
    echo "<root>";
    while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
        $film = $cell[5];
        $date = $cell[6];
        $country = $cell[7];
        $quality = $cell[8];
        $producer = $cell[11];
        $director = $cell[12];
        $carrier = $cell[13];
        echo "<row><actor>$actor</actor><film>$film</film><date>$date</date><country>$country</country><quality>$quality</quality><producer>$producer</producer><director>$director</director><carrier>$carrier</carrier></row>";
    }
    echo "</root>"
    ?>