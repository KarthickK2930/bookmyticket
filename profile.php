<?php
include('config.php');
session_start();




$userid = $_SESSION['uid'];
$userdetails = $conn->query("SELECT * FROM users WHERE id='$userid'");
$row = $userdetails->fetch_assoc();
$uid = $row['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        /* .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        } */

        h1, h2 {
            color: #e50914;
            text-align: center;
            margin-bottom: 20px;
        }

        /* User Details Table */
        .profile-table {
            width: 60%;
            margin: 0 auto 40px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-table th, .profile-table td {
            padding: 14px 20px;
            text-align: left;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }

        /* .profile-table th {
            background-color: #e50914;
            color: #fff;
            width: 30%;
            font-weight: 500;
        } */

        .profile-table td {
            background-color: #fafafa;
            color: #333;
        }

        /* Booking History Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 14px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #e50914;
            color: #fff;
            font-weight: 600;
        }

        td {
            background-color: #fafafa;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        button {
            padding: 8px 15px;
            background-color: #e50914;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        button:hover {
            background-color: #d40512;
        }

        .nobook {
            font-size: 18px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }

        .back-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 12px;
            text-align: center;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            .profile-table {
                width: 90%;
                font-size: 14px;
            }

            .profile-table th, .profile-table td {
                padding: 10px;
            }

            table th, table td {
                font-size: 14px;
                padding: 10px;
            }

            .container {
                padding: 20px;
            }

            .back-btn {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>WELCOME TO MK-CINEMAS</h1>

    <div class="profile-info">
        <!-- <h2>USER DETAILS</h2> -->
        <table class="profile-table">
            <tr>
                <th>BMT ID</th>
                <td><?php echo $row['id']; ?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo $row['fname']; ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?php echo $row['lname']; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo $row['username']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
        </table>
    </div>

    <div class="booking-history">
        <h2>BOOKING HISTORY</h2>
        <?php
        $bookinghistory = $conn->query("SELECT * FROM tickets WHERE bmtid='$uid'");
        if ($bookinghistory->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>S.NO</th><th>TICKET ID</th><th>NAME</th><th>NO. OF TICKETS</th><th>SEATS</th><th>TICKET DATE</th><th>AMOUNT</th><th>VIEW TICKET</th></tr>";
            $sno = 1;
            while ($booking = $bookinghistory->fetch_assoc()) {
                echo "<tr>";
                echo "<td>$sno</td>";
                echo "<td>{$booking['ticketid']}</td>";
                echo "<td>{$booking['name']}</td>";
                echo "<td>{$booking['notickets']}</td>";
                echo "<td>{$booking['seats']}</td>";
                echo "<td>{$booking['ticketdate']}</td>";
                echo "<td>₹{$booking['amount']}</td>";
                echo "<td><a href='viewticket.php?ticketid={$booking['ticketid']}&bmtid={$booking['bmtid']}'><button>View Ticket</button></a></td>";
                echo "</tr>";
                $sno++;
            }
            echo "</table>";
        } else {
            echo "<div class='nobook'>No booking history found.</div>";
        }
        ?>
    </div>

    <a href="home2.html" class="back-btn">Back</a>
</div>

</body>
</html>
