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
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="admin.css" />
<title>Admin Dashboard</title>
</head>
    <body>
    <div class="dashboard" id="dashboard">
        <div class="text">Admin Dashboard</div>
    </div>
        <div class="container mt-4">
            <?php include('message.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Participants Details
                                <a href="participants_create.php" class="btn btn-primary float-end">Add Participant</a>
                                <a href="manage_subcategories.php" class="btn btn-secondary float-end mx-2">Manage
                                    Subcategories</a>
                            </h4>
                        </div>
                        <div class="card-body">
                        <!------- Search Form -------->
                        <form action="admin.php" method="GET" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." name="search_query">
                                <select class="form-select" name="filter_by">
                                    <option value="username">Username</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone Number</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                                <a href="admin.php" class="btn btn-outline-primary">Show All</a>
                            </div>
                            <div class="mb-3">
                                <label for="category">Filter by Category</label>
                                <select class="form-select" name="filter_category">
                                    <option value="">All Categories</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Veteran">Veteran</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="filter_subcategory">Filter by Subcategory</label>
                                <select class="form-select" name="filter_subcategory">
                                    <option value="">All Subcategories</option>
                                    <?php
                                    $subcategories_query = "SELECT * FROM subcategories";
                                    $subcategories_result = mysqli_query($con, $subcategories_query);

                                    if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                                        while ($subcategory = mysqli_fetch_assoc($subcategories_result)) {
                                            $selected = ($subcategory['name'] == $filter_subcategory) ? 'selected' : '';
                                            echo "<option value='{$subcategory['name']}' $selected>{$subcategory['name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                        <div class="mt-4">
                            <form action="code.php" method="post">
                                <h4>Set Maximum Quota for Subcategories</h4>
                                <?php
                                // Check if there is an error message
                                if (isset($_SESSION['error'])) {
                                    echo '<p class="text-danger">' . $_SESSION['error'] . '</p>';
                                    unset($_SESSION['error']);
                                }

                                $subcategories_query = "SELECT * FROM subcategories";
                                $subcategories_result = mysqli_query($con, $subcategories_query);

                                if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                                    foreach ($subcategories_result as $subcategory) {
                                        ?>
                                        <div class="mb-3">
                                            <label for="<?= $subcategory['name']; ?>_quota"><?= $subcategory['name']; ?> Maximum Quota:</label>
                                            <input type="number" class="form-control" name="<?= $subcategory['name']; ?>_quota" value="<?= $subcategory['max_quota']; ?>" min="0">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <button type="submit" name="set_quotas" class="btn btn-primary">Set Quotas</button>
                            </form>
                        </div>
                        <!-- Subcategory Quotas Table -->
                        <div class="table-responsive mt-4">
                            <div style="overflow-x:auto;">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subcategory</th>
                                            <th>Current Quota</th>
                                            <th>Max Quota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subcategories_query = "SELECT * FROM subcategories";
                                        $subcategories_result = mysqli_query($con, $subcategories_query);

                                        if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                                            foreach ($subcategories_result as $subcategory) {
                                                $current_quota_query = "SELECT COUNT(*) as current_quota FROM participants WHERE subcategory = '{$subcategory['name']}'";
                                                $current_quota_result = mysqli_query($con, $current_quota_query);

                                                $current_quota = ($current_quota_result && mysqli_num_rows($current_quota_result) > 0) ? mysqli_fetch_assoc($current_quota_result)['current_quota'] : 0;

                                                ?>
                                                <tr>
                                                    <td><?= $subcategory['name']; ?></td>
                                                    <td><?= $current_quota; ?></td>
                                                    <td><?= $subcategory['max_quota']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!---- Participants Table ------>
                        <div class="table-responsive mt-4">
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
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $search_query = isset($_GET['search_query']) ? mysqli_real_escape_string($con, $_GET['search_query']) : '';
                            $filter_by = isset($_GET['filter_by']) ? mysqli_real_escape_string($con, $_GET['filter_by']) : 'username';
                            $condition = !empty($search_query) ? "WHERE $filter_by LIKE '%$search_query%'" : '';

                            $filter_category = isset($_GET['filter_category']) ? mysqli_real_escape_string($con, $_GET['filter_category']) : '';
                            $filter_subcategory = isset($_GET['filter_subcategory']) ? mysqli_real_escape_string($con, $_GET['filter_subcategory']) : '';

                                if (!empty($filter_category)) {
                                    $condition .= empty($condition) ? "WHERE " : " AND ";
                                    $condition .= "category = '$filter_category'";
                                }

                                if (!empty($filter_subcategory)) {
                                    $condition .= empty($condition) ? "WHERE " : " AND ";
                                    $condition .= "subcategory = '$filter_subcategory'";
                                }

                                $query = "SELECT * FROM participants $condition";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $participants)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $participants['id']; ?></td>
                                            <td><?= $participants['username']; ?></td>
                                            <td><?= $participants['password']; ?></td>
                                            <td><?= $participants['phone']; ?></td>
                                            <td><?= $participants['email']; ?></td>
                                            <td><?= $participants['category']; ?></td>
                                            <td><?= $participants['subcategory']; ?></td>
                                            <td><?= $participants['user_type']; ?></td>
                                            <td>
                                                <a href="participants_view.php?id=<?= $participants['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                <a href="participants_edit.php?id=<?= $participants['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="code.php?delete_participants=<?= $participants['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                <a href="code.php?change_role=<?= $participants['id']; ?>" class="btn btn-warning btn-sm">Change Role</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<h5>No Record Found</h5>";
                                }
                            ?>
                            </tbody>
                        </table>
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