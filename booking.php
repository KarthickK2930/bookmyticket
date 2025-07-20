<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('cinema_bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
            overflow: auto;
        }

        .container {
            background-color: #ffffff;
            height: 90%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            perspective: 900px;
        }

        .seat {
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            margin: 5px;
            background-color: #fff;
            border: 1px solid lightblue;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .seat.available:hover {
            background-color: #d9d9d9;
        }

        .seat.selected {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .seat.occupied {
            background-color: #C0C0C0;
            cursor: not-allowed;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .row-label {
            font-weight: bold;
            color: #000;
            margin-right: 10px;
        }

        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .checkbox-container .row {
            margin: 5px 0;
        }

        .checkbox-container .row > div {
            margin-right: 10px;
        }

        .checkbox-container input[type='checkbox'] {
            display: none;
        }

        .checkbox-container input[type='checkbox'] + label {
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            margin: 5px;
            background-color: #fff;
            border: 1px solid lightblue;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkbox-container input[type='checkbox']:checked + label {
            background-color: #007bff;
            color: #fff;
        }

        .checkbox-container input[type='checkbox']:disabled + label {
            background-color: #999;
            cursor: not-allowed;
        }

        .checkbox-container input[type='checkbox']:hover + label {
            background-color: #d9d9d9;
        }

        .booking-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        .booking-btn:hover {
            background-color: #0056b3;
        }

        .showcase {
            background: lightblue;
            padding: 5px 10px;
            color: #fff;
            border-radius: 5px;
            list-style-type: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            position: fixed;
            top: -15px;
            left: 0;
            height: 9%;
            width: 100%;
            z-index: 999;
        }

        .showcase li {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 10px;
        }

        .showcase li small {
            margin: 2px;
        }

        .screen-img {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            height: 75px;
            z-index: 999;
        }

        .scroll-container {
            padding-top: 40px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: calc(100vh - 150px);
            margin-right: -15px;
        }

        .line {
            width: 100%;
            border-top: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .d1 {
            margin-right: 50%;
        }

        .p1 {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
include('config.php');


$showid = $_GET['show'];
$stimeid = $_GET['showtime'];
$mid = $_GET['movie'];
$screenid = $_GET['screen'];
$date = $_GET['date'];

function numToAlphabet($num) {
    return chr($num + 64);
}

$seats = "";
$price = 0;
$result1 = $conn->query("SELECT * FROM screens WHERE screenid='$screenid'");
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $seats = $row1['seats'];
    $price = $row1['price'];
}

$bookedSeats = array();
$sql = "SELECT seats FROM tickets WHERE showid='$showid' AND screenid='$screenid' AND ticketdate='$date'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedSeats = array_merge($bookedSeats, explode(', ', $row['seats']));
    }
}

echo "<ul class='showcase'>";
echo "<div class='d1'>" . date('l, d F', strtotime($date)) . "</div>";
echo "<li><div class='seat'></div><small>Available</small></li>";
echo "<li><div class='seat selected'></div><small>Selected</small></li>";
echo "<li><div class='seat occupied'></div><small>Occupied</small></li>";
echo "</ul>";
echo "<div class='line'></div>";

echo "<div class='scroll-container'>";
echo "<div class='container'>";
echo "<div class='checkbox-container'>";
echo "<form action='confirmticket.php' method='post'>";
echo "<div class='p1'>PREMIUM : ₹" . $price . "</div>";

$rowNumber = 1;
for ($i = 1; $i <= $seats; $i++) {
    if (($i - 1) % 20 == 0) {
        echo "<div class='row'><div class='row-label'>" . numToAlphabet($rowNumber) . "</div>";
        $rowNumber++;
    }
    $seatName = numToAlphabet($rowNumber - 1) . $i;
    $isBooked = in_array($seatName, $bookedSeats);
    echo "<input type='checkbox' id='checkbox$i' name='seats[]' value='$seatName' " . ($isBooked ? "disabled" : "") . ">";
    echo "<label for='checkbox$i' title='$seatName'></label>";
    if ($i % 20 == 0 || $i == $seats) {
        echo "</div>";
    }
}

echo "</div>";
echo "<input type='hidden' name='showid' value='$showid'>";
echo "<input type='hidden' name='stimeid' value='$stimeid'>";
echo "<input type='hidden' name='mid' value='$mid'>";
echo "<input type='hidden' name='screenid' value='$screenid'>";
echo "<input type='hidden' name='date' value='$date'>";
echo "<input type='hidden' name='price' value='$price'>";
echo "<button class='booking-btn' type='submit'>Book Ticket</button>";
echo "</form>";
echo "</div>";
echo "</div>";
?>
<img class="screen-img" src="https://assetscdn1.paytm.com/movies_new/_next/static/media/screen-icon.8dd7f126.svg" decoding="async">
</body>
</html>
