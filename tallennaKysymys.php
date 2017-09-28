<?php
if (empty($_GET)) {
  die("Et täyttänyt lomaketta");
}

$kysymys = $_GET['kysymys'];
$pisteet = $_GET['pisteet'];
$vastaus1 = $_GET['vastaus1'];
$vastaus2 = $_GET['vastaus2'];
$vastaus3 = $_GET['vastaus3'];
$vastaus4 = $_GET['vastaus4'];
$vastaus5 = $_GET['vastaus5'];
$oikein = (isset($_GET['oikein'])) ? intval( $_GET['oikein'] ) : '0';

$errors = array();

if (empty($kysymys)) $errors[] = 'Et antanut kysymystä';
if (empty($pisteet)) $errors[] = 'Et antanut pisteitä';
if (!is_numeric($oikein)) $errors[] = 'Et antanut oikeaa vastausta';
if (empty($vastaus1) && empty($vastaus2)) $errors[] = 'Ainakin kaksi vastausvaihtoehtoa pitää antaa';

if (!empty($errors)) {
  $output = '<ul><li>' . implode('</li><li>',$errors) . '</li></ul>';
} else {
  $output = 'Lomake täytetty ja aloitetaan tallennus';

  $xml = simplexml_load_file('data/visa1.xml');
  $uusiKysymys = $xml->addChild('taso');
  $uusiKysymys->addChild('kysymys', $kysymys);
  $uusiKysymys->addChild('vastaus', $vastaus1);
  $uusiKysymys->addChild('vastaus', $vastaus2);
  if (!empty($vastaus3)) $uusiKysymys->addChild('vastaus', $vastaus3);
  if (!empty($vastaus4)) $uusiKysymys->addChild('vastaus', $vastaus4);
  if (!empty($vastaus5)) $uusiKysymys->addChild('vastaus', $vastaus5);
  $uusiKysymys->addAttribute('pisteet', $pisteet);
  $uusiKysymys->vastaus[--$oikein]->addAttribute('oikein','ok');

  // Muotoilu ja tallennus
  $dom = new DOMDocument("1.0");
  $dom->preserveWhiteSpace = false;
  $dom->formatOutput = true;
  $dom->loadXML($xml->asXML());
  $dom->save('data/visa1.xml');
}

header('refresh:2;url=muokkaaVisaa.php');
echo $output;
