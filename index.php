<?php
session_start();
if (!$_SESSION['isAuth']) {
    header('Location: ./view/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Hello</title>
</head>

<body>
    <form class="container">
        <div>
            <span>Hello, </span>
            <?php
            if ($_SESSION['name']) {
                echo "<span class='span__name'>" . $_SESSION["name"] . "</span>";
            }
            ?>
        </div>
        <button type="submit" class="button__exit">Выйти</button>
    </form>
    <script type="module" src="./js/index.js"></script>
</body>

</html>