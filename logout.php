<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["confirm_logout"])) {
        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page after logout
        header("Location: login.php");
        exit;
    } else {
        // Redirect to the home page or any other page
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        /* Styles for the confirmation box */
        .confirmation-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: center;
        }

        /* Styles for the buttons */
        .confirmation-box button {
            margin: 0 10px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f1f1f1;
            cursor: pointer;
        }
    </style>
    <script>
        // Function to redirect to the home page (or any other page) when clicking "No"
        function cancelLogout() {
            window.location.href = "index.php";
        }
    </script>
</head>
<body>
    <div class="confirmation-box">
        Are you sure you want to logout?
        <form method="post" action="">
            <input type="submit" name="confirm_logout" value="Yes">
            <button type="button" onclick="cancelLogout()">No</button>
        </form>
    </div>

</body>
</html>
