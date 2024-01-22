<?php

/** @var mysqli $db */
session_start();

if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['updateAvailability'])) {
    $selectedDate = $_POST['updateAvailability'];
}

require_once "database.php";

$queryAppointments = "SELECT * FROM appointments";
$resultAppointments = mysqli_query($db, $queryAppointments);

$queryDates = "SELECT * FROM dates";
$resultDates = mysqli_query($db, $queryDates);


if (isset($_POST['updateAvailability'])) {
    if (!empty($_POST['updateDates'])) {
        require_once "database.php";

        foreach ($_POST['updateDates'] as $selectedDate) {
            $selectQuery = "SELECT availability FROM dates WHERE date = '$selectedDate'";
            $result = mysqli_query($db, $selectQuery);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $currentAvailability = $row['availability'];

                $newAvailability = ($currentAvailability == 0) ? 1 : 0;

                $updateQuery = "UPDATE dates SET availability = $newAvailability WHERE date = '$selectedDate'";
                $updateResult = mysqli_query($db, $updateQuery);

                if (!$updateResult) {
                    echo "Fout bij bijwerken van beschikbaarheid: " . mysqli_error($db);
                }
            } else {
                echo "Fout bij ophalen van huidige beschikbaarheid: " . mysqli_error($db);
            }
        }

        echo "Beschikbaarheidsdatums succesvol bijgewerkt.";
    } else {
        echo "Selecteer minstens één datum om de beschikbaarheid bij te werken.";
    }
}

if (isset($_POST['deleteReservation'])) {
    $deleteDate = mysqli_real_escape_string($db, $_POST['deleteReservation']);
    $deleteQuery = "DELETE FROM appointments WHERE date = '$deleteDate'";
    mysqli_query($db, $deleteQuery) or die('Error deleting reservation: ' . mysqli_error($db));


    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="admin.css">

    <style>
        section {
            margin-top: 45px;
        }
    </style>
    <title>Admin Page</title>
</head>

<body>

<header>
    <div class="container-nav">
        <nav class="navbar">
            <a href="index.php" class="nav-branding">Advies van Ali</a>
            <ul class="nav-menu">
                <li class="nav-link">
                    <button class="button">
                        <a href="index.php">Home</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="create.php">Reserveren</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="contact2.html">Contact</a>
                    </button>
                </li>
                <li class="nav-link">
                    <button class="button">
                        <a href="logout.php">Logout</a>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="hero is-light is-bold">
        <div class="hero-body">
            <div class="container">
                <h2 class="title is-2 has-text-centered">Huidige Reserveringen</h2>
                <div class="table-container">
                    <table class="table is-fullwidth is-striped is-hoverable">
                        <thead>
                        <tr>
                            <th>E-mail</th>
                            <th>Telefoonnummer</th>
                            <th>Naam</th>
                            <th>Datum</th>
                            <th>Actie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultAppointments)) : ?>
                            <tr>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="deleteReservation" value="<?= $row['date'] ?>">
                                        <button class="button is-danger" type="submit">Verwijderen</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <section class="availability-section">
        <h2 class="section-title">Beschikbaarheidsdatums</h2>
        <form method="post" class="availability-form">
            <div class="select-wrapper">
                <label for="updateDates" class="select-label">Selecteer datums:</label>
                <select name="updateDates[]" id="updateDates" multiple size="10" class="date-select">
                    <?php while ($dateRow = mysqli_fetch_assoc($resultDates)) : ?>
                        <?php
                        $availabilityClass = $dateRow['availability'] ? 'beschikbaar' : 'niet-beschikbaar';
                        ?>
                        <option value="<?= $dateRow['date'] ?>" class="<?= $availabilityClass ?>">
                            <?= $dateRow['date'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="updateAvailability" class="update-button">Update Beschikbaarheid</button>
        </form>
    </section>


</main>

<footer>
</footer>

</body>

</html>