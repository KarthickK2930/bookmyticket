<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin-top: 150px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-image: url("img/lllbg.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .container {
            margin-block-end: 200px;
            padding-left: 550px;
            width: 300px;
            border-radius: 5px;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        

        .logo-container h1 {
            font-size: 2rem;
            color: #333;
            margin: 10px 0 0;
        }

        .loginform {
            max-width: 300px;
            margin: 0 auto;
        }

        .loginform h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input {
            margin-bottom: 15px;
        }

        .input label {
            display: block;
            margin-bottom: 5px;
        }

        .input input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            width: 108%;
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
    </style>
</head>
<body>
    <?php
        include('config.php');
        session_start(); 

        

        $un="";
        $pw="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $un = $_POST['username'];
            $pw = $_POST['password'];

            $result1 = $conn->query("SELECT id, username, pw FROM users WHERE username='$un'");

            $uname="";
            $password="";
            while ($row = $result1->fetch_assoc()) {
                $id=$row['id'];
                $uname=$row['username'];
                $password=$row['pw'];
            }

            if(($un==$uname) && ($pw==$password)) {
                $_SESSION['uid'] = $id;
                echo "<script>alert('Login successfully'); window.location='home2.html';</script>";
            } else {
                echo "<script>alert('Invalid Username Or Password'); window.location='login.php';</script>";
            }
        }
        $conn->close();
    ?>
    <div class="container">
        <div class="logo-container">
            <h1>MK-CINEMAS</h1>
        </div>
        <form class="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>User Log In</h2>
            <div class="input">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="off" required>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="off" required>
            </div>
            <button type="submit">Login</button>
            <h4 align="center">Create an account?<a href="signup.php">Sign Up</a></h4>
        </form>
    </div>
</body>
</html>
