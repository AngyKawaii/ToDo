<?php

// Includi la classe DBManager
require_once '../util/DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni l'ID del task
$taskId = $_POST['id'];

// Task non completata
$db->notComplete($taskId);

// Reindirizza l'utente alla pagina benvenuto.php
header('Location: ../pages/benvenuto.php');

