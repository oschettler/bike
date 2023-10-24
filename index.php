<?php
include('env.php');

session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
$text = isset($_SESSION['text']) ? $_SESSION['text'] : '';
unset($_SESSION['text']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['zahl']) || $_POST['zahl'] != 52) {
    $_SESSION['message'] = 'Wie ist die Rahmengröße?';
    $_SESSION['text'] = $_POST['text'];
  }
  else
  if (empty($_POST['text'])) {
    $_SESSION['message'] = 'Bitte schreibe mir einen Hinweis.';
  }
  else {
    $_SESSION['message'] = 'Danke für die Hilfe';
    $_SESSION['text'] = '';
    mail($mail, 'BIKE', $_POST['text']);
  }
  header('Location: /');
}

?><!doctype html>
<html class="no-js" lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <style>
    body {
      background-image: url('bg.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
    section {
	margin: 100px auto auto 40px;
	padding: 40px;
	width: 50%;
	background: rgba(255,255,255,0.8);
	font-family: arial, helvetica, sans-serif;
	line-height: 1.4em;
    }
    textarea, button {
	display: block;
    }
    textarea, input,  button {
	padding: 4px;
	border: solid 1px gray;
	border-radius: 4px;
	margin-bottom: 10px;
    }
    fieldset {
	border: none;
	padding: 0;
	
    }
    textarea, fieldset {
	width: 100%;
    }
    input {
	width: 4em;
    }
    button {
    	   padding: 10px;
	   background-color: #000;
	   color: #FFF;
	   font-size: 1.2em;
	   font-weight: strong;
    }
    #message {
	width: 80%;
	border: solid 1px green;
	background: #DFD;
        padding: 10px;
    }
    </style>
  </head>
  <body>
    <section>
      <h1>Fahrrad geklaut</h1>
      <p>Am Montag, 24.10. um 14 Uhr klaute <a href="bg.jpg">dieser Mann</a> das Fahrrad unserer Tochter aus unserem Vorgarten in der Bonner Altstadt. Wir hätten es gerne zurück.</p>
      <?php
      if ($message):
      ?>
      <div id="message">
        <?= $message ?>
      </div>
      <?php
      else:
      ?>
      <div>
	Marke: <strong>Winora</strong><br> 
        Typ: <strong>Domingo 24	Diamant</strong><br>
	Farbe: <strong>oliv/orange</strong></br>
	Rahmengröße: <strong>52cm</strong><br>
        Rahmennummer: <strong>LY02032210</strong><br>
        Codierung: <strong>BN 00 01616 014 LS 22</strong>
      </div>

      <p>Hinweis gerne an <strong>0160-1529500</strong> (SMS, Signal)</p>
      <?php
      endif;
      ?>
      <form method="POST">
	<h2>Oder direkt hier:</h2>
	<textarea name="text" rows="4" placeholder="Hast du das Fahrrad oder den Mann gesehen? Schreibe mir hier gerne einen Hinweis."><?= $text ?></textarea>
	<fieldset>
	  <label for="zahl">Spamschutz (Rahmengröße als Zahl):</label>
	  <input name="zahl" type="number">
	</fieldset>
	<button type="submit">Abschicken</button>
      </form>
    </section>
  </body>
</html>

