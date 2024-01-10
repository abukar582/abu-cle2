<?php
/** @var mysqli $db */


//Require database in this file & image helpers
require_once "database.php";

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data    from 'Super global'

    $first_name = mysqli_real_escape_string($db,$_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $mail =  mysqli_real_escape_string($db, $_POST['mail']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    $number = mysqli_real_escape_string($db, $_POST['number']);

    //Require the form validation handling
    require_once "form-validation.php";



    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO users (first_name, last_name, mail, date, time, number)
                  VALUES ('$first_name', '$last_name' , '$mail','$date', '$time', '$number')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        $id = mysqli_insert_id($db);
        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: confirmation.php?id='.$id);
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="create.css">

    <title>Advies van Ali</title>
</head>


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
                    <a href="login.php">login</a>
                </button>
            </li>
        </ul>
    </nav>
</div>



<body>
<div class="container px-4">
    <h1 class="title mt-4">Maak een nieuwe reservering</h1>

    <section class="box">
        <form method="post" action="">
            <div class="box" >
                <div class="field">
                    <label class="label">Voornaam</label>
                    <div class="control">
                        <input class="input" id="first_name" type="text" name="first_name" value="<?= $first_name ?? '' ?>"/>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['first_name'] ?? '' ?>
                    </p>
                </div>
            </div>

            <div class="box" >
                <div class="field">
                    <label class="label">Achternaam</label>
                    <div class="control">
                        <input class="input" id="last_name" type="text" name="last_name" value="<?= $last_name ?? '' ?>" required/>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['last_name'] ?? '' ?>
                    </p>
                </div>
            </div>

            <div class="box">
                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id="email" type="text" name="mail" value="<?= $mail ?? '' ?>" required/>
                        <p class="help is-danger">
                            <?= $errors['mail'] ?? '' ?>
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
                <div class="control">
                    <label for="reservation">Gewenste dag</label>
                    <input class="input" id="date" type="date" name="date" value="<?= $day ?? '' ?>"required/>
                </div>
                <p class="help is-danger">
                    <?= $errors['date'] ?? '' ?>
                </p>
            </div>


            <div class="box">
                <label for="time">Gewenste tijdstip</label>
                <input class="input" id="time" type="time" name="time" value="<?= $time ?? '' ?>"required/>
                <small>Reserveren kan van 09:00 tot 19:00</small>
                <p class="help is-danger">
                    <?= $errors['time'] ?? '' ?>
                </p>
            </div>



            <div class="box">
                <div class="field">
                    <label  class="label">Telefoonnummer</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" id="number" type="text" name="number" value="<?= $number ?? '' ?>"required/>
                        <p class="help is-danger">
                            <?= $errors['number'] ?? '' ?>
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