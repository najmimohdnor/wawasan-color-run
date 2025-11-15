<?php
session_start();
require_once("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $confirmPassword = $_POST['confirm'];

    $userType = 'user';

    // Check if email already exists
    $emailCheckQuery = "SELECT * FROM participants WHERE email = LOWER('$email')";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows == 0) {
        // Check if username already exists
        $usernameCheckQuery = "SELECT * FROM participants WHERE username = '$username'";
        $usernameCheckResult = $conn->query($usernameCheckQuery);

        if ($usernameCheckResult->num_rows == 0) {
            if (password_verify($confirmPassword, $password)) {
                $_SESSION['user_details'] = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'user_type' => $userType,
                ];

                header("Location: event_registration.php");
                exit();
            } else {
                $_SESSION['error'] = "Passwords do not match";
                header("Location: signup.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Username already exists";
            header("Location: signup.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email already exists";
        header("Location: signup.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!------css style---->
    <link rel="stylesheet" href="form.css">

    <!------ Icons-------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>Sign In | Wawasan Color Run </title>
</head>
<body>
<section class="form">
    <div class="form_container ">
    <a href="index.php" class="form-close-link"><i class='bx bx-x form-close'></i></a>
    <div class="form signup_form">
    <form action="signup.php" method="POST">
        <h2>Sign Up</h2>
        <div class="msg">
        <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
        ?>
        </div>
        <div class="input_box">
            <input type="text" placeholder="Enter your username" name="username" autocomplete="off" required/>
            <i class='bx bx-user name' ></i>
        </div>
        <div class="input_box">
            <input type="email" placeholder="Enter your email" name="email" autocomplete="off" required/>
            <i class='bx bx-envelope mail' ></i>
        </div>
        <div class="input_box">
            <input type="password" placeholder="Create a password" autocomplete="off" name="pass" required/>
            <i class='bx bx-dialpad-alt pass' ></i>
            <i class="uil uil-eye-slash hide"></i>
        </div>
        <div class="input_box">
            <input type="password" placeholder="Confirm your password" autocomplete="off" name="confirm"required/>
            <i class='bx bx-dialpad-alt pass' ></i>
            <i class="uil uil-eye-slash hide"></i>
        </div>
            <button class="button">Register Now</button>
            <div class="login_signup">
                Already have an account? <a href="signin.php" id="login">Sign In</a>
            </div>
            </form>
        </div>
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pwShowHide = document.querySelectorAll(".hide");

            pwShowHide.forEach((icon) => {
                icon.addEventListener("click", () => {
                    let getPwInput = icon.parentElement.querySelector("input");
                    if (getPwInput.type === "password") {
                        getPwInput.type = "text";
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    } else {
                        getPwInput.type = "password";
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    }
                });
            });
        });
    </script>
    <script src="form.js"></script>
    </body>
</html>