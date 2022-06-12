    <?php
    include "conn.php";
    $date_1 = $_GET['date_1'];
    $date_2 = $_GET['date_2'];

    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.film
            where $db.film.date between :date_1 and :date_2"
    );
    $sqlSelect->execute(array('date_1' => $date_1, 'date_2' => $date_2));
    $cell = $sqlSelect->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($cell);
    ?>
