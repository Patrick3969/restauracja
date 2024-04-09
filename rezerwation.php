<?php
session_start();
require_once "db.php";
$mysqli = @mysqli_connect($server, $dbuser, $dbpassword, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['date'];
    $godzina = $_POST['time'];
    $liczba_osob = $_POST['party-size'];

    $query = "SELECT stolikiID FROM stoliki WHERE stolikiID NOT IN (SELECT stolikiID FROM rezerwacje WHERE data = '$data' AND godzina_rezerwacji = '$godzina') LIMIT 1";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stolikID = $row['stolikiID'];

        $insert_query = "INSERT INTO rezerwacje (data, godzina_rezerwacji, liczba_osob, stolikiID, userID) VALUES ('$data', '$godzina', $liczba_osob, $stolikID, {$_SESSION['userID']})";
        if ($mysqli->query($insert_query) === TRUE) {
            echo "Stolik został zarezerwowany pomyślnie!";
            header("location: index.php");
        } else {
            echo "Błąd podczas rezerwacji stolika: " . $mysqli->error;
        }
    } else {
        // Jeśli nie znaleziono wolnego stolika
        echo "Niestety, wszystkie stoliki są zajęte w tym terminie. Proszę wybrać inny termin.";
    }

    // Zamknięcie połączenia z bazą danych
    $mysqli->close();
}
?>