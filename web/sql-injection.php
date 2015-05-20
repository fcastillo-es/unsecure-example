<?php
/**
 * Created by PhpStorm.
 * User: fer
 * Date: 19/05/15
 * Time: 23:43
 */

$pdo = new PDO(
    'sqlite::memory:',
    null,
    null,
    array(PDO::ATTR_PERSISTENT => true)
);

$pdo->exec("drop table users");
$pdo->exec("CREATE TABLE IF NOT EXISTS users (username varchar(255), password varchar(255))");
$pdo->exec("insert into users values ('admin', '1234')");
$pdo->exec("insert into users values ('Tony Stark', '1R0nM4n')");
$pdo->exec("insert into users values ('Bruce Banner', 'HULK42')");

$users = $pdo->query("select * from users");

if ($_POST) {
    $sql = "select * from users
      where username = '{$_POST['username']}'
    and password = '{$_POST['password']}'";

    $result = $pdo->query($sql);
    $login = $result->fetch();
}

?>
<html>
<head><title>Sql Injection</title></head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="container">
    <h1>Super secret control panel</h1>
    <form action="" method="post" class="form-inline">
        <fieldset>
            <label for="username">Name</label>
            <input id="username" name="username" type="text" class="form-control"/>
            <label for="password">Password</label>
            <input id="password" name="password" type="text" class="form-control"/>
            <button type="submit" class="btn btn-default">Login</button>
        </fieldset>
    </form>

    <?php
        if (isset($login) && count($login) > 1) {
            echo <<<INFO
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Welcome!</strong> You are logged in as <em>{$login['username']}</em>.
                </div>
INFO;
        } elseif (isset($login)) {
            echo <<<INFO
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Darn!</strong> That login was not correct</em>.
                </div>
INFO;
        }
    ?>

    <table class="table table-striped">
        <caption>Users in database</caption>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
            foreach($users as $user) {
                echo "<tr><td>{$user['username']}</td><td>{$user['password']}</td></tr>";
            }
        ?>
    </table>

</div>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>

</html>
