<?php
session_start();
// Tarkistetaan onko käyttäjä kirjautunut
if (!isset($_SESSION['user'])){
  header('Content-Type: text/html; charset=utf-8');
  header('refresh:4;url=muokkaaVisaa.php');
  die('<h1>Riittämättömät oikeudet!</h1><p>Sinulla ei ole oikeutta muokata tietovisaa kirjautumatta.</p>');
}

// Tarkisetetaan, että on valittu muokattava kysymys
if (empty($_POST) || !isset($_POST['id'])) {
  header('Content-Type: text/html; charset=utf-8');
  header('refresh:4;url=muokkaaVisaa.php');
  die('<h1>Virhe!</h1><p>Et ole valinnut muokattavaa kysymystä.</p>');
}

$id = intval($_POST['id']);
$kysymys = $_POST['kysymys'];
$pisteet = $_POST['pisteet'];
$v1 = $_POST['vastaus1'];
$v2 = $_POST['vastaus2'];
$v3 = $_POST['vastaus3'];
$v4 = $_POST['vastaus4'];
$v5 = $_POST['vastaus5'];
$oikein = intval($_POST['oikein']);

$xml = simplexml_load_file('data/visa1.xml');
$xml->taso[$id]->kysymys = $kysymys;
$xml->taso[$id]->attributes()->pisteet = $pisteet;

$taso = $xml->taso[$id];
unset($taso->vastaus);

for ($i=0; $i<5; $i++){
  $j = $i+1;
  if (!empty(${"v".$j})){
    $taso->vastaus[] = ${"v".$j}; // $v1, $v2, jne.
    if ($i === $oikein) {
      $taso->vastaus[$i]['oikein'] = 'ok';
      // $taso->vastaus[$i]->addAttribute('oikein','ok');
    }
  }
}

// Muotoilu ja tallennus
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
$dom->save('data/visa1.xml');

header('Location: muokkaaVisaa.php');
