<?php
session_start();
require 'dbconnection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];


    $query = "SELECT * FROM participants WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $logged_in_user_type = $user_data['user_type'];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="admin.css" >
    <title>User Dashboard</title>
</head>
<body>
    <div class="dashboard" id="dashboard">
        <div class="text">User Dashboard</div>
    </div>
    <div class="container mt-4">
        <?php include('message.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Details</h4>
                        </div>
                        <div class="card-body">
                            <!-- User Profile Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $user_data['id']; ?></td>
                                            <td><?= $user_data['username']; ?></td>
                                            <td><?= $user_data['password']; ?></td>
                                            <td><?= $user_data['phone']; ?></td>
                                            <td><?= $user_data['email']; ?></td>
                                            <td><?= $user_data['category']; ?></td>
                                            <td><?= $user_data['subcategory']; ?></td>
                                            <td>
                                                <a href="edit_profile.php" class="btn btn-success btn-sm">Edit Profile</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else
            echo "<h5>Error fetching user data</h5>";
        } else {
            echo "<h5>User not logged in</h5>";
        }
        ?>
    <!-----------Sidebar----------->
    <div class="container">
    <div class="sidebar">
        <div class="menu-btn">
            <i class="fa-solid fa-angle-left"></i>
        </div>
        <div class="head">
            <div class="user-img">
                <img src="user-image.jpg" alt="">
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
                    <li>
                        <a href="user.php">
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
                        <a href="edit_profile.php">
                            <i class='bx bx-edit-alt icon' ></i>
                            <span class="text">Edit Profile</span>
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
