<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url("img/signupimg.jpg");
        background-position: center;
        background-size: cover;
    }

    .container {
        
        width: 400px;
        padding: 40px;
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
    .container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form {
        margin-bottom: 20px;
    }

    .form label {
        display: block;
        margin-bottom: 5px;
    }

    .form input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<?php
include('config.php');
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $e = $_POST['email'];
    $mobile=$_POST['mobile'];
    $pw = $_POST['password'];
    $un = $fn."".$ln;
    $uname = "";
    $result = $conn->query("SELECT username FROM users WHERE username='$un'");
    $res = false;

    while ($row = $result->fetch_assoc()) {
        $uname = $row['username'];
        if ($un == $uname) {
            $res = true;
            break;
        }
    }

    if ($res) {
        echo "<script>alert('Username already exists'); window.location='signup.php';</script>";
    } else {
        $sql = "INSERT INTO users (fname, lname, username, email,mobile, pw) VALUES ('$fn','$ln','$un', '$e','$mobile', '$pw')";
        if ($conn->query($sql) == true) {
            $userid = $conn->insert_id;
            $_SESSION['uid'] = $userid;
            echo "<script>alert('Create Account Successfully'); window.location='home2.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="container">
<div class="logo-container">
            <h1>MK-CINEMAS</h1>
        </div>
    <h2>Sign Up</h2>
        <div class="form">
            <label for="firstName">First Name</label>
            <input type="text" id="firstname" name="firstname" autocomplete="off" required>
        </div>
        <div class="form">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastname" name="lastname" autocomplete="off" required>
        </div>
        <div class="form">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" autocomplete="off" required>
        </div>
        <div class="form">
            <label for="mobile">Mobile No</label>
            <input type="text" id="mobile" name="mobile" autocomplete="off" required>
        </div>
        <div class="form">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="off" required>
        </div>
        <div class="form">
            <input type="submit" value="Sign Up">
        </div>
        <h4 align="center">Already have an account?<a href="login.php">Log In</a></h4>
</div>
</form>
</body>
</html>
