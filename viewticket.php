<?php
include('config.php');

$ticketid = isset($_GET['ticketid']) ? $_GET['ticketid'] : '';
$bmtid = isset($_GET['bmtid']) ? $_GET['bmtid'] : '';

if (empty($ticketid) || empty($bmtid)) {
    die("Missing ticket ID or BMT ID.");
}

$query = "SELECT * FROM viewtickets WHERE viewticketid = '$ticketid' AND bmtid = '$bmtid'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Ticket not found.");
}

$ticket = mysqli_fetch_assoc($result);


$mname = $ticket['moviename'];
$sname = $ticket['screenname'];
$stid = $ticket['showtime'];
$poster = $ticket['poster'];
$mno = $ticket['mobileno'];

$serverIP = "192.168.1.5";
$qrLink = "http://$serverIP/MK-CINEMAS/download.php?ticketid=$ticketid";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .ticket {
            max-width: 400px;
            margin: 10px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #e50914;
            font-size: 28px;
            margin: 0;
        }

        .movie-details, .customer-details {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .movie-details h2, .customer-details h2 {
            color: #e50914;
            font-size: 20px;
            margin-top: 0;
        }

        .movie-details p, .customer-details p {
            margin: 10px 0;
            color: #555;
        }

        .img-container {
            float: right;
            margin-top: -225px;
            margin-right: 10px;
            width: 150px;
            height: 150px;
            overflow: hidden;
        }

        .img {
            width: 100%;
            height: auto;
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            background-color: #e50914;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .ticket-info p {
            margin: 0;
        }

        .print-button {
            background-color: #e50914;
            color: white;
            margin-left: 45%;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #000000;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="header">
        <h1>BookMyTicket</h1>
    </div>

    <div class="movie-details">
        <h2>Movie Details</h2>
        <p>Ticket ID: <?php echo $ticket['viewticketid']; ?></p>
        <p>Movie: <?php echo $mname; ?></p>
        <p>Date: <?php echo date("d F Y", strtotime($ticket['ticketdate'])); ?></p>
        <p>Time: <?php echo date("h:i A", strtotime($stid)); ?></p>
        <p>Screen Name: <?php echo $sname; ?></p>
        <p>No.of Tickets: <?php echo $ticket['notickets']; ?></p>
        <p>Seats: <?php echo $ticket['seats']; ?></p>
        <div class="img-container">
            <img src="adminmkcinemas/addmovieimg/<?php echo $poster; ?>" class="img">
        </div>
    </div>

    <div class="customer-details">
        <h2>Customer Details</h2>
        <p>Name: <?php echo $ticket['name']; ?></p>
        <p>BMT ID: <?php echo $ticket['bmtid']; ?></p>
        <p>Email: <?php echo $ticket['email']; ?></p>
        <p>Mobile No: <?php echo $mno; ?></p>
    </div>

    <div class="qr-code">
        <canvas id="qrCodeCanvas"></canvas>
    </div>

    <div class="ticket-info">
        <p class="ticket-type">Ticket Type: Premium</p>
        <p class="ticket-price">₹<?php echo $ticket['amount']; ?></p>
    </div>

    <div class="footer">
        <p>&copy; 2024 BookMyTicket. All rights reserved.</p>
    </div>
</div>

<button class="print-button" onclick="printTicket()">Download Ticket</button><br><br>
<button class="print-button" onclick="window.location='home2.html'">Back To Home</button>

<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script>
    var qr = new QRious({
        element: document.getElementById('qrCodeCanvas'),
        value: "<?php echo $qrLink; ?>",
        size: 200
    });

    function printTicket() {
        window.print();
    }
</script>
</body>
</html>
