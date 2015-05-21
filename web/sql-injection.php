<?php
/**
 * Created by PhpStorm.
 * User: fer
 * Date: 19/05/15
 * Time: 23:43
 */

session_start();

$pdo = new PDO(
    'sqlite::memory:',
    null,
    null,
    array(PDO::ATTR_PERSISTENT => true)
);

$users = $pdo->query("select * from users");

if ($_POST) {
    $sql = "select * from users
      where username = '{$_POST['username']}'
    and password = '{$_POST['password']}'";

    $result = $pdo->query($sql);
    $login = $result->fetch();

    if (isset($login) && count($login) > 1) {
        $_SESSION['user'] = $login['username'];
    }
}

?>
<html>
<head><title>Sql Injection</title></head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="container">
    <h1>Super secret control panel</h1>
    <?php
        if (isset($_SESSION['user'])) {
            echo "<h3>Logged user: <span class='label label-primary'>{$_SESSION['user']}</span></h3>";
        }
    ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</body>

</html>
