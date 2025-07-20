<?php
include('config.php');
session_start();


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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['gotp'])) {
        // Process OTP generation
        $mno = $_POST['mobilenumber'];
        $m1 = $conn->query("SELECT * FROM users WHERE mobile='$mno'");
        if ($m1->num_rows > 0) {
            $code = otpcode(); // Generate OTP
            $_SESSION['otp'] = $code;
             // Store OTP in session for verification
             $result =$conn->query("UPDATE users SET code='$code' WHERE mobile='$mno'");
            echo "<script>alert('Your OTP Is: $code');</script>"; // Display OTP in alert
        } else {
            echo "<script>alert('Enter Valid Phone Number');</script>";
        }
    } elseif (isset($_POST['make_payment'])) {
        // Process Payment
        $cardnumber = $_POST['cardnumber'];
        $expirydate = $_POST['expirydate'];
        $cvv = $_POST['cvv'];
        $otp = $_POST['otp'];

        // Validation and payment processing logic here
        // ...

        // Check if entered OTP is correct and proceed with payment
        if (!empty($otp) && $otp == $_SESSION['otp']) {
            echo "<script>window.location='confirmpayment.php';</script>";
        } elseif (!empty($otp)) {
            echo "<script>alert('Enter Valid OTP');</script>";   
        }
    }
}

// Function to generate OTP
function otpcode() {
    return rand(1000, 9999);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2980B9, #6DD5FA);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
        }

        /* Additional custom styles can go here */
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Enter Card Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" class="form-control" id="card_number" name="cardnumber" placeholder="Card Number" value="<?php if(isset($_POST['cardnumber'])) echo htmlspecialchars($_POST['cardnumber']); ?>" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiration Date:</label>
                <input type="text" class="form-control" id="expiry_date" name="expirydate" placeholder="MM/YY" value="<?php if(isset($_POST['expirydate'])) echo htmlspecialchars($_POST['expirydate']); ?>" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" value="<?php if(isset($_POST['cvv'])) echo htmlspecialchars($_POST['cvv']); ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile_number" name="mobilenumber" placeholder="Mobile Number" value="<?php if(isset($_POST['mobilenumber'])) echo htmlspecialchars($_POST['mobilenumber']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3" name="gotp">Generate OTP</button>
            <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP">
            </div>
            <button type="submit" class="btn btn-success" name="make_payment">Make Payment</button>
        </form>
    </div>

    <!-- Bootstrap JS, jQuery and Popper.js (for Bootstrap modal) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
