
<?php

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


// Check database connection

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


// ========================================
// GET DATA FROM REGISTRATION FORM
// ========================================

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$course = $_POST['course'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


// ========================================
// CHECK PASSWORD
// ========================================

if ($password !== $confirm_password) {

    die("Passwords do not match. <br><br>
         <a href='register.html'>Go Back</a>");

}


// ========================================
// CHECK IF USERNAME ALREADY EXISTS
// ========================================

$check_sql = "SELECT id FROM users WHERE username = ?";

$check_stmt = $conn->prepare($check_sql);

$check_stmt->bind_param(
    "s",
    $username
);

$check_stmt->execute();

$check_stmt->store_result();


if ($check_stmt->num_rows > 0) {

    die("Username already exists. Please choose another username.
         <br><br>
         <a href='register.html'>Go Back</a>");

}

$check_stmt->close();


// ========================================
// HASH PASSWORD
// ========================================

$hashed_password = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// ========================================
// INSERT USER INTO DATABASE
// ========================================

$sql = "INSERT INTO users
        (name, email, phone, course, username, password)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);


if (!$stmt) {

    die("SQL Error: " . $conn->error);

}


$stmt->bind_param(
    "ssssss",
    $name,
    $email,
    $phone,
    $course,
    $username,
    $hashed_password
);


// ========================================
// SAVE DATA
// ========================================

if ($stmt->execute()) {

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Registration Successful</title>

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

    .success-box {

        background: white;

        width: 450px;

        padding: 40px;

        text-align: center;

        border-radius: 12px;

        box-shadow: 0 5px 20px
                    rgba(0, 0, 0, 0.15);

    }

    h1 {

        color: #1d3557;

        margin-bottom: 15px;

    }

    p {

        color: #555;

        margin-bottom: 25px;

    }

    .login-btn {

        display: inline-block;

        padding: 12px 25px;

        background: #1d3557;

        color: white;

        text-decoration: none;

        border-radius: 6px;

    }

    .login-btn:hover {

        background: #457b9d;

    }

</style>

</head>

<body>

<div class="success-box">

    <h1>Registration Successful!</h1>

    <p>
        Your account has been created successfully.
    </p>

    <a href="login.html" class="login-btn">
        Go to Login
    </a>

</div>

</body>

</html>

<?php

} else {

    echo "Error: " . $stmt->error;

}


// ========================================
// CLOSE CONNECTION
// ========================================

$stmt->close();

$conn->close();

?>
