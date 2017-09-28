<?php
session_start();
include_once('autentikoi.php');

if (!autentikoiBasic()) {
  header('refresh:2;url=index.php');
  die('<h1 style="color=red">Pääsy evätty!</h1>');
}


$xml = simplexml_load_file('data/visa1.xml');
$nimi = $xml->nimi;
$tekijä = $xml->tekijä;
$pvm = $xml->pvm;
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

    <title><?php echo $nimi; ?></title>

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
            <li role="presentation"><a href="#">Muokkaa</a></li>
            <li role="presentation"><a href="lisaaKysymys.php">Lisää kysymys</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Tervetuloa <?php echo $_SESSION['user']; ?>!</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <a href="lisaaKysymys.php" class="btn btn-primary">Lisää kysymys</a>
        </div>
      </div>

      <?php $i = 0; ?>
      <?php foreach ($xml->taso as $tehtävä): ?>
        <div class="row marketing">
          <div class="col-lg-12">
            <?php
              echo "<h3>" . $tehtävä->kysymys . "</h3>";
              echo '<a href="poistaKysymys.php?id='.$i.'" class="btn btn-danger">Poista</a>';
              echo '<a href="muokkaaKysymys.php?id='.$i++.'" class="btn btn-primary">Muokkaa</a>';
             ?>
          </div>
        </div>
      <?php endforeach; ?>

      <footer class="footer">
        <p>&copy; 2016 Puro</p>
      </footer>

    </div> <!-- /container -->

  </body>
  <!--script src="./js/jquery-3.1.1.min.js"></script>
  <!--script src="./js/bootstrap.min.js"></script-->
</html>
