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
            if (isset($error)) {
                unset($error);
            }
            header("Location: index.php");
        } else {
            $error = "Invalid username or password.";
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
    <link rel="stylesheet" href="./css/login.css">
    <title>Log-in Page</title>

    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-white bg-card" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4">
                                    <h2 class="fw-bold mb-5 text-uppercase">Lab MS</h2>
                                    <form method="post" action="login.php">
                                        <div class="mb-4">
                                            <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="username" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="password" />
                                        </div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit">Login</button>
                                    </form>
                                    <p class="mt-5 text-error" style="color: #fe5801">
                                        <?php
                                        if (isset($error)) {
                                            echo $error;
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>