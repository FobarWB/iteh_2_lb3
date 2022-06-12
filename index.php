<!DOCTYPE HTML>
<html>
<head>
    <title>Lab3</title>
    <script>
        var ajax = new XMLHttpRequest();

function text() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                console.dir(ajax.responseText);
                document.getElementById("result").innerHTML = ajax.response;
            }
        }
    }
    var genre = document.getElementById("genre").value;
    ajax.open("get", "genre.php?genre=" + genre);
    ajax.send();
}

function XML() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                
                console.dir(ajax);
                let rows = ajax.responseXML.children.firstChild;
                let result = "<table border ='1'><tr><th>Actor</th><th>Film</th><th>Date</th><th>Country</th><th>Quality</th><th>Producer</th><th>Director</th><th>Carrier</th></tr>";
                console.dir(rows.length);
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[4].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[5].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[6].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[7].firstChild.nodeValue + "</td>";
                    result += "</tr>";
                }
                document.getElementById("result").innerHTML = result;
            }
        }
    }
    var actor = document.getElementById("actor").value;
    ajax.open("get", "actor.php?actor=" + actor);
    ajax.send();
}

function _JSON() {
    ajax.onreadystatechange = function() {
        let rows = JSON.parse(ajax.responseText);
        console.dir(rows);
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                console.dir(ajax);
                
                let result = "<table border ='1'><tr><th>Film</th><th>Date</th><th>Country</th><th>Quality</th><th>Producer</th><th>Director</th><th>Carrier</th></tr>";
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].name + "</td>";
                    result += "<td>" + rows[i].date + "</td>";
                    result += "<td>" + rows[i].country + "</td>";
                    result += "<td>" + rows[i].quality + "</td>";
                    result += "<td>" + rows[i].producer + "</td>";
                    result += "<td>" + rows[i].director + "</td>";
                    result += "<td>" + rows[i].carrier + "</td>";
                    result += "</tr>";
                }
                document.getElementById("result").innerHTML = result;
            }
        }
    };
    var date_1 = document.getElementById("date_1").value;
    var date_2 = document.getElementById("date_2").value;
    ajax.open("get", "date.php?date_1=" + date_1 + "&date_2=" + date_2);
    ajax.send();
}
    </script>
</head>
<body>
    <p>Films by genre <select name="genre" id="genre">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT title FROM $db.genre";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>$cell[0]</option>";
            }
            ?>
        </select>
        <button onclick="text()"> ОК </button></p>

        <p>Films by actor <select name="actor" id="actor">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT name FROM $db.actor";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>$cell[0]</option>";
            }
            ?>
        </select>
        <button onclick="XML()"> ОК </button></p>


        <p>Films by date <select name="date_1" id="date_1">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT date FROM $db.FILM";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>$cell[0]</option>";
            }
            ?>
        </select>
        <select name="date_2" id="date_2">
            <?php
            include 'conn.php';
            $sqlSelect = "SELECT DISTINCT date FROM $db.FILM";
            foreach ($dbh->query($sqlSelect) as $cell) {
                echo "<option>$cell[0]</option>";    
            }
            ?></p>
        </select>
        <button onclick="_JSON()"> ОК </button>
<div id="result"></div>
</body>

</html>