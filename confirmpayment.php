<?php
include('config.php');
session_start();
if (!isset($_SESSION['uname'])) {
    echo "Session expired. Please try booking again.";
    exit;
}

$uname = $_SESSION['uname'];
$email = $_SESSION['email'];
$mno = $_SESSION['mno'];
$mname = $_SESSION['mname'];
$sname = $_SESSION['screenname'];
$poster = $_SESSION['poster'];
$nseats = $_SESSION['naseats'];
$noseats = $_SESSION['noseats'];
$amount = $_SESSION['amount'];
$date = $_SESSION['date'];
$stid = $_SESSION['stid'];
$showid = $_SESSION['showid'];
$screenid = $_SESSION['screenid'];
$mid = $_SESSION['movieid'];

$payment_status = "success";

$_SESSION['uname']=$uname;
$_SESSION['email']=$email;
$_SESSION['mno']=$mno;
$_SESSION['mname']=$mname;
$_SESSION['screenname']=$sname;
$_SESSION['poster']=$poster;
$_SESSION['naseats']=$nseats;
$_SESSION['noseats']=$noseats;
$_SESSION['amount']=$amount;
$_SESSION['date']=$date;
$_SESSION['stid']=$stid;
$_SESSION['showid']=$showid;
$_SESSION['screenid']=$screenid;
$_SESSION['movieid']=$mid;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: bgFade 2s ease-in-out;
        }

        @keyframes bgFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .card {
            background-color: #fff;
            color: #000;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            text-align: center;
            animation: slideUp 1.2s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .success-icon {
            font-size: 60px;
            color: #28a745;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        .btn-custom {
            background: #007bff;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
        }

        .btn-custom:hover {
            background: #0056b3;
        }

        h2 {
            font-weight: 700;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php if ($payment_status === "success"): ?>
    <div class="card">
        <i class="bi bi-check-circle-fill success-icon"></i>
        <h2>Payment Successful!</h2>
        <p>Thank you <strong><?php echo $uname; ?></strong> for booking with <strong>BOOKMYTICKET</strong>.</p>

        <p>You will be redirected to your ticket shortly...</p>

        <!-- <a class="btn-custom" href="ticket.php">🎟 View Ticket</a> -->

        <script>
            setTimeout(function() {
                window.location.href = "ticket.php";  
            }, 5000); 
        </script>
    </div>
<?php else: ?>
    <div class="card">
        <i class="bi bi-x-circle-fill" style="font-size: 60px; color: red;"></i>
        <h2>Payment Failed</h2>
        <p>Oops! Something went wrong. Please try again.</p>
        <a class="btn-custom" href="confirmation.php">🔙 Go Back</a>
    </div>
<?php endif; ?>
</body>
</html>
