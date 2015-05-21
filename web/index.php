<?php
/**
 * Created by PhpStorm.
 * User: fer
 * Date: 21/05/15
 * Time: 20:49
 */

$pdo = new PDO(
    'sqlite::memory:',
    null,
    null,
    array(PDO::ATTR_PERSISTENT => true)
);

$pdo->exec("drop table users");
$pdo->exec("CREATE TABLE users (username varchar(255), password varchar(255))");
$pdo->exec("insert into users values ('admin', '1234')");
$pdo->exec("insert into users values ('Tony Stark', '1R0nM4n')");
$pdo->exec("insert into users values ('Bruce Banner', 'HULK42')");

$pdo->exec("drop table comments");
$pdo->exec("CREATE TABLE comments (content text)");

$pdo->exec("drop table cookies");
$pdo->exec("CREATE TABLE cookies (cookies text)");

?>
<html>
<head><title>index</title></head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="container">
    <h1>Database initialized</h1>
    <ul>
        <li><a href="sql-injection.php">SQL Injection</a></li>
        <li><a href="xss.php">Cross Site Scripting</a></li>
        <li><a href=""></a></li>
    </ul>
</div>
</body>
</html>