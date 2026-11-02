<?php

session_start();


// Check if user is logged in

if (!isset($_SESSION['user_id'])) {

    header("Location: login.html");

    exit();

}

?>

<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Dashboard - Computer Science</title>

<link rel="stylesheet" href="style.css">


</head>

<body>

<!-- Navigation -->

<header>

    <nav class="navbar">

        <div class="logo">
            Computer Science
        </div>

        <ul class="nav-links">

            <li>
                <a href="dashboard.php">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="about.html">
                    About Us
                </a>
            </li>

            <li>
                <a href="logout.php">
                    Logout
                </a>
            </li>

        </ul>

    </nav>

</header>


<!-- Dashboard -->

<section class="dashboard">

    <div class="dashboard-box">

        <h1>
            Welcome,
            <?php echo htmlspecialchars($_SESSION['name']); ?>!
        </h1>


        <p>
            Welcome to the Department of Computer Science,
            Pondicherry University.
        </p>


        <div class="user-details">

            <h2>Your Details</h2>


            <p>
                <strong>Username:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['username']
                );
                ?>
            </p>


            <p>
                <strong>Email:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['email']
                );
                ?>
            </p>


            <p>
                <strong>Course:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['course']
                );
                ?>
            </p>

        </div>


        <div class="dashboard-info">

            <h2>Academic Portal</h2>

            <p>
                Access your personal information and
                stay connected with the academic activities
                and facilities of Computer Science.
            </p>

        </div>


        <a
            href="logout.php"
            class="logout-btn"
        >
            Logout
        </a>

    </div>

</section>


</body>

</html>