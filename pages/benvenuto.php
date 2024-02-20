 <?php

session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $id = $_SESSION['id'];
    $string = "Welcome, $username!";
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
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style=" background-image: linear-gradient(to right bottom, #0930b9, #3e37c8, #5d3ed6, #7945e4, #944cf2); ">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3" style=" background-image: linear-gradient(to right bottom, #6680c9, #5a8cce, #5297d0, #52a2d0, #59abce, #5bb4d2, #5ebed6, #64c7d9, #60d4e2, #5ce1e8, #5ceeee, #5ffbf1);" >
                    <div class="card-body p-4" >
                        <h1 class="text-center">
                            <?= $string; ?>
                        </h1>

                        <div class="container">
                            <div class="tasks">
                                <h1 class="text-center my-3 pb-3">Tasks</h1>

                                <?php foreach ($tasks as $task): ?>
                                    <div class="justify-content-center align-items-center mb-4">
                                        <div class="container text-center">
                                            <div class="row align-items-start">
                                                <div class="col-3 p-2 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input task-checkbox" type="checkbox"
                                                        <?php if ($task['Completato'] == 1) echo 'checked'; ?>
                                                        id="task_<?php echo $task['id']; ?>" onchange="line(<?php echo $task['id']; ?>)">
                                                        <label class="form-check-label" for="task_<?php echo $task['id']; ?>"<?php if ($task['Completato'] == 1) echo 'style="text-decoration: line-through;"'; ?>>
                                                            <?php echo $task['Descrizione']; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 p-2">
                                                    <div class="row row-cols-3">
                                                        <div class="col-4">
                                                            <?php if (strtotime($task['Data']) < time() && $task['Completato'] != 1): ?>
                                                                <p class="text-center"><?php echo $task['Data']; ?> <span class="badge bg-danger">In ritardo</span></p>
                                                            <?php else: ?>
                                                                <p class="text-center"><?php echo $task['Data']; ?></p>
                                                            <?php endif; ?>     
                                                        </div>                                                     
                                                        <div class="col-md-4 offset-md-4">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <button type="button" class="btn btn-primary rounded-3"
                                                                    onclick="showModal(<?php echo $task['id']; ?>)">Update</button>
                                                                <form action="../util/Delete.php" method="post" class="input-inline">
                                                                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal_<?php echo $task['id']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifica Task</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../util/Update.php" method="post"
                                                        class="list-group-item">
                                                        <input type="text" class="form-control" name="descrizione"
                                                            placeholder="Inserisci la tua descrizione"
                                                            value="<?php echo $task['Descrizione']; ?>">
                                                        <input type="date" class="form-control" name="data"
                                                            value="<?php echo $task['Data']; ?>">
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $task['id']; ?>">
                                                        <input type="submit" class="btn btn-primary mt-2"
                                                            value="Modifica">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="pb-2">
                            <div class="card" style="background-color: rgba(255, 255, 255, 0.1); ">
                                <div class="card-body">
                                    <div class="d-flex flex-row align-items-center">
                                        <form action="../util/Create.php" method="post" class="row g-3">
                                            <div class="col-auto">
                                                <input type="text" class="form-control" name="descrizione"
                                                    placeholder="Inserisci la tua descrizione" style="background-color: rgba(255, 255, 255, 0.1); ">
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" class="form-control" name="data" style="background-color: rgba(255, 255, 255, 0.1); ">
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <div class="col-auto">
                                                <input type="submit" class="btn btn-success" value="Aggiungi">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="../Index.html" class="mt-3">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function line(taskId) {
            var checkBox = document.getElementById('task_' + taskId);
            var description = document.getElementById('task_' + taskId).nextElementSibling;
            if (checkBox.checked == true) {
                description.style.textDecoration = "line-through";
                fetch('../util/Complete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + taskId
                });
            } else {
                description.style.textDecoration = "none";
                fetch('../util/NotComplete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + taskId
                });
            }

        }
    </script>

    <script>
        function showModal(taskId) {
            var modalId = 'modal_' + taskId;
            var myModal = new bootstrap.Modal(document.getElementById(modalId));
            myModal.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>