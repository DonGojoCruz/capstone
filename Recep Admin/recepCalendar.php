<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="recepScript.js" defer></script>
</head>
<style>
    /* Center the calendar horizontally and vertically */
    #calendar {
        max-width: none;
        width: 81%;
        margin: 0 auto;
        margin-top: 1px;
        margin-left: 16.28%;
        justify-content: center;
    }

    .container {
        padding: none;
    }
    
    .fc-header-toolbar {
        color: #333;
        border-radius: 5px;
    }
  
    .fc {
        background-color: white;
        border: 1px solid #d99e9e;
    }
  
    .fc-day-number {
        font-size: 16px;
        color: black;
    }
  
    .fc-today {
        background-color: #ffccd5 !important;
        color: #fff;
    }
  
    .fc-event {
        background-color: #d99e9e;
        border: 1px solid #d99e9e;
        color: white;
    }
  
    .fc-event:hover {
        background-color: #ffccd5;
        border: 1px solid #ffccd5;
        cursor: pointer;
    }
  
    .fc-title {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }
  
    .fc-button {
        background-color: white;
        color: gray;
        border: none;
        font-size: 14px;
        padding: 5px 15px;
        border-radius: 8px;
        text-transform: none;
        transition: all 0.3s ease;
    }

    .fc-button.fc-state-active {
        background-color: #d99e9e;
        color: white;
    }

    .fc-button:hover {
        color: black;
    }

    .fc-button.fc-state-disabled {
        color: lightgray;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        #calendar {
            width: 100%;
            padding: 10px;
        }
    }
</style>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="logoDental">CHARMING SMILE<br>DENTAL CLINIC</div>
        <div class="user-info">
            <span class="date">September 20, 2024</span>
            <div class="profile"><i class="fas fa-user-circle"></i></div>
        </div>
    </div>

    <div class="main-wrapper">
        <!-- Sidebar Menu -->
        <div class="sidebar">
            <ul class="nav">
                <li><span onclick="window.location.href='index.html';"><i class="fas fa-tachometer-alt"></i> Dashboard</span></li>
                <li><span onclick="window.location.href='recepManagement.html';"><i class="fas fa-users"></i> User Management</span></li>
                <li class="active"><span onclick="window.location.href='recepCalendar.php';"><i class="fas fa-calendar-alt"></i> Calendar</span></li>
                <li><span onclick="window.location.href='recepPayment.html';"><i class="fas fa-credit-card"></i> Payments</span></li>
                <li><span onclick="window.location.href='recepSMS.html';"><i class="fas fa-sms"></i> SMS</span></li>
                <li><span onclick="window.location.href='policy.html';"><i class="fas fa-file-alt"></i> Policy</span></li>
            </ul>
        </div>
        <div class="container">
            <div id="calendar"></div>
        </div>
    </div>
        <script>
                    $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '../php files/load.php',
                select: function(start, end, allDay) {
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    }
                },
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var dropdownButtons = document.querySelectorAll('.dropdown-btn');

            dropdownButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    this.classList.toggle('active');
                    var dropdownContainer = this.nextElementSibling;
                    if (dropdownContainer.style.display === 'block') {
                        dropdownContainer.style.display = 'none';
                    } else {
                        dropdownContainer.style.display = 'block';
                    }
                });
            });
        });
        </script>
</body>
</html>
