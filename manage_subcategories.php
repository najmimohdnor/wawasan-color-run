<?php
session_start();
require 'dbconnection.php';


if (isset($_POST['back_to_admin'])) {
    header("Location: admin.php");
    exit();
}


if (isset($_POST['edit_subcategory'])) {
    $edit_subcategory_id = mysqli_real_escape_string($con, $_POST['edit_subcategory']);
    header("Location: edit_subcategory.php?id=$edit_subcategory_id");
    exit();
}

if (isset($_POST['delete_subcategory'])) {
    $delete_subcategory_id = mysqli_real_escape_string($con, $_POST['delete_subcategory']);
    $delete_query = "DELETE FROM subcategories WHERE id='$delete_subcategory_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        $_SESSION['message'] = "Subcategory Deleted Successfully";
    } else {
        $_SESSION['message'] = "Error Deleting Subcategory";
    }

    header("Location: manage_subcategories.php");
    exit();
}


if (isset($_POST['add_subcategory'])) {
    $new_subcategory_name = mysqli_real_escape_string($con, $_POST['new_subcategory_name']);
    
    $insert_query = "INSERT INTO subcategories (name) VALUES ('$new_subcategory_name')";
    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
        $_SESSION['message'] = "Subcategory Added Successfully";
    } else {
        $_SESSION['message'] = "Error Adding Subcategory";
    }

    header("Location: manage_subcategories.php");
    exit();
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM participants WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $logged_in_user_type = $user_data['user_type'];

$query = "SELECT * FROM subcategories";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error in query: " . mysqli_error($con);
    exit();
}

$subcategories = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>Manage Subcategories</title>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Subcategories
                        <form action="" method="POST" class="d-inline">
                            <button type="submit" name="back_to_admin" class="btn btn-danger float-end">Back to Admin</button>
                        </form>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Add Subcategory Form -->
                    <form action="" method="POST" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="new_subcategory_name" class="form-control" placeholder="New Subcategory Name" required>
                            <button type="submit" name="add_subcategory" class="btn btn-primary">Add Subcategory</button>
                        </div>
                    </form>

                    <!-- Subcategories Table -->
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($subcategories as $subcategory): ?>
                            <tr>
                                <td><?= $subcategory['id']; ?></td>
                                <td><?= $subcategory['name']; ?></td>
                                <td>
                                    <form action="" method="POST" class="d-inline">
                                        <button type="submit" name="edit_subcategory" value="<?= $subcategory['id']; ?>"
                                                class="btn btn-success btn-sm">Edit
                                        </button>
                                    </form>
                                    <form action="" method="POST" class="d-inline">
                                        <button type="submit" name="delete_subcategory" value="<?= $subcategory['id']; ?>"
                                                class="btn btn-danger btn-sm">Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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