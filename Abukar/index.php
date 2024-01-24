<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Advies van Ali</title>
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
            <a href="create.php">Afspreken</a>
          </button>
        </li>
          <li class="nav-link">
              <button class="button">
                  <a href="contact2.html">Contact</a>
              </button>
          </li>

        <?php
          if (isset($_SESSION['loggedInUser'])) {
          ?>
        <li class="nav-link">
          <button class="button">
            <a href="admin.php">Admin</a>
          </button>
        </li>
        <li class="nav-link">
            <button class="button">
                <a href="logout.php">Logout</a>
            </button>
        </li>
        <?php
          } else {
          ?>
        <li class="nav-link">
          <button class="button">
            <a href="login.php">Login</a>
          </button>
        </li>
        <?php } ?>
      </ul>
    </nav>
  </div>

</header>
<div class="hero-image">
  <div class="hero-cont">
    <div class="hero-text">
      <H1 class="hero-heading">Welkom!</H1>
      <p class="hero-subtitel">Advies van Ali</p>
      <p class="hero-desc">
        Hallo, mijn naam is Ilyas, ik run een juridisch advies bureau dat al jouw problemen kan oplossen.
        Als jij een juridisch problemen hebt ben ik degene die jou advies kan geven.
      </p>
    </div>
  </div>
</div>
<main>

  <section>
    <div class="left">
      <div class="left-titel">
        <h1>Ilyas Abshir Ali</h1>
        <p>1 juni 2002</p>
        <img src="photos/foto-ily.jpg" alt="zelfportret" class="foto-me" width="500">
      </div>
    </div>
  </section>
  <section>
    <div class="my-desc">
      <div class="desc-titel">
        <h1> About Me</h1>
        <p>Mijn naam is Ilyas Abshir Ali. Ik ben 20 jaar oud en woon in Zoetermeer. Ik zit nu in mijn derde jaar van de studie rechten op de Erasmus universiteit.

        </p>
        <h3>Waarom rechten?</h3>
        <p>
          De reden dat ik voor de opleiding rechten heb gekozen is omdat ik van jongs af aan al een sterk rechtsvaardigheidsgevoel heb gehad voor mijzelf en anderen. Ik hield ook erg van discussiëren en vond het leuk om argumenten te bedenken om de discussie te winnen. Ook heb ik ook veel affiniteit met lezen. Deze kenmerken en gewoontes zorgde ervoor dat ik op de middelbare school ervoor heb gekozen om rechtsgeleerdheid te kiezen als vervolgstudie.
        </p>


      </div>
    </div>
  </section>
</main>

<footer>
</footer>

</body>

</html>
