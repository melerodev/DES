<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$user = null;
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

try {
    $connection = new PDO(
        'mysql:host=localhost;dbname=pokemon',
        'newuser',
        'root',
        array(
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
        )
    );
} catch (PDOException $e) {
    //echo 'no connection';
    header('Location:..');
    exit;
}

$sql = 'select * from pokemon order by name, id';
try {
    $sentence = $connection->prepare($sql);
    if (!$sentence->execute()) {
        echo 'no sql';
        exit;
    }
} catch (PDOException $e) {
    //echo '<pre>' . var_export($e, true) . '</pre>';
    header('Location:..');
    exit;
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
        <a class="navbar-brand" href="..">DWES</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="..">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./">Pokèmon</a>
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
                <h4 class="display-4">Banco Pokèmon</h4>
            </div>
        </div>
        <div class="container">
            <?php
            if(isset($_GET['op']) && isset($_GET['result'])) {
                if($_GET['result'] > 0) {
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
            <div class="row">
                <h3>Pokèmon Capturados:</h3>
            </div>
            <table class="table table-striped table-hover" id="tablaProducto">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Weight (kg)</th>
                        <th>Height (m)</th>
                        <th>Type</th>
                        <th>Evolution</th>
                        <?php
                        if(isset($_SESSION['user'])) {
                            ?>
                            <th>Delete</th>
                            <th>Edit</th>
                            <?php
                        }
                        ?>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = $sentence->fetch()) {
                        ?>
                        <tr>
                            <td><?php echo $fila['id']; ?></td>
                            <td><?= $fila['name']; ?></td>
                            <td><?= $fila['weight']; ?></td>
                            <td><?= $fila['height']; ?></td>
                            <td><?= $fila['type']; ?></td>
                            <td><?= $fila['evolution']; ?></td>
                            <?php
                            if(isset($_SESSION['user'])) {
                                ?>
                                <td><a href="destroy.php?id=<?= $fila['id'] ?>" class = "borrar">delete</a></td>
                                <td><a href="edit.php?id=<?= $fila['id'] ?>">edit</a></td>
                                <?php
                            }elseif($user != null) {
                                ?>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <?php
                            }
                            ?>
                            <td><a href="show.php?id=<?= $fila['id'] ?>">view</a></td>                            
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                        <a href="create.php" class="btn btn-success">add pokèmon</a>
                    <?php
                }
                ?>
            </div>
            <hr>
        </div>
    </main>
    <footer class="container">
        <p>&copy; IZV 2024</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php
$connection = null;
