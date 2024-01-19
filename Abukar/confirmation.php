<?php

/** @var mysqli $db */
require_once "database.php";

$userId = $_GET['id'];

$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($db, $query);


$user = mysqli_fetch_assoc($result);

mysqli_close($db);
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <title>confirmation</title>
</head>
<body>


<div class="columns is-centered mt-6">
    <div class="box column is-half">
        <p class="box has-text-weight-bold	">Uw reservering is succesvol doorgestuurd.
        Ali gaat contact met u opnemen.</p>
<div class="columns is-centered">
    <div class="box column is-half">

    <a href="index.html">Ga terug </a>


    </div>
</div>


</body>
</html>