<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Dashboard</title>
    <link rel="stylesheet" href="denCalendar.css">
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
        width: 83.55%;
        margin: 0 auto;
        margin-top: 1px;
        margin-left: 16.28%;
        justify-content: center;
        position: absolute;
    }

    .container {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    
    .fc-header-toolbar {
        color: #333;
        padding: 10px;
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
                <button class="dropdown-btn">
                    <span><i class="fas fa-calendar-alt"></i> Calendar <i class="fas fa-chevron-down dropdown-icon"></i></span>
                </button>
                <ul class="dropdown-container">
                    <li><span onclick="window.location.href='denAppointments.html';"><i class="fas fa-notes-medical"></i> Appointments</span></li>
                    <li><span onclick="window.location.href='denRequest.html';"><i class="fas fa-notes-medical"></i> Request Approval</span></li>
                    <li class="active"><span onclick="window.location.href='denCalendar.php';"><i class="fas fa-notes-medical"></i> Calendar</span></li>
                </ul>
                <li><span onclick="window.location.href='denPatientlist.html';"><i class="fas fa-users"></i> Patient List</span></li>
                <li><span onclick="window.location.href='denPayment.html';"><i class="fas fa-credit-card"></i> Payments</span></li>
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
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt("Enter Event Title");
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: "../php files/insert.php",
                            type: "POST",
                            data: { title: title, start: start, end: end },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        })
                    }
                },
                editable: true,
                eventResize: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "../php files/update.php",
                        type: "POST",
                        data: { title: title, start: start, end: end, id: id },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Updated');
                        }
                    })
                },
                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "../php files/update.php",
                        type: "POST",
                        data: { title: title, start: start, end: end, id: id },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    });
                },
                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "../php files/delete.php",
                            type: "POST",
                            data: { id: id },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        })
                    }
                }
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
