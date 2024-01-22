<?php
//Require database in this file
/** @var $db */
require_once "database.php";

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$afspraakId = mysqli_escape_string($db, $_GET['id']);

//Get the record from the database result
$query = "SELECT * FROM users WHERE id = '$afspraakId'";
$result = mysqli_query($db, $query)
or die ('Error: ' . $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$afspraken = mysqli_fetch_assoc($result);

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
//Postback with the data showed to the user, first retrieve data from 'Super global'
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $mail = mysqli_real_escape_string($db, $_POST['mail']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    $number = mysqli_real_escape_string($db, $_POST['number']);

//Require the form validation handling
    require_once "form-validation.php";

    // Als alles ingevuld is dan stuur door naar de database en stuur door naar index pagina.
    if (empty($errors)) {
        $query = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`mail`='$mail',`date`='$date',`time`='$time',`number`='$number' WHERE id = '$afspraakId'";
        mysqli_query($db, $query);
        header('Location: details.php');
        exit;
    }
}

//Close connection
mysqli_close($db);

?>

    <!DOCTYPE html>
    <html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advies van Ali</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/logoMK.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="reserveringen.css" rel="stylesheet">



</head>
<body>

<header>

    <div class="container-nav">
        <nav class="navbar">
            <a href="" class="nav-branding">Advies van Ali</a>
            <ul class="nav-menu">
                <li class="nav-link">
                    <button class="button">
                        <a href="index.php">Home</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="informatie.html">informatie</a>
                    </button></li>
                <li class="nav-link">
                    <button class="button">
                        <a href="create.php">reserveren</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="contact.html">Contact</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="reserveringen.php">login</a>
                    </button>
                </li>
            </ul>
        </nav>
    </div>


</header>

<main>
    <section class="section">
        <div class="box">
            <form method="post" action="">
                <div class="field">
                    <label class="label">Voornaam</label>
                    <div class="control">
                        <input class="input" name="first_name" type="text" value="<?= htmlentities($afspraken['first_name']) ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['first_name'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label" for="last_name">Achternaam</label>
                    <div class="control">
                        <input class="input" name="last_name" id="phone" type="tel"
                               value="0<?= htmlentities($afspraken['last_name']) ?>"
                        >
                    </div>
                    <p class="help is-danger">
                        <?= $errors['last_name'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input name="mail" class="input" type="email" value="<?= htmlentities($afspraken['mail']) ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['mail'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">telefoonnummer</label>
                    <div class="control">
                        <input class="input" name="number" id="phone" type="tel"
                    </div>
                    <p class="help is-danger">
                        <?= $errors['number'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">Datum</label>
                    <div class="control">
                        <input class="input" name="date" type="date" value="<?= htmlentities($afspraken['date']) ?>">
                    </div>
                    <p class="help is-danger">
                        <?= $errors['date'] ?? '' ?>
                    </p>
                </div>

                <div class="field">
                    <label class="label">tijd</label>
                    <div class="control">
                        <input class="input" name="time" type="time" value="<?= htmlentities($afspraken['time']) ?>">

                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-success">Bevestigen</button>
                    </div>
                    <div class="control">
                        <a href="details.php?id=<?= $afspraken['id'] ?>" class="button is-light">Annuleren</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
    </html>
