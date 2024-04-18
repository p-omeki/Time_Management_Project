<!DOCTYPE html>
<html>
<head>
    <title>clock</title>
    <style>
        #clock {
            font-family: Arial, sans-serif;
            font-size: 24px;
            color: #333;
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            
            // Add leading zeros if necessary
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;
            
            var timeString = hours + ":" + minutes + ":" + seconds;
            
            document.getElementById("clock").innerHTML = timeString;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);
    </script>
</head>
<body>
    <div id="clock"></div>
</body>
</html>
