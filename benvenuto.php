<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .input-inline {
            display: inline;
        }
        .p-inline {
            display: inline;
        }
        .tasks {
            margin: 20px;
        }
    </style>
</head>
<body>
<?php
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $id = $_SESSION['id'];
    echo "Welcome, $username!";
    
} else {
    echo "Welcome!";
}

// Includi la classe DBManager
require_once 'DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni la lista dei task
$tasks = $db->getTasks($id);
?>


    <div class="tasks">
        <h1>Tasks</h1>
    
        <?php foreach ($tasks as $task) : ?>
        
        <div class="task">
            <p class="p-inline"><?php echo $task['Descrizione']; ?></p>
            <form action="Update.php" method="post" class="input-inline">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <input type="submit" value="Update">
            </form>
            <form action="Delete.php" method="post" class="input-inline">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <input type="submit" value="Delete">
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <form action="Create.php" method="post" class="create-task"> 
        <input type="text" name="descrizione" placeholder="Inserisci la tua descrizione">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Aggiungi">
    </form>   
    <a href="Index.html">Logout</a>
</body>
</html>
