<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom CSS styles */
        body {
            background: linear-gradient(135deg, #2980B9, #6DD5FA); /* Gradient background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 80%;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 2s ease; /* Animation with 2 seconds delay */
            padding: 20px;
            margin-top: 100px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .card {
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .movie-title {
            font-size: 24px;
            font-weight: bold;
        }
        .details {
            margin-top: 20px;
        }
        .btn-confirm {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
        .user-info {
            margin-top: 30px;
        }
        .summary {
            margin-top: 30px;
        }
        .site-name {
    position: absolute;
    top: 20px; /* Adjust as needed */
    left: 50%;
    transform: translateX(-50%);
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    color: #fff; /* Text color */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Text shadow for better visibility */
}

    </style>
</head>
<body>

<?php
include('config.php');
session_start();


$ticketid = "";
$mname = "";
$poster = "";
$tname = "";
$sname = "";
$stid = "";
$nseats = "";
$amount = "";
$date = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['showid']) && isset($_POST['stimeid']) && isset($_POST['mid']) &&  isset($_POST['screenid']) && isset($_POST['date']) && isset($_POST['price']) && isset($_POST['seats'])) {
        $showid = $_POST['showid'];
        $showtimeid = $_POST['stimeid'];
        $mid = $_POST['mid'];
        $screenid = $_POST['screenid'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $selectedSeats = $_POST['seats'];
        $uid = $_SESSION['uid'];
        $u1 = "SELECT * FROM users WHERE id='$uid'";
        $result_user = mysqli_query($conn, $u1);
        if ($result_user && mysqli_num_rows($result_user) > 0) {
            $row1 = mysqli_fetch_assoc($result_user);
            $uname = $row1['username'];
            $bmtid = $row1['id'];
            $email = $row1['email'];
            $mno = $row1['mobile'];
        } else {
            echo "Error fetching user data: " . mysqli_error($conn);
            exit; // Stop further execution
        }

        // Check if seats are selected
        if (!empty($selectedSeats)) {
            $seatNames = array(); // Initialize array to store seat names like "A1", "A2", etc.
            foreach ($selectedSeats as $seat) {
                // Extract row and seat number from the seat name like "checkbox1"
                $seatNumber = filter_var($seat, FILTER_SANITIZE_NUMBER_INT);
                $rowLabel = chr((intval(filter_var($seat, FILTER_SANITIZE_NUMBER_INT)) - 1) / 20 + 65); // Convert seat number to row label like "A"
                // Concatenate row label with seat number to get seat name like "A1", "A2", etc.
                $seatName = $rowLabel . $seatNumber;
                $seatNames[] = $seatName; // Add seat name to the array
            }
            $no = count($selectedSeats);
            $seats = implode(', ', $seatNames); // Convert array of seat names to comma-separated string
            $amount = $no * $price;

                // Fetch movie details
                $m1 = $conn->query("SELECT * FROM movie WHERE movieid='$mid'");
                if ($m1 && $m1->num_rows > 0) {
                    $movie = $m1->fetch_assoc();
                    $mname = $movie['moviename'];
                    $poster = $movie['poster'];
                }


                // Fetch screen details
                $s1 = $conn->query("SELECT * FROM screens WHERE screenid='$screenid'");
                if ($s1 && $s1->num_rows > 0) {
                    $screen = $s1->fetch_assoc();
                    $sname = $screen['screenname'];
                }

                // Fetch showtime details
                $st1 = $conn->query("SELECT * FROM showtime WHERE showtimeid='$showtimeid'");
                if ($st1 && $st1->num_rows > 0) {
                    $showtime = $st1->fetch_assoc();
                    $stid = $showtime['showtime'];
                }

                $nseats = $seats;
        }
        } else {
            echo "<font size='50px'>Please select at least one seat.</font>";
            exit; // Stop further execution
        }
    } else {
        echo "Required form fields are missing.";
        exit; // Stop further execution
    }
    $_SESSION['uname']=$uname;
    $_SESSION['email']=$email;
    $_SESSION['mno']=$mno;
    $_SESSION['mname']=$mname;
    $_SESSION['screenname']=$sname;
    $_SESSION['poster']=$poster;
    $_SESSION['naseats']=$nseats;
    $_SESSION['noseats']=$no;
    $_SESSION['amount']=$amount;
    $_SESSION['date']=$date;
    $_SESSION['stid']=$stid;
    $_SESSION['showid']=$showid;
    $_SESSION['screenid']=$screenid;
    $_SESSION['movieid']=$mid;
?>

<div class="site-name text-center">BOOKMYTICKET</div>
<div class="container">
    <div class="card">
        <div class="card-header">
            Movie Details
        </div>
        <div class="card-body">
            <div class="movie-title">Movie Name: <?php echo $mname; ?></div>
            <div class="details">
                <p>Screen: <?php echo $sname; ?></p>
                <p>Showtime: <?php echo date("h:i A", strtotime($stid)); ?></p>
                <p>Selected Seats: <?php echo $nseats; ?></p>
                <p>Total Amount: <?php echo "₹" . $amount; ?></p>
                <p>Date: <?php echo date("d F Y", strtotime($date)); ?></p>
            </div>
        </div>
    </div>

    <div class="card user-info">
        <div class="card-header">
            User Information
        </div>
        <div class="card-body">
            <p>Username: <?php echo $uname; ?></p>
            <p>BMT ID: <?php echo $uid; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Mobile No: <?php echo $mno; ?></p>
        </div>
    </div>

    

    <div class="text-center">
            <button type="submit" class="btn-confirm" onclick="window.location='payment.php'">Confirm Payment</button><br><br>
            <button type="submit" class="btn-confirm" onclick="history.back()">Back</button>
    </div>
</div>
</body>
</html>
