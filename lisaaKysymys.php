<?php
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
            <li role="presentation"><a href="muokkaaVisaa.php">Muokkaa</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Lisää uusi kysymys</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <form>
            <ul class="list-group">
              <li class="list-group-item">
                <label>Kysymys</label>
                <input type="text" name="kysymys" placeholder="Kirjoita kysmys tähän" class="form-control">
              </li>
              <li class="list-group-item">
                <label>Pisteet</label>
                <input type="number" name="pisteet" min="1" max="10" class="form-control">
              </li>
              <li class="list-group-item">
                <label>Vastaus 1</label>
                <input type="text" name="vastaus1" placeholder="Kirjoita vastaus tähän" class="form-control">
                <input type="radio" name="oikein" value="1"> Oikea vastaus
              </li>
              <li class="list-group-item">
                <label>Vastaus 2</label>
                <input type="text" name="vastaus2" placeholder="Kirjoita vastaus tähän" class="form-control">
                <input type="radio" name="oikein" value="2"> Oikea vastaus
              </li>
              <li class="list-group-item">
                <label>Vastaus 3</label>
                <input type="text" name="vastaus3" placeholder="Kirjoita vastaus tähän" class="form-control">
                <input type="radio" name="oikein" value="3"> Oikea vastaus
              </li>
              <li class="list-group-item">
                <label>Vastaus 4</label>
                <input type="text" name="vastaus4" placeholder="Kirjoita vastaus tähän" class="form-control">
                <input type="radio" name="oikein" value="4"> Oikea vastaus
              </li>
              <li class="list-group-item">
                <label>Vastaus 5</label>
                <input type="text" name="vastaus5" placeholder="Kirjoita vastaus tähän" class="form-control">
                <input type="radio" name="oikein" value="5"> Oikea vastaus
              </li>
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
