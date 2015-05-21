<?php
/**
 * Created by PhpStorm.
 * User: fer
 * Date: 21/05/15
 * Time: 21:48
 */

$pdo = new PDO(
    'sqlite::memory:',
    null,
    null,
    array(PDO::ATTR_PERSISTENT => true)
);

header("Content-type: text/plain");

$cookies = $pdo->query("select * from cookies");
echo "COOKIES\n";
foreach ($cookies->fetchAll() as $cookie) {
    echo "{$cookie['cookies']}\n";
}