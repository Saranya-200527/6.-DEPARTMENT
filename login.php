
<?php

session_start();


// ========================================
// DATABASE CONNECTION
// ========================================

$servername = "localhost";
$username = "root";
$password = "";
$database = "department_db";
$port = 3306;


$conn = new mysqli(
    $servername,
    $username,
    $password,
    $database,
    $port
);


// Check connection

if ($conn->connect_error) {

    die("Database connection failed: "
        . $conn->connect_error);

}


// ========================================
// GET LOGIN DATA
// ========================================

$username = $_POST['username'];
$password = $_POST['password'];


// ========================================
// FIND USER
// ========================================

$sql = "SELECT id, name, email, course, username, password
        FROM users
        WHERE username = ?";


$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "s",
    $username
);

$stmt->execute();

$result = $stmt->get_result();


// ========================================
// CHECK USER
// ========================================

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();


    // Check password

    if (password_verify(
        $password,
        $user['password']
    )) {


        // ========================================
        // LOGIN SUCCESS
        // ========================================

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['name'] = $user['name'];

        $_SESSION['email'] = $user['email'];

        $_SESSION['course'] =
            $user['course'];

        $_SESSION['username'] =
            $user['username'];


        // Go to dashboard

        header("Location: dashboard.php");

        exit();

    }

}


// ========================================
// LOGIN FAILED
// ========================================

?>

<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Login Failed</title>

<style>

    * {
        box-sizing: border-box;

        font-family: Arial, sans-serif;
    }


    body {

        margin: 0;

        min-height: 100vh;

        background: #e8f1f8;

        display: flex;

        justify-content: center;

        align-items: center;
    }


    .error-box {

        background: white;

        width: 450px;

        padding: 40px;

        text-align: center;

        border-radius: 12px;

        box-shadow:
            0 5px 20px
            rgba(0, 0, 0, 0.15);
    }


    h1 {

        color: #d62828;

        margin-bottom: 15px;
    }


    p {

        color: #555;

        margin-bottom: 25px;
    }


    a {

        display: inline-block;

        padding: 12px 25px;

        background: #1d3557;

        color: white;

        text-decoration: none;

        border-radius: 6px;
    }


    a:hover {

        background: #457b9d;
    }

</style>


</head>

<body>


<div class="error-box">

    <h1>Login Failed</h1>

    <p>
        Invalid username or password.
    </p>

    <a href="login.html">
        Try Again
    </a>

</div>


</body>

</html>

<?php

$stmt->close();

$conn->close();

?>

