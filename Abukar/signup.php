<?php


/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mail = $_POST['mail'];
    $number = $_POST['number'];
    $password = $_POST['password'];

    //Require the form validation handling
    require_once "form-validation2.php";


    $db = mysqli_connect(
        hostname: 'localhost',
        username: 'root',
        password: '',
        database: 'reserveringssysteem'
    );


    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        //Save the record to the database
        $query = "INSERT INTO registreer (first_name, last_name, mail,number,password)
                  VALUES ('$first_name','$last_name','$mail','$number','$password')";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: index.html');
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
    <title>Register - Create</title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4">Registreren</h1>

    <section class="columns">
        <form class="column is-6" action="" method="post">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Voornaam</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="name" type="text" name="first_name"
                                   value="<?= $first_name ?? '' ?>"
                                   required/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['first_name'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Achternaam</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="last_name" type="text" name="last_name"
                                   value="<?= $last_name ?? '' ?>" required/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['Last_name'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="mail">E-mail</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="genre" type="text" name="mail" value="<?= $mail ?? '' ?>"
                                   required/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['mail'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="number">Telefoonnummer</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" id="number" type="text" name="number"
                                   value="<?= $number ?? '' ?>" required/>
                        </div>
                        <p class="help is-danger">
                            <?= $errors['number'] ?? '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field-body">
                <div class="field">
                    <label class="label">wachtwoord</label>
                    <div class="control">
                        <input class="input" id="password" type="password" name="password" required/>
                    </div>
                    <p class="help is-danger">
                        <?= $errors['password'] ?? '' ?>
                    </p>
                </div>
            </div>
            <div class="control">
                <button type="submit" name="submit" class="button is-dark">Sign up</button>
            </div>
        </form>
    </section>
</div>


<a class="button mt-4" href="index.html">&laquo; terug naar home</a>
</body>
</html>