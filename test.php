<?php
// Includi la classe DBManager
require_once 'DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni la lista dei task
$tasks = $db->getTasks();

// Per ogni task, crea un form con un bottone delete
foreach ($tasks as $task) {
    echo '<form action="Update.php" method="post">';
    echo 'Task: ' . $task['name'];
    echo '<input type="hidden" name="id" value="' . $task['id'] . '">';
    echo '<input type="submit" value="Update">';
    echo '</form>';
}
