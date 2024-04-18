<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
    <style>
        .calendar {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .calendar th, .calendar td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .calendar th {
            background-color: #f2f2f2;
        }

        .calendar td {
            cursor: pointer;
        }

        .calendar td.today {
            background-color: #f0f0f0;
        }

        .calendar td.selected {
            background-color: #e0e0e0;
        }
    </style>
    <script>
        function updateCalendar() {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth();
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var firstDay = new Date(year, month, 1).getDay();

            var calendar = "<table class='calendar'>";
            calendar += "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";
            
            var dayCounter = 1;
            for (var i = 0; i < 6; i++) {
                calendar += "<tr>";
                for (var j = 0; j < 7; j++) {
                    if ((i === 0 && j < firstDay) || dayCounter > daysInMonth) {
                        calendar += "<td>&nbsp;</td>";
                    } else {
                        var className = (year === today.getFullYear() && month === today.getMonth() && dayCounter === today.getDate()) ? 'today' : '';
                        calendar += "<td class='" + className + "'>" + dayCounter + "</td>";
                        dayCounter++;
                    }
                }
                calendar += "</tr>";
                if (dayCounter > daysInMonth) {
                    break;
                }
            }
            calendar += "</table>";
            
            document.getElementById("calendar").innerHTML = calendar;
        }

        // Update the calendar
        updateCalendar();
    </script>
</head>
<body>
    <div id="calendar"></div>
</body>
</html>
