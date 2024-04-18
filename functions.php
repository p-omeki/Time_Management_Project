<?php
// User authentication functions
function isUserLoggedIn() {
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function redirectIfNotLoggedIn() {
    if (!isUserLoggedIn()) {
        header("Location: login.php");
        exit;
    }
}

// Add new activity
function addActivity($activity, $start_time, $end_time) {
    global $conn;

    $user_id = $_SESSION["id"];
    $sql = "INSERT INTO activities (user_id, activity, start_time, end_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $activity, $start_time, $end_time);
    $stmt->execute();
    $stmt->close();
}
?>
