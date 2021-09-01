<?php
session_start();
if ($_SESSION["valid"] != "true") {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Welcome to index.php </p>
    <?php session_destroy(); ?>
</body>

</html>