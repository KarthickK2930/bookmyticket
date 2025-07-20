<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies in MK CINEMAS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Basic styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        
        /* Header styles */
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

        /* Slider styles */
        .slider-container {
            position: relative;
            width: 99%;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slide {
            flex: 0 0 100%;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
            background: rgba(255, 255, 255, 0.5);
            padding: 10px;
            border-radius: 50%;
            font-size: 2em;
            color: #444;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        /* Movies section styles */
        .header1 {
            width: auto;
            padding: 10px;
            text-align: center;
            background: #ffff00;
            color: black;
            font-size: 30px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 1200px;
        }

        h3 {
            margin: 20px 0;
            text-align: center;
            font-size: 24px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        td {
            width: 25%;
            padding: 10px;
            text-align: center;
            vertical-align: top;
        }

        .movie-container {
            border: 5px solid black;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
        }

        .im {
            width: 100%;
            height: auto;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .no-movies {
            text-align: center;
            margin: 40px 0;
        }
    </style>
</head>
<body>
    <?php
        include('config.php');

    
    ?>
    <header>
        <h1 class="site-title">BookMyTicket<i class="fas fa-ticket-alt icon"></i> MK-CINEMAS</h1>
    </header>
    <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="img/raayan.png" alt="Slide 1"></div>
            <div class="slide"><img src="img/in2.png" alt="Slide 2"></div>
            <div class="slide"><img src="img/kalki.png" alt="Slide 3"></div>
            <div class="slide"><img src="img/dead.png" alt="Slide 4"></div>
            <div class="slide"><img src="img/boatslide.png" alt="Slide 5"></div>
            
        </div>
        <a class="prev" onclick="prevSlide()">&#10094;</a>
        <a class="next" onclick="nextSlide()">&#10095;</a>
    </div>
    <h3>NOW SHOWING</h3>
    <div class="container">
        <?php
        $result2 = $conn->query("SELECT * FROM movie");
        if (!$result2) {
            die("Query failed: " . mysqli_error($conn));
        }

        $moviesData = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        if (count($moviesData) > 0) {
            echo '<table>';
            $count = 0;
            foreach ($moviesData as $row):
                if ($count % 4 == 0) {
                    if ($count != 0) {
                        echo '</tr>';
                    }
                    echo '<tr>';
                }
                echo '<td>';
                echo '<div class="movie-container">';
                echo '<img class="im" src="adminmkcinemas/addmovieimg/' . $row['poster'] . '">';
                echo '<button type="submit" onclick="window.location=\'theatre.php?movieid=' . $row['movieid'] . '\';">Book Ticket</button>';
                echo '</div>';
                echo '</td>';
                $count++;
            endforeach;
            if ($count % 4 != 0) {
                echo str_repeat('<td></td>', 4 - ($count % 4));
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<div class="no-movies"><h2>No Movies Currently Available</h2></div>';
        }
        $conn->close();
        ?>

        
    </div>
    
    <script>
        let slideIndex = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.slide');
            if (index < 0) {
                slideIndex = slides.length - 1;
            } else if (index >= slides.length) {
                slideIndex = 0;
            } else {
                slideIndex = index;
            }
            const offset = -slideIndex * 100;
            document.querySelector('.slider').style.transform = `translateX(${offset}%)`;
        }

        function prevSlide() {
            showSlide(slideIndex - 1);
        }

        function nextSlide() {
            showSlide(slideIndex + 1);
        }

        // Auto slide
        setInterval(nextSlide, 5000);
    </script>
<?php   include('footer.php');?>
</body>
</html>
