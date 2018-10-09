<?php
/**
 * Соединение с сервером БД
 */

//Товары

$mysql = mysqli_connect('127.0.0.1', 'root', 'kirasir1914', 'goods');

mysqli_query($mysql, "SET NAMES 'utf8'");
mysqli_query($mysql, "SET CHARACTER SET 'utf8'");
mysqli_query($mysql, "SET SESSION collation_connection = 'utf8_unicode_ci'");

$GLOBALS['db'] = $mysql;

//Пользователи

$mysqlUsers = mysqli_connect('127.0.0.1', 'root', 'kirasir1914', 'users');

mysqli_query($mysqlUsers, "SET NAMES 'utf8'");
mysqli_query($mysqlUsers, "SET CHARACTER SET 'utf8'");
mysqli_query($mysqlUsers, "SET SESSION collation_connection = 'utf8_unicode_ci'");

$GLOBALS['dbUsers'] = $mysqlUsers;