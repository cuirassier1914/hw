<?php
session_start();
require_once '../engine/db.php';
require_once '../engine/functions.php';
putInCart();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>lesson7</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
    <div class="goods">
        <?php
        getCatalog();
        ?>
    </div>
    <div class="userData">
        <?php
        isAuth();
        ?>
    </div>

</div>
</body>

</html>
