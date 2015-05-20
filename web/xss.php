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

$pdo->exec("CREATE TABLE IF NOT EXISTS comments (content text)");

if ($_POST) {

    if (isset($_POST['delete'])) {
        $pdo->exec("DROP TABLE comments");
        $pdo->exec("CREATE TABLE IF NOT EXISTS comments (content text)");
    } else {
        $pdo->exec("INSERT INTO comments VALUES ('{$_POST['comment']}')");
    }
}

$comments = $pdo->query("select * from comments");

?>
<html>
<head><title>XSS</title></head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<body>
<div class="container">
    <h1>Super secret control panel</h1>
    <form action="" method="post" class="form-inline">
        <fieldset>
            <label for="comment"></label>
            <textarea id="comment" name="comment" class="form-control"></textarea>
            <button type="submit" class="btn btn-default">Enviar</button>
            <button type="submit" name="delete" class="btn btn-danger">Borrar todo</button>
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

    <h2>Comentarios</h2>
    <ul>
        <?php
            foreach($comments as $comment) {
                echo "<li>{$comment['content']}</li>";
            }
        ?>
    </ul>

</div>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>

</html>
