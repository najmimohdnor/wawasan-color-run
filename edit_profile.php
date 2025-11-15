<?php
session_start();
require 'dbconnection.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                header("Location: edit_profile.php");
                exit();
            }
        }
        $updateQuery = "UPDATE participants SET 
                        password = '$hashed_password', 
                        phone = '$new_phone', 
                        email = '$new_email', 
                        category = '$new_category', 
                        subcategory = '$new_subcategory'
                        WHERE id = $user_id";

        mysqli_query($con, $updateQuery);

        $_SESSION['message'] = "Profile Updated Successfully";
        header("Location: user.php");
        exit();
    }

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
        </head>
        <body>
            <div class="container mt-4">
                <?php include('message.php'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <!----- Edit Profile Form ----->
                                <form method="post" action="">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $user_data['username']; ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?= $user_data['phone']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $user_data['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="Beginner" <?php echo ($user_data['category'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                                            <option value="Veteran" <?php echo ($user_data['category'] == 'Veteran') ? 'selected' : ''; ?>>Veteran</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subcategory" class="form-label">Subcategory</label>
                                        <select class="form-control" id="subcategory" name="subcategory" required>
                                            <?php
                                            $subcategories_query = "SELECT * FROM subcategories";
                                            $subcategories_result = mysqli_query($con, $subcategories_query);

                                            if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                                                while ($subcategory = mysqli_fetch_assoc($subcategories_result)) {
                                                    echo "<option value='{$subcategory['name']}' " . ($user_data['subcategory'] == $subcategory['name'] ? 'selected' : '') . ">{$subcategory['name']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                        <?php
                                        if (isset($_SESSION['error_message'])) {
                                            echo '<div class="alert alert-danger mt-2">' . $_SESSION['error_message'] . '</div>';
                                            unset($_SESSION['error_message']);
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="user.php" class="btn btn-secondary">Back to Dashboard</a>
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

    <?php
    } else {
        echo "<h5>Error fetching user data</h5>";
    }
} else {
    echo "<h5>User not logged in</h5>";
}
?>