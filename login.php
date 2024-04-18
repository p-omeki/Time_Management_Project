<?php
session_start();

require_once "functions.php"; // Include functions.php to access isUserLoggedIn() function
require_once "db.php";

if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
            exit;
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Styles for centering the form */
        body {
            background-image: url(cssimages/wallclock.jpeg);
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; 
        }

        /* Styles for the form container */
        .form-container {
            width: 300px; /* Set the width of the form container */
            padding: 20px; /* Add some padding around the form */
            border: 1px solid blueviolet; /* Add a border around the form */
            border-radius: 5px; /* Add rounded corners to the form */
            background-color: transparent; /* Set a light background color */
        }

        /* Styles for the form elements */
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%; 
            margin-bottom: 10px; 
            padding: 5px; 
            border: 1px solid blue; 
            border-radius: 3px; 
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff; 
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
            <a href="register.php">Register</a>
        </form>
    </div>
</body>
</html>
