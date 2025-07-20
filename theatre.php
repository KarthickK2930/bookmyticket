<?php
    include('config.php');

    $movieId = isset($_GET['movieid']) ? $_GET['movieid'] : '';
    $d1 = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");

    // Get movie details
    $result = $conn->query("SELECT * FROM movie WHERE movieid='$movieId'");
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $moviesData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $row = !empty($moviesData) ? $moviesData[0] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Screens</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            width: 97.5%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            margin: 0px auto;
        }

        .site-title {
            font-size: 2.1em;
            font-weight: bold;
            margin: 0;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .icon {
            font-size: 2em;
            margin-bottom: -20px;
            color: #ffcc00;
            transition: color 0.3s, transform 0.3s;
        }

        .icon:hover {
            color: #fff;
            transform: scale(1.1);
        }

        .movie-details-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            padding: 0 50px;
        }

        .container {
            flex: 1;
            margin-right: 20px;
        }

        .movie h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .movie p {
            font-size: 1.2em;
            margin: 55px 0;
        }

        .trailer-box {
            flex: 1;
            max-width: 100%;
            height:20%;
            position: sticky;
            top: 20px;
        }

        .video-container {
            position: relative;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .video-container img {
            width: 30%;
            margin-left:35%;
            border-radius: 8px;
            filter: brightness(0.8) contrast(1.1);
            transition: transform 0.3s;
        }

        .video-container:hover img {
            transform: scale(1.05);
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        .play-button:hover {
            transform: translate(-50%, -50%) scale(1.1);
        }

        .play-button::before {
            content: '▶';
            color: #ffcc00;
            font-size: 42px;
        }

        #video-frame {
            display: none;
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 5px 20px rgba(255, 204, 0, 0.6);
        }

        .date {
            width: 98%;
            background-color: #C0C0C0;
            border-radius: 5px;
            margin-top: 2%;
            padding: 15px;
            display: flex;
            align-items: center;
        }

        .vertical-label {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            white-space: nowrap;
            background-color: grey;
            color: #fff;
            padding: 5px;
            font-weight: normal;
            font-family: 'Courier New', Courier, monospace;
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            margin-left: -5px;
        }

        button[type="submit"] {
            padding: 6px 16px;
            background-color: black;
            color: #fff;
            border: none;
            margin-left: 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        table.a1 {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        td.tw1 {
            width: 25%;
            background-color: #222;
            color: #ffcc00;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            border-radius: 8px 0 0 8px;
        }

        td.tw2 {
            width: 75%;
            padding: 15px;
            background-color: #f8f8f8;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .booking-btn {
            padding: 10px 14px;
            background-color: #222;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
        }

        .booking-btn:hover {
            background-color: #ffcc00;
            color: #222;
            transform: scale(1.05);
        }
        .y1{
            margin-left:40%;
            width: 40px; 
            vertical-align: middle; 
        }
    </style>
</head>
<body>
<header>
    <h1 class="site-title">BookMyTicket <i class="fas fa-ticket-alt icon"></i> MK-CINEMAS</h1>
</header>

<div class="movie-details-container">
    <div class="container">
        <div class="movie">
            <h1><?php echo $row['moviename']; ?></h1>
            <p>Duration: <?php echo $row['duration']; ?> Minutes</p>
            <p>Language: <?php echo $row['languages']; ?></p>
            <p>Year: <?php echo $row['years']; ?></p>
        </div>
    </div>
    <div class="trailer-box">
        <div class="video-container" id="video-container">
            <img src="adminmkcinemas/addmovieimg/<?php echo $row['poster']; ?>" alt="Click to Play Video">
            <div class="play-button" onclick="playVideo()"></div>
        </div>
        <iframe id="video-frame" src="<?php echo $row['trailer']; ?>" allowfullscreen></iframe>
        <br>
        <img class="y1" src="https://www.svgrepo.com/show/13671/youtube.svg" alt="YouTube">&nbsp&nbsp<b>Watch Trailer</b>
    </div>
</div>

<div class="date">
    <?php
    $labelDisplayed = false;
    for ($i = 0; $i < 10; $i++) {
        $date = date('Y-m-d', strtotime("+$i days"));
        $monthLabel = date('M', strtotime($date));

        if (!$labelDisplayed || ($monthLabel !== date('M', strtotime("-1 day", strtotime($date))))) {
            echo '<div class="vertical-label">' . $monthLabel . '</div>';
            $labelDisplayed = true;
        }
        ?>
        <a href="theatre.php?movieid=<?php echo $movieId; ?>&date=<?php echo $date; ?>">
            <button class="bd" type="submit">
                <?php echo date('d', strtotime($date)); ?>
                <br>
                <?php echo date('D', strtotime($date)); ?>
            </button>
        </a>
    <?php } ?>
</div>

<?php
// Show list of theatres and shows
$result1 = $conn->query("SELECT DISTINCT screenid FROM tshows WHERE movieid='$movieId'");
while ($row1 = $result1->fetch_assoc()) {
    $sid = $row1['screenid'];

    $tres1 = $conn->query("SELECT * FROM screens WHERE screenid='$sid'");
    $theatre = mysqli_fetch_assoc($tres1);

    echo "<table class='a1'><tr>";
    ?>
    <td class="tw1">
        <h3><?php echo $theatre['screenname']; ?></h3>
    </td>
    <td class="tw2">
    <?php
        $currentDate = date('Y-m-d');
        $sshow = $conn->query("SELECT * FROM tshows WHERE movieid='$movieId' AND screenid='$sid'");
        $showsFound = false;

        while ($showtime = mysqli_fetch_assoc($sshow)) {
            $stid = $showtime['showtimeid'];
            $startdate = $showtime['startdate'];
            $status = $showtime['status'];

            // Show button only if:
            // - It's a future date OR
            // - It's today AND status is 1
            if (($d1 > $currentDate) || ($d1 == $currentDate && $status == '1')) {
                if ($d1 >= $startdate) {
                    $time1 = $conn->query("SELECT * FROM showtime WHERE showtimeid='$stid'");
                    $time2 = mysqli_fetch_assoc($time1);
                    ?>
                    <button class="booking-btn" onclick="window.location.href='booking.php?show=<?php echo $showtime['showid']; ?>&showtime=<?php echo $stid; ?>&movie=<?php echo $movieId; ?>&screen=<?php echo $sid;?>&date=<?php echo $d1 != '' ? $d1 : date('Y-m-d'); ?>'">
                        <?php echo date('h:i A', strtotime($time2['showtime'])); ?>
                    </button>
                    <?php
                    $showsFound = true;
                }
            }
        }

        if (!$showsFound) {
            echo "<p>No shows available on selected date.</p>";
        }
    ?>

    </td>

    <?php
    echo "</tr></table>";
}
$conn->close();
?>

<script>
    function playVideo() {
        const videoContainer = document.getElementById('video-container');
        const videoFrame = document.getElementById('video-frame');
        videoContainer.style.display = 'none';
        videoFrame.style.display = 'block';
    }
</script>
</body>
</html>