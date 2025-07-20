<?php 
include('config.php');
include('dashboard.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Theatre Details</title>
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container1 {
        width: 90%;
        padding: 30px;
        margin-left: 2%;
        margin-top: 1%;
        background-color: #fff;
        border-radius: 8px;
    }

    /* Scrollable section for theatre details */
    .scroll-section1 {
        max-height: 400px; /* Set max height */
        overflow-y: auto;  /* Enable vertical scrolling */
        border: 2px solid #007bff;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
        position: sticky;
        top: 0;
    }

    img {
        margin-top: 5%;
        width: 100%;
        height: 50%;
    }
</style>
</head>
<body>
<div class="container1">
    <div class="scroll-section1">
        <div class="profile-info">
            <?php
            

            echo "<table>";
            // echo "<tr><th colspan='2'>Theatre Details</th></tr>";
            echo "<tr><td><label>Theatre Name:</label></td><td>MK-CINEMAS - Virudhunagar</td></tr>";
            echo "<tr><td><label>Address:</label></td><td>45 Main Road, Near Bus Stand</td></tr>";
            echo "<tr><td><label>Place:</label></td><td>Virudhunagar</td></tr>";
            echo "<tr><td><label>State:</label></td><td>Tamil Nadu</td></tr>";
            echo "<tr><td><label>Country:</label></td><td>India</td></tr>";
            echo "<tr><td><label>Pincode:</label></td><td>626001</td></tr>";
            echo "<tr><td><label>Facilities:</label></td><td>Dolby Atmos, 4K Projection, AC Hall</td></tr>";
            echo "<tr><td><label>Contact Number:</label></td><td>+91 98765 43210</td></tr>";
            echo "<tr><td><label>Email:</label></td><td>virudhunagar@mkcinemas.com</td></tr>";
            echo "</table>";
            ?>
        </div>
    </div>
</div>
</body>
</html>
