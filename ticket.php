<?php
include('config.php');
session_start();



// Retrieve session data
$bmtid = $uname = $email = $mno = $mname = $sname = $stid = $poster = $seats = $nseats = $amount = $date = $showid = $screenid = $mid = '';
if (isset($_SESSION['uid'], $_SESSION['uname'], $_SESSION['email'], $_SESSION['mno'], $_SESSION['mname'], $_SESSION['screenname'], $_SESSION['stid'], $_SESSION['poster'], $_SESSION['naseats'], $_SESSION['noseats'], $_SESSION['amount'], $_SESSION['date'], $_SESSION['showid'], $_SESSION['screenid'], $_SESSION['movieid'])) {
    $bmtid = $_SESSION['uid'];
    $uname = $_SESSION['uname'];
    $email = $_SESSION['email'];
    $mno = $_SESSION['mno'];
    $mname = $_SESSION['mname'];
    $sname = $_SESSION['screenname'];
    $stid = $_SESSION['stid'];
    $poster = $_SESSION['poster'];
    $seats = $_SESSION['naseats'];
    $nseats = $_SESSION['noseats'];
    $amount = $_SESSION['amount'];
    $date = $_SESSION['date'];
    $showid = $_SESSION['showid'];
    $screenid = $_SESSION['screenid'];
    $mid = $_SESSION['movieid'];
} else {
    die("Required session variables are missing.");
}

$query = "INSERT INTO tickets (name, bmtid, email, notickets, seats, showid, screenid, ticketdate, cdate, amount) 
          VALUES ('$uname', '$bmtid', '$email', '$nseats', '$seats', '$showid', '$screenid', '$date', NOW(), '$amount')";

$viewticketquery = "INSERT INTO viewtickets (name,bmtid,email,mobileno,moviename,screenname,showtime,poster,notickets, seats,showid,screenid, ticketdate, cdate, amount) 
          VALUES ('$uname', '$bmtid', '$email','$mno','$mname','$sname','$stid','$poster', '$nseats', '$seats', '$showid', '$screenid', '$date', NOW(), '$amount')";

if ($conn->query($viewticketquery) === TRUE) {
    $viewticketid = $conn->insert_id;
} else {
    die("Error: " . $query . "<br>" . $conn->error);
}

if ($conn->query($query) === TRUE) {
    
    $ticketid = $conn->insert_id;
    $_SESSION['ticket_id'] = $ticketid; 
} else {
    die("Error: " . $query . "<br>" . $conn->error);
}

$query = "SELECT * FROM tickets WHERE ticketid = '$ticketid'";
$result = $conn->query($query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Ticket not found.");
}

$ticket = mysqli_fetch_assoc($result);


$serverIP = "192.168.1.5"; // Change this to your actual server IP
$qrLink = "http://$serverIP/MK-CINEMAS/download.php?ticketid=$ticketid";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cinema Ticket</title>
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
            <p>Ticket ID: <?php echo $ticket['ticketid']; ?></p>
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
