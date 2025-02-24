<?php
// control de sesión
session_start();
if(!isset($_SESSION['user'])) {
    header('Location:.');
    exit;
}

//para ver todos los errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

//lectura de datos de la sesión, los guarda en dos variables y los borra de la sesión
//si no hay datos en la sesión los deja vacíos
$name = '';
$weight = '';
$height = '';
$type = '';
$evolution = '';
if(isset($_SESSION['old']['name'])) {
    $name = $_SESSION['old']['name'];   //guarda el dato en una variable
    unset($_SESSION['old']['name']);    //lo borra de la sesión
}
if(isset($_SESSION['old']['weight'])) {
    $price = $_SESSION['old']['weight'];
    unset($_SESSION['old']['weight']);
}
if(isset($_SESSION['old']['height'])) {
    $price = $_SESSION['old']['height'];
    unset($_SESSION['old']['height']);
}
if(isset($_SESSION['old']['type'])) {
    $price = $_SESSION['old']['type'];
    unset($_SESSION['old']['type']);
}
if(isset($_SESSION['old']['evolution'])) {
    $price = $_SESSION['old']['evolution'];
    unset($_SESSION['old']['evolution']);
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>dwes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="./">DWES</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pokemon">Pokèmon</a>
                    </li>
                </ul>
            </div>
            <div>
                <a href="https://github.com/Arturo92gr/DWES/tree/main/CRUD%20en%20php%20de%20una%20tabla%20de%20una%20base%20de%20datos" class="text-white" target="_blank">
                    <i class="fa-brands fa-github"></i> Code
                </a>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Pokèmon</h4>
                </div>
            </div>
            <div class="container">
            <?php
            //isset comprueba si llega algo o no
            if (isset($_GET['op']) && isset($_GET['result'])) {
                //según 'result', "alert alert-" será primary(azul) o danger(roja)
                if ($_GET['result'] > 0) {
            ?>
                    <div class="alert alert-primary" role="alert">
                        result: <?= $_GET['op'] . ' ' . $_GET['result'] ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger" role="alert">
                        result: <?= $_GET['op'] . ' ' . $_GET['result'] ?>
                    </div>
            <?php
                }
            }
            ?>
                <div>
                    <form action="store.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="<?= $name ?>" required type="text" class="form-control" id="name" name="name" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input value="<?= $weight ?>" required type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="weight">
                        </div>
                        <div class="form-group">
                            <label for="height">Height (m)</label>
                            <input value="<?= $height ?>" required type="number" step="0.01" class="form-control" id="height" name="height" placeholder="height">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label><br>
                            <select name="type" id="type">
                            <option value="bug" <?= $type == 'bug' ? 'selected' : '' ?>>bug</option>
                                <option value="dark" <?= $type == 'dark' ? 'selected' : '' ?>>dark</option>
                                <option value="dragon" <?= $type == 'dragon' ? 'selected' : '' ?>>dragon</option>
                                <option value="electric" <?= $type == 'electric' ? 'selected' : '' ?>>electric</option>
                                <option value="fairy" <?= $type == 'fairy' ? 'selected' : '' ?>>fairy</option>
                                <option value="fighting" <?= $type == 'fighting' ? 'selected' : '' ?>>fighting</option>
                                <option value="fire" <?= $type == 'fire' ? 'selected' : '' ?>>fire</option>
                                <option value="flying" <?= $type == 'flying' ? 'selected' : '' ?>>flying</option>
                                <option value="ghost" <?= $type == 'ghost' ? 'selected' : '' ?>>ghost</option>
                                <option value="grass" <?= $type == 'grass' ? 'selected' : '' ?>>grass</option>
                                <option value="ground" <?= $type == 'ground' ? 'selected' : '' ?>>ground</option>
                                <option value="ice" <?= $type == 'ice' ? 'selected' : '' ?>>ice</option>
                                <option value="normal" <?= $type == 'normal' ? 'selected' : '' ?>>normal</option>
                                <option value="poison" <?= $type == 'poison' ? 'selected' : '' ?>>poison</option>
                                <option value="psychic" <?= $type == 'psychic' ? 'selected' : '' ?>>psychic</option>
                                <option value="rock" <?= $type == 'rock' ? 'selected' : '' ?>>rock</option>
                                <option value="steel" <?= $type == 'steel' ? 'selected' : '' ?>>steel</option>
                                <option value="water" <?= $type == 'water' ? 'selected' : '' ?>>water</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="evolution">Evolutions</label>
                            <input value="<?= $evolution ?>" required type="number" step="1" class="form-control" id="evolution" name="evolution" placeholder="number of evolutions">
                        </div>
                        <button type="submit" class="btn btn-primary">add</button>
                    </form>
                    <div class="form-group">
                        <a href="./">back</a>
                    </div>
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