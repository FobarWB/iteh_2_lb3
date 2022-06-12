<?php
    include "conn.php";
    $genre = $_GET['genre']; 
    $sqlSelect = $dbh->prepare(
    "SELECT * FROM $db.genre
    inner join $db.film_genre on $db.genre.id_genre = $db.FILM_GENRE.FID_GENRE
    inner join $db.film on $db.film_genre.fid_film = $db.film.id_film
    where $db.genre.title = :genre"
    );
    $sqlSelect->execute(array('genre' => $genre));
    echo "<table border ='1'>";
    echo "<tr><th>Genre</th><th>Film</th><th>Date</th><th>Country</th><th>Quality</th><th>Producer</th><th>Director</th><th>Carrier</th></tr>";
    while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
        $genre = $cell[1];
        $film = $cell[5];
        $date = $cell[6];
        $country = $cell[7];
        $quality = $cell[8];
        $producer = $cell[11];
        $director = $cell[12];
        $carrier = $cell[13];

        echo "<tr><td>$genre</td><td>$film</td><td>$date</td><td>$country</td><td>$quality</td>\<td>$producer</td><td>$director</td><td>$carrier</td></tr>";
    }
    ?>
