<?php
session_start();
require 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
    $new_category = $_POST['category'];
    $new_subcategory = $_POST['subcategory'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $currentSubcategoryQuery = "SELECT * FROM subcategories WHERE name = '{$user_data['subcategory']}'";
    $currentSubcategoryResult = mysqli_query($con, $currentSubcategoryQuery);
    $currentSubcategoryData = mysqli_fetch_assoc($currentSubcategoryResult);

    $newSubcategoryQuery = "SELECT * FROM subcategories WHERE name = '$new_subcategory'";
    $newSubcategoryResult = mysqli_query($con, $newSubcategoryQuery);
    $newSubcategoryData = mysqli_fetch_assoc($newSubcategoryResult);

    if ($user_data['subcategory'] != $new_subcategory) {
        $updateNewQuotaQuery = "UPDATE subcategories SET current_quota = current_quota + 1 WHERE name = '$new_subcategory'";
        mysqli_query($con, $updateNewQuotaQuery);

        $updateCurrentQuotaQuery = "UPDATE subcategories SET current_quota = current_quota - 1 WHERE name = '{$user_data['subcategory']}'";
        mysqli_query($con, $updateCurrentQuotaQuery);

        $newCurrentQuota = $newSubcategoryData['current_quota'];
        $newMaxQuota = $newSubcategoryData['max_quota'];

        if ($newCurrentQuota > $newMaxQuota) {
            mysqli_query($con, "UPDATE subcategories SET current_quota = current_quota - 1 WHERE name = '$new_subcategory'");
            mysqli_query($con, "UPDATE subcategories SET current_quota = current_quota + 1 WHERE name = '{$user_data['subcategory']}'");

            $_SESSION['error_message'] = "The specified subcategory '{$new_subcategory}' is already full.";
            header("Location: participants_create.php");
            exit();
        }
    }

    $insert_participant_query = "INSERT INTO participants (username, password, phone, email, category, subcategory, user_type)
                                VALUES ('$new_username', '$hashed_password', '$new_phone', '$new_email', '$new_category', '$new_subcategory', '$user_type')";
    $insert_participant_result = mysqli_query($con, $insert_participant_query);

    if ($insert_participant_result) {
        $_SESSION['message'] = "Participant Created Successfully";
        header("Location: participants_create.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Participant Not Created";
        header("Location: participants_create.php");
        exit(0);
    }
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM participants WHERE id = $user_id";
    $result = mysqli_query($con, $query);
}
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $logged_in_user_type = $user_data['user_type'];
    }
        
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css" />
    <title>Entering New Participant Data</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Participant 
                            <a href="admin.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="participants_create.php" method="POST">

                            <div class="mb-3">
                                <label>Participant Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Participant Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Participant Phone Number</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Participant Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Participant Category</label>
                                <select name="category" class="form-control">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Veteran">Veteran</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Subcategory</label>
                                <select name="subcategory" class="form-control">
                                    <?php
                                    $subcategories_query = "SELECT * FROM subcategories";
                                    $subcategories_result = mysqli_query($con, $subcategories_query);

                                    if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                                        while ($subcategory = mysqli_fetch_assoc($subcategories_result)) {
                                            echo "<option value='{$subcategory['name']}'>{$subcategory['name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>User Type</label>
                                <select name="user_type" class="form-control">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_participants" class="btn btn-primary">Save Participant</button>
                                <?php
                                if (isset($_SESSION['error_message'])) {
                                    echo '<div class="alert alert-danger mt-2">' . $_SESSION['error_message'] . '</div>';
                                    unset($_SESSION['error_message']);
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-----------Sidebar----------->
<div class="container">
        <div class="sidebar">
            <div class="menu-btn">
                <i class="fa-solid fa-angle-left"></i>
            </div>
            <div class="head">
                <div class="user-img">
                    <img src="user-image.jpg" alt="" />
                </div>
                <div class="user-details">
                    <p class="name"><?= $user_data['username']; ?></p>
                    <p class="title"><?= $logged_in_user_type; ?></p>
                </div>
            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul class="menu-item">
                        <li >
                            <a href="admin.php">
                                <i class='bx bxs-dashboard icon'></i>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Tools</p>
                    <ul class="menu-item">
                        <li>
                            <a href="participants_create.php">
                            <i class='bx bxs-user-plus icon'></i>
                                <span class="text">Add Participants</span>
                            </a>
                        </li>
                        <li>
                            <a href="manage_subcategories.php">
                            <i class='bx bx-add-to-queue icon' ></i>
                                <span class="text">Manage <br>Subcategories</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <p class="title">Account</p>
                <ul class="menu-item">
                    <li>
                        <a href="logout.php">
                            <i class='bx bx-log-out-circle icon' ></i>
                            <span class="text">Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
                integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
                crossorigin="anonymous"></script>
            <script src="admin.js"></script>
        </body>
        </html>