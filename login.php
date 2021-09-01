<?php
// Checks if user already logged in
session_start();
if (!isset($_SESSION["valid"])) {
    $_SESSION["valid"] = false;
} else if ($_SESSION["valid"] == true) {
    header("Location: index.php");
}

// Connects to the database
$server = "localhost";
$username = "root";
$password = "";
$database = "laboratory";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validates username and password
if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    if ($username == null || $password == null) {
        $error = "Username or password cannot be blank";
    } else {
        $sql = "SELECT * FROM login WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $_SESSION["valid"] = true;
            header("Location: index.php");
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in Page</title>
</head>

<body>
    <p>Welcome to login.php</p>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" />
        <label for="password">Password:</label>
        <input type="password" name="password" />
        <button type="submit" name="submit">Log-in</button>
    </form>
    <p>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
    </p>
</body>

</html>