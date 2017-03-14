<?php
if (empty($_GET)) {
  die("Et vastannut kysymyksiin");
}
else {
// Aletaan tarkistaa vastauksia
$output = "<h2>Tarkistetaan vastaukset...</h2>";
$xml = simplexml_load_file('data/visa1.xml');
$pisteet = 0;
$kokonaisPisteet = 0;
$i = 1;
$pisteetAttr = "pisteet";
$oikeinAttr = "oikein";
foreach ($xml->taso as $tehtävä) {

  $tasonPisteet = $tehtävä->attributes()->$pisteetAttr;
  $kokonaisPisteet += $tasonPisteet;
  foreach ($tehtävä->vastaus as $vastaus) {

    if ($vastaus->attributes()->$oikeinAttr == 'ok') {
      $output .= '<h3>'.$tehtävä->kysymys.'</h3>';
      if ($vastaus == $_GET[$i++]){
        $pisteet += $tasonPisteet;
        $output .= '<p class="bg-success">Vastasit oikein! Sait '.$tasonPisteet.' pistettä.</p>';
      } else {
        $output .= '<p class="bg-danger">Vastasit väärin!</p>';
      }
    }
  }
}
$output .= '<h4>Sait visasta yhteensä '. $pisteet . '/' . $kokonaisPisteet . ' pistettä!</h4>';
}
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

    <title><?php echo $xml->nimi; ?> vastausten tarkistus</title>

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
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted"><?php echo $xml->nimi . ' : ' . $xml->tekijä; ?></h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <?php echo $output; ?>
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
