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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h1 class="text-center">
                                <?= $string; ?>
                            </h1>

                            <div class="container">
                                <div class="tasks">
                                    <h1 class="text-center my-3 pb-3">Tasks</h1>

                                    <?php foreach ($tasks as $task): ?>
                                        <div
                                            class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                            <div class="form-check">
                                                <input class="form-check-input task-checkbox" type="checkbox"
                                                    id="task_<?php echo $task['id']; ?>">
                                                <label class="form-check-label" for="task_<?php echo $task['id']; ?>">
                                                    <?php echo $task['Descrizione']; ?>
                                                </label>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="showModal(<?php echo $task['id']; ?>)">Update</button>
                                                </div>
                                                <div class="col-4">
                                                    <form action="../util/Delete.php" method="post" class="input-inline">
                                                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="modal_<?php echo $task['id']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <!-- Modal Content -->
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="pb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-row align-items-center">

                                            <form action="../util/Create.php" method="post" class="form-label">
                                                <input type="text" class="form-control" name="descrizione"
                                                    placeholder="Inserisci la tua descrizione">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" class="btn btn-success mt-2" value="Aggiungi">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="../Index.html" class="mt-3">Logout</a>
                        </div>
                        
                        <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const checkboxes = document.querySelectorAll('.task-checkbox');

                                    checkboxes.forEach(function (checkbox) {
                                        checkbox.addEventListener('change', function () {
                                            const description = this.nextElementSibling; // Get the label next to the checkbox
                                            if (this.checked) {
                                                description.style.textDecoration = 'line-through';
                                            } else {
                                                description.style.textDecoration = 'none';
                                            }
                                        });
                                    });
                                });
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

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


</body>

</html>