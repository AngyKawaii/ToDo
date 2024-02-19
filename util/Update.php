<?php
// Includi la classe DBManager
require_once '../util/DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni l'ID del task da eliminare
$taskId = $_POST['id'];
$desccrizione = $_POST['descrizione'];
$date = $_POST['data'];

// Update task
$db->update($taskId, $desccrizione, $date);

// Reindirizza l'utente alla pagina benvenuto.php
header('Location: ../pages/benvenuto.php');

