<?php
/** @var mysqli $db */

require_once "database.php";

$sql = "SELECT date, availability FROM dates";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $dates = array();
    while ($row = $result->fetch_assoc()) {
        $dates[] = array($row["date"], $row["availability"]);
    }
}

$dagenPerMaand = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$aantalDatums = count($dates);
$aantalPaginas = 12;

if (isset($_GET['pagina'])) {
    $huidigePagina = max(1, min($_GET['pagina'], $aantalPaginas));
} else {
    $huidigePagina = 1;
}

$datumsPerPagina = $dagenPerMaand[$huidigePagina - 1];
$startIndex = array_sum(array_slice($dagenPerMaand, 0, $huidigePagina - 1));
$eindIndex = min($startIndex + $datumsPerPagina - 1, $aantalDatums - 1);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);

    require_once "form-validation.php";

    if (empty($errors)) {
        $query = "INSERT INTO appointments (name, email, date, phone)
                  VALUES ('$name', '$email', '$date', '$phone')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        $updateQuery = "UPDATE dates SET availability = 0 WHERE date = '$date'";
        mysqli_query($db, $updateQuery) or die('Error updating availability: '.mysqli_error($db));

        $id = mysqli_insert_id($db);
        mysqli_close($db);

        header('Location: confirmation.php?id='.$id);
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="create.css">
    <title>Advies van Ali</title>
</head>
<body>
<div class="container-nav">
    <nav class="navbar">
        <a href="index.html" class="nav-branding">Advies van Ali</a>
        <ul class="nav-menu">
            <li class="nav-link">
                <button class="button">
                    <a href="index.html">Home</a>
                </button>
            </li>
            <li class="nav-link">
                <button class="button">
                    <a href="create.php">Reserveren</a>
                </button>
            </li>
            <li class="nav-link">
                <button class="button">
                    <a href="contact.html">Contact</a>
                </button>
            </li>
            <li class="nav-link">
                <button class="button">
                    <a href="login.php">Login</a>
                </button>
            </li>
        </ul>
    </nav>
</div>

<div class="container px-4">
    <h1 class="title mt-4">Maak een afspraak met mij</h1>
    <h3 class="label">Beschikbaarheid:</h3>
    <div class="pagination-container">
        <div class="pagination">
            <?php
            $maanden = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');

            foreach ($maanden as $index => $maand) {
                $pagina = $index + 1;
                $actieveKlasse = ($pagina == $huidigePagina) ? 'is-active' : '';
                echo "<a class='pagination-link $actieveKlasse' href='?pagina=$pagina'>$maand</a>";
            }
            ?>
        </div>
    </div>
    <div id="beschikbaarheidskalender">
        <?php
        for ($i = $startIndex; $i <= $eindIndex; $i++) {
            $date = $dates[$i];
            $cssClass = $date[1] ? 'beschikbaar' : 'niet-beschikbaar';
            echo "<div class='$cssClass'>$date[0]</div>";
        }
        ?>
    </div>

    <section class="box">
        <form method="post" action="">
            <div class="box">
                <div class="control">
                    <label class="label">Gewenste dag</label>
                    <input class="input" id="date" type="date" name="date" value="<?= $day ?? '' ?>" required/>
                </div>
                <p class="help is-danger">
                    <?= $errors['date'] ?? '' ?>
                </p>
            </div>

            <div class="box" >
                <div class="field">
                    <label class="label">Naam</label>
                    <div class="control">
                        <input class="input" id="name" type="text" name="name" value="<?= $name ?? '' ?>"/>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['name'] ?? '' ?>
                    </p>
                </div>
            </div>

            <div class="box">
                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" required/>
                        <p class="help is-danger">
                            <?= $errors['email'] ?? '' ?>
                        </p>
                        <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="field">
                    <label  class="label">Telefoonnummer</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id="phone" type="text" name="phone" value="<?= $phone ?? '' ?>" required/>
                        <p class="help is-danger">
                            <?= $errors['phone'] ?? '' ?>
                        </p>
                        <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                    </div>
                </div>
            </div>

            <div class="control">
                <button type="submit" name="submit" class="button is-dark">Reserveer nu!</button>
            </div>
        </form>
    </section>

    <a class="button mt-4" href="index.php">&laquo; Go back to the list</a>
</div>

</body>
</html>
