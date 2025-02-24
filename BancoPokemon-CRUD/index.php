<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AMZ</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="./">AMZ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pokemon/">Pokèmon</a>
                    </li>
                </ul>
            </div>
            <div>
                <a href="https://github.com/melerodev/DES/tree/main/BancoPokemon-CRUD" class="text-white" target="_blank">
                    <i class="fa-brands fa-github"></i> Code
                </a>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Banco Pokèmon</h4>
                </div>
            </div>
            <div class="container">
                <?php
                if(isset($_GET['op']) && isset($_GET['result'])) {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        result: <?= $_GET['op'] . ' ' . $_GET['result'] ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <h3>Pokèmon, peso, altura, tipo y número de evoluciones</h3>
                </div>
                <div class="row">
                    <?php
                    if(isset($_SESSION['user'])) {
                        ?>
                        <a href="user/logout.php" class="btn btn-success">Log out</a>
                        <?php
                    } else {
                        ?>
                        <a href="user/login.php?user" class="btn btn-success">Log in</a>
                        <?php
                    }
                    ?>
                    &nbsp;
                    <a href="pokemon" class="btn btn-success">Banco</a>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IZV 2024</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>