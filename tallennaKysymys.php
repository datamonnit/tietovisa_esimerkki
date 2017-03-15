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
}

echo $output;
