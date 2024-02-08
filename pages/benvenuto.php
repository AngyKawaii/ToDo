<?php
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $id = $_SESSION['id'];
    $string =  "Welcome, $username!";
    
} else {
    $string = "Welcome!";
}


// Includi la classe DBManager
require_once '../util/DBManager.php';

// Crea un'istanza di DBManager
$db = new DBManager();

// Ottieni la lista dei task
$tasks = $db->getTasks($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

    <h1 class="text-center"><?=$string;?></h1>

    <div class="container">
        <div class="tasks">
            <h1>Tasks</h1>
        
            <?php foreach ($tasks as $task) : ?>
            
            <div class="task">
                <p class="p-inline"><?php echo $task['Descrizione']; ?></p>
                <button type="button" class="btn btn-primary" onclick="showModal(<?php echo $task['id']; ?>)">Update</button>
                <form action="../util/Delete.php" method="post" class="input-inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>

            <div class="modal fade" id="modal_<?php echo $task['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifica Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../util/Update.php" method="post" class="input-inline">
                                <input type="text" class="form-control" name="descrizione" placeholder="Inserisci la tua descrizione" value="<?php echo $task['Descrizione'];?>">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <input type="submit" class="btn btn-primary mt-2" value="Modifica">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <form action="../util/Create.php" method="post" class="create-task mt-3"> 
            <input type="text" class="form-control" name="descrizione" placeholder="Inserisci la tua descrizione">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" class="btn btn-success mt-2" value="Aggiungi">
        </form>   

        <a href="../Index.html" class="mt-3">Logout</a>
    </div>

    <script>
        function showModal(taskId) {
            var modalId = 'modal_' + taskId;
            var myModal = new bootstrap.Modal(document.getElementById(modalId));
            myModal.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
