<?php
// Includi la classe DBManager
require_once '../util/DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni l'ID del task da eliminare
$user_id = $_POST['id'];
$desccrizione = $_POST['descrizione'];
$date = $_POST['data'];

// Elimina il task
$db->create($user_id, $desccrizione, $date);

// Reindirizza l'utente alla pagina benvenuto.php
header('Location: ../pages/benvenuto.php');
