<?php
session_start();
// Tarkistetaan onko käyttäjä kirjautunut
if (!isset($_SESSION['user'])){
  header('Content-Type: text/html; charset=utf-8');
  header('refresh:4;url=muokkaaVisaa.php');
  die('<h1>Riittämättömät oikeudet!</h1><p>Sinulla ei ole oikeutta muokata tietovisaa kirjautumatta.</p>');
}

// Tarkisetetaan, että on valittu muokattava kysymys
if (empty($_GET) || !isset($_GET['id'])) {
  header('Content-Type: text/html; charset=utf-8');
  header('refresh:4;url=muokkaaVisaa.php');
  die('<h1>Virhe!</h1><p>Et ole valinnut muokattavaa kysymystä.</p>');
}

$xml = simplexml_load_file('data/visa1.xml');
$i = intval($_GET['id']);
$taso = $xml->taso[$i];

?>
<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $xml->nimi; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Visaan</a></li>
            <li role="presentation"><a href="muokkaaVisaa.php">Muokkaa</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Muokkaa kysymystä</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <form action="muokkaaKysymysTallennus.php" method="post">
            <input type="hidden" name="id" value="<?php echo $i; ?>">
            <ul class="list-group">
              <li class="list-group-item">
                <input type="submit" value="Tallenna kysmys" class="btn btn-primary">
              </li>
              <li class="list-group-item">
                <label>Kysymys</label>
                <input type="text" name="kysymys" value="<?php echo $taso->kysymys; ?>" class="form-control">
              </li>
              <li class="list-group-item">
                <label>Pisteet</label>
                <input type="number" name="pisteet" value="<?php echo $taso->attributes()->pisteet; ?>" min="1" max="10" class="form-control">
              </li>

<?php for ($i=0; $i<5; $i++): ?>

            <?php // Tarkistetaan onko vastaus merkitty oikeaksi
            $chk = (isset($taso->vastaus[$i]['oikein']) ? ' checked ' : '');
            ?>

            <li class="list-group-item">
              <label>Vastaus <?php echo $i+1; ?></label>
              <input type="text" name="vastaus<?php echo $i+1; ?>" value="<?php echo $taso->vastaus[$i]; ?>" class="form-control">
              <input type="radio" name="oikein" value="<?php echo $i; ?>" <?php echo $chk; ?>> Oikea vastaus
            </li>

<?php endfor; ?>

              <li class="list-group-item">
                <input type="submit" value="Tallenna kysmys" class="btn btn-primary">
              </li>
            </ul>
          </form>
        </div>
      </div>


      <footer class="footer">
        <p>&copy; 2016 Puro</p>
      </footer>

    </div> <!-- /container -->

  </body>
  <!--script src="./js/jquery-3.1.1.min.js"></script>
  <!--script src="./js/bootstrap.min.js"></script-->
</html>
