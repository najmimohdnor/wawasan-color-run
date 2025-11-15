<?php
session_start();
require_once("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower($_POST['email']); 
    $password = $_POST['password'];

    $query = "SELECT * FROM participants WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $userType = $row['user_type'];

            if ($userType == 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: user.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: signin.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid email or password";
        header("Location: signin.php");
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
<body>
    <!------------Form------------>
    <section class="form">
        <div class="form_container ">
        <a href="index.php" class="form-close-link"><i class='bx bx-x form-close'></i></a>
        <div class="form login_form">
            <form action="signin.php" method="post">
                <h2>Sign In</h2>
                <div class="msg">
                <?php
                    if (isset($_SESSION['error'])) {
                        echo '<p class="error">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']);
                    }
                ?>
                </div>
                <div class="input_box">
                    <input type="email" placeholder="Enter your email" name="email" required/>
                    <i class='bx bx-envelope mail' ></i>
                </div>
                <div class="input_box">
                    <input type="password" placeholder="Enter your password" name="password" required/>
                    <i class='bx bx-dialpad-alt pass' ></i>
                    <i class="uil uil-eye-slash hide"></i>
                </div>
                <button class="button">Login Now</button>
                <div class="login_signup">
                    Don't have an account? <a href="signup.php" id="signup">Sign Up</a>
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