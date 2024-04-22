<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<?php
    session_start();
    if (!empty($_SESSION["userID"])){
        require_once "db.php";
        $con = @mysqli_connect($server, $dbuser, $dbpassword, $dbname);
        $userID = $_SESSION["userID"];
        if ($con->connect_errno != 0){
            echo "error ".$con->connect_errno;
        }
    } else{
        header("location: loginform.php");
    }
?>

<body>
    <header class="bg-warning py-4">
        <div class="container">
            <h1 class="text-center text-white">Cześć
                <span class="username">
                    <?php             
                        $name = $con->query("select user.login from user where userID ='$userID'")->fetch_assoc();
                        echo $name["login"]; 
                    ?>
                </span>!</h1>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Restauracja XYZ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#onas">O nas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rezerwacje">Rezerwacje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="unlog">Wyloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <article id="onas">
                <h2 class="mb-4">Historia restauracji</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel lorem vitae lectus suscipit fermentum. Nunc nec efficitur leo. Vivamus nec odio a neque ultrices dictum. Donec ac turpis in mi auctor auctor. Proin tempus sem sed magna tincidunt, id pharetra libero pretium.</p>
                <h2 class="mb-4">Menu</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel lorem vitae lectus suscipit fermentum. Nunc nec efficitur leo. Vivamus nec odio a neque ultrices dictum. Donec ac turpis in mi auctor auctor. Proin tempus sem sed magna tincidunt, id pharetra libero pretium.</p>
            </article>

            <section id="reservation-form" class="my-4">
                <h2 class="mb-4">Zarezerwuj stolik</h2>
                <form method="post" action="rezerwation.php">
                    <div class="form-group">
                        <label for="date">Data:</label>
                        <input type="date" id="date" name="date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="time">Godzina:</label>
                        <input type="time" id="time" name="time" class="form-control" required step="3600" min="10:00" max="20:00">
                    </div>
                    <div class="form-group">
                        <label for="party-size">Liczba osób:</label>
                        <input type="number" id="party-size" name="party-size" class="form-control" min="1" max="6" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Zarezerwuj</button>
                </form>
            </section>

            <section id="reserved-tables">
                <h2 class="mb-4">Zarezerwowane stoliki</h2>
                <?php
                    $reservations_query = "SELECT rezerwacje.liczba_osob, rezerwacje.data, rezerwacje.godzina_rezerwacji 
                                        FROM rezerwacje 
                                        JOIN stoliki ON rezerwacje.stolikiID = stoliki.stolikiID
                                        JOIN user ON rezerwacje.userID = user.userID
                                        WHERE user.userID = {$_SESSION['userID']}";
                    $reservations_result = $con->query($reservations_query);

                    if ($reservations_result->num_rows > 0) {
                        echo '<ul class="list-group" id="rezerwacje">';
                        while ($row = $reservations_result->fetch_assoc()) {
                            echo '<li class="list-group-item">Stolik ' . $row['liczba_osob'] . ' osoby - ' . $row['data'] . ', ' . $row['godzina_rezerwacji'] . '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>Brak zarezerwowanych stolików.</p>';
                    }
                ?>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
            

        <script>document.querySelector("#unlog").addEventListener("click",function (){location.href="deregister.php"})</script>
    </div>
</body>
</html>