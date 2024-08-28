<!doctype html>
<html lang="fr">

<head>
    <title>TodoList</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/style/style.css">
</head>

<body class="container vh-100">
    <header class="h-25">
        <!-- place navbar here -->
        <div class="h-75 d-flex align-content-center justify-content-center">
            <div class="my-auto">
                <h1 class="text-center fs-1">To Do List</h1>
                <div class="me-5">
                    <div class="gap-2">
                        <button
                            type="button"
                            name=""
                            id=""
                            class="btn btn-success btn-lg"
                            onclick="newTask()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-25 d-flex">
            <div class="h-100 col border border-black text-capitalize fs-4 text-center">à faire</div>
            <div class="h-100 col border border-black text-capitalize fs-4 text-center">en cours</div>
            <div class="h-100 col border border-black text-capitalize fs-4 text-center">terminée</div>
        </div>
    </header>
    <main class="h-75">
        <div class="h-100 d-flex">
            <div class="h-100 col bg-success" id="listTodo">
                <div class="card text-black position-relative">
                    <div class="card-header">
                        Quotess
                    </div>
                    <div class="position-sticky bottom-100 text-end">
                        <div class="gap-2">
                            <button
                                type="button"
                                name=""
                                id=""
                                class="btn btn-danger"
                                onclick="deleteItem()">
                                <i
                                    class="fas fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="h-100 col bg-warning" id="listCurrent">
            </div>
            <div class="h-100 col bg-secondary" id="listDone">
            </div>
        </div>
    </main>
    <footer class="h-25">
        <!-- place footer here -->
    </footer>

    <!-- Modal trigger button -->
    <button id="openModal" type="button" class="btn btn-primary btn-lg d-none" data-bs-toggle="modal" data-bs-target="#modalId">
        Launch
    </button>

    <!-- Modal Body -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Nouvelle Tâche
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="action" id="formModal" method="post">

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input
                                type="text"
                                class="form-control"
                                name="title"
                                id="title"
                                aria-describedby="helpId" />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>

                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="statusTodo"
                                value="0" checked />
                            <label class="form-check-label text-capitalize" for="statusTodo">à faire</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="statusCurrent"
                                value="1" />
                            <label class="form-check-label text-capitalize" for="statusCurrent">En cours</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="status"
                                id="statusDone"
                                value="2" />
                            <label class="form-check-label text-capitalize" for="statusDone">Terminée</label>
                        </div>
                        <div class="d-flex justify-content-center mt-5">

                            <button
                                type="submit"
                                class="btn btn-warning btn-lg">
                                <i class="fas fa-sd-card"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modalId"),
            options,
        );
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="../public/js/script.js"></script>
    <!-- <script src="../public/js/main.js"></script> -->
</body>

</html>