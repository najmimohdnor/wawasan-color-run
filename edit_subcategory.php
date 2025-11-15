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

        if (isset($_GET['id'])) {
            $edit_subcategory_id = mysqli_real_escape_string($con, $_GET['id']);
            $edit_query = "SELECT * FROM subcategories WHERE id='$edit_subcategory_id'";
            $edit_result = mysqli_query($con, $edit_query);

            if ($edit_result && mysqli_num_rows($edit_result) > 0) {
                $subcategory_data = mysqli_fetch_assoc($edit_result);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $edited_subcategory_name = mysqli_real_escape_string($con, $_POST['edited_subcategory_name']);

                    $update_query = "UPDATE subcategories SET name='$edited_subcategory_name' WHERE id='$edit_subcategory_id'";
                    $update_result = mysqli_query($con, $update_query);

                    if ($update_result) {
                        $_SESSION['message'] = "Subcategory Updated Successfully";
                        header("Location: manage_subcategories.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Error Updating Subcategory";
                    }
                }
            } else {
                $_SESSION['message'] = "Subcategory not found.";
                header("Location: manage_subcategories.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Invalid request.";
            header("Location: manage_subcategories.php");
            exit();
        }
        ?>

        <!DOCTYPE html>
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
        <title>Edit Subcategory</title>
        </head>
        <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Subcategory
                                <a href="manage_subcategories.php" class="btn btn-danger float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Edit Subcategory Form -->
                            <form action="" method="POST">
                                <div class="input-group">
                                    <input type="text" name="edited_subcategory_name" class="form-control"
                                           value="<?= $subcategory_data['name'] ?>" required>
                                    <button type="submit" class="btn btn-primary">Update Subcategory</button>
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
        <?php
    } else {
        echo "<h5>Error fetching user data</h5>";
    }
} else {
    echo "<h5>User not logged in</h5>";
}
?>