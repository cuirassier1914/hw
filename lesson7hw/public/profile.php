<?php
session_start();
require_once '../engine/db.php';
require_once '../engine/functions.php';
delete();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>lesson7</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
<h1>Корзина</h1>
<div class="container">

    <div class="goods">
        <table>
        <?php
        getCart();
        ?>
        </table>
    </div>
    <div class="userData">
        <?php
        isAuth();
        ?>
    </div>

</div>
<a href="index.php">На главную</a>
</body>

</html>
