<?php

//database connection
/** @var mysqli $db */

require_once "database.php";


//Get the result set from the database with a SQL query
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Loop through the result to create a custom array
$user = [];
while ($row = mysqli_fetch_assoc($result)) {
    $user[] = $row;
}
//Close connection
mysqli_close($db);

?>

    <!doctype html>
    <html lang="en">
<head>
    <title>Advies van Ali</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="reserveringen.css">

</head>

<header>

    <div class="container-nav">
        <nav class="navbar">
            <a href="" class="nav-branding">Advies van Ali</a>
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


</header>



<body>

<div class="container px-4">
    <h1 class="title mt-4">user</h1>
    <hr>
    <table class="table is-bordered is-striped  is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>#</th>
            <th>First name</th>
            <th>Last name</th>
            <th>E-mail</th>
            <th>Number</th>
            <th>Time</th>
            <th>Date</th>

            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="9" class="has-text-centered">&copy; Advies van Ali</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($user as $index => $user) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $user['first_name'] ?></td>
                <td><?= $user['last_name'] ?></td>
                <td><?= $user['mail'] ?></td>
                <td><?= $user['date'] ?></td>
                <td><?= $user['time'] ?></td>
                <td><?= $user['number'] ?></td>
                <td><a href="details.php?id=<?= $user['id'] ?>">Details</a></td>
                <td><a href="delete.php?id=<?= $user['id'] ?>">Delete</a></td>
                <td><a href="edit.php?id=<?= $user['id'] ?>">Edit</a></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
    </html>
