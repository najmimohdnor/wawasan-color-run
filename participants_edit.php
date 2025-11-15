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
    <title>Edit Participants</title>
</head>
<body>
<div class="container mt-5">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Participant 
                    <a href="admin.php" class="btn btn-danger float-end">BACK</a>
                </h4>
            </div>
            <div class="card-body">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<p class="text-danger">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            }
            ?>
            <?php
                if(isset($_GET['id']))
                {
                    $participant_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query = "SELECT * FROM participants WHERE id='$participant_id' ";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        $participant = mysqli_fetch_array($query_run);
                        ?>
                        <form action="code.php" method="POST">
                            <input type="hidden" name="participants_id" value="<?= $participant['id']; ?>">


                                    <div class="mb-3">
                                        <label>Participant Username</label>
                                        <input type="text" name="username" value="<?= $participant['username']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Participant Email</label>
                                        <input type="text" name="email" value="<?= $participant['email']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Participant Password</label>
                                        <input type="password" name="password" value="<?= $participant['password']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Participant Phone</label>
                                        <input type="text" name="phone" value="<?= $participant['phone']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            <option value="Beginner" <?= ($participant['category'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                                            <option value="Veteran" <?= ($participant['category'] == 'Veteran') ? 'selected' : ''; ?>>Veteran</option>
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
                                                    $selected = ($subcategory['name'] == $participant['subcategory']) ? 'selected' : '';
                                                    echo "<option value='{$subcategory['name']}' $selected>{$subcategory['name']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>User Type</label>
                                        <select name="user_type" class="form-control">
                                            <option value="user" <?= ($participant['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
                                            <option value="admin" <?= ($participant['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_participants" class="btn btn-primary">
                                            Update Participant
                                            
                                        </button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Participant Found</h4>";
                            }
                        }
                        ?>
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