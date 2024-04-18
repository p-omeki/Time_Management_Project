<?php
session_start();

require_once "functions.php";
require_once "db.php";

redirectIfNotLoggedIn();

// Handle add activity form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $activity = $_POST["activity"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $user_id = $_SESSION["id"];
    $sql = "INSERT INTO activities (user_id, activity, start_time, end_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $activity, $start_time, $end_time);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $add_error = "Error adding activity. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Activity</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="add_activity.php">Add Activities</a>
        <a href="view_activities.php">View Activities</a>
        <a href="logout.php" style="float: right;">Logout</a>
    </div>
<h3>Add your activity here, the activity name, date and time (starts and ends)!</h3>
    <div class="content">
        <h1>Add Activity</h1>
        <form method="post" action="">
            <label for="activity">Activity:</label><br>
            <input type="text" id="activity" name="activity" required><br><br>
            <label for="start_time">Start Time:</label><br>
            <input type="datetime-local" id="start_time" name="start_time" required><br><br>
            <label for="end_time">End Time:</label><br>
            <input type="datetime-local" id="end_time" name="end_time" required><br><br>
            <input type="submit" value="Add Activity">
        </form>
        <?php if (isset($add_error)) { ?>
            <p><?php echo $add_error; ?></p>
        <?php } ?>
    </div>
</body>
</html>
