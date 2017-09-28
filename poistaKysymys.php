<?php
// Tarkistetaan, että tullaan oikeill Get-parameteilla
if (empty($_GET) || !isset($_GET['id']))
  die("Olet ilmeisesti eksynyt!");

$xml = simplexml_load_file('data/visa1.xml');

$i = intval($_GET['id']);

unset($xml->taso[$i]);

// Muotoilu ja tallennus
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
$dom->save('data/visa1.xml');

header('Location:muokkaaVisaa.php');
