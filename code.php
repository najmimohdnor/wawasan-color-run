<?php
session_start();
require 'dbconnection.php';

if (isset($_GET['delete_participants'])) {
    $participants_id = mysqli_real_escape_string($con, $_GET['delete_participants']);
    $subcategory_query = "SELECT subcategory FROM participants WHERE id='$participants_id'";
    $subcategory_result = mysqli_query($con, $subcategory_query);

    if ($subcategory_result && mysqli_num_rows($subcategory_result) > 0) {
        $subcategory = mysqli_fetch_assoc($subcategory_result)['subcategory'];
        
        $current_quota_query = "SELECT COUNT(*) as current_quota FROM participants WHERE subcategory = '$subcategory'";
        $current_quota_result = mysqli_query($con, $current_quota_query);

        if ($current_quota_result && mysqli_num_rows($current_quota_result) > 0) {
            $current_quota = mysqli_fetch_assoc($current_quota_result)['current_quota'];

            $new_current_quota = max(0, $current_quota - 1);

            $updateQuotaQuery = "UPDATE subcategories SET current_quota = $new_current_quota WHERE name = '$subcategory'";
            mysqli_query($con, $updateQuotaQuery);
        }
    }

    $query = "DELETE FROM participants WHERE id='$participants_id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Participant Deleted Successfully";
    } else {
        $_SESSION['message'] = "Participant Not Deleted";
    }
    header("Location: admin.php");
    exit(0);
}

if (isset($_POST['set_quotas'])) {
    $subcategories_query = "SELECT * FROM subcategories";
    $subcategories_result = mysqli_query($con, $subcategories_query);

    if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
        while ($subcategory = mysqli_fetch_assoc($subcategories_result)) {
            $subcat_name = $subcategory['name'];
            $new_quota = $_POST["{$subcat_name}_quota"];

            $current_quota_query = "SELECT COUNT(*) as current_quota FROM participants WHERE subcategory = '$subcat_name'";
            $current_quota_result = mysqli_query($con, $current_quota_query);
            $current_quota = ($current_quota_result && mysqli_num_rows($current_quota_result) > 0) ? mysqli_fetch_assoc($current_quota_result)['current_quota'] : 0;

            if ($new_quota < $current_quota) {
                $_SESSION['error'] = "Error: Max quota cannot be set below the current quota for $subcat_name.";
                header("Location: admin.php");
                exit();
            }

            $updateQuotaQuery = "UPDATE subcategories SET max_quota = $new_quota WHERE name = '$subcat_name'";
            mysqli_query($con, $updateQuotaQuery);
        }

        header("Location: admin.php");
        exit();
    }
}
if (isset($_POST['update_participants'])) {
    $participants_id = mysqli_real_escape_string($con, $_POST['participants_id']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $new_subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $max_quota_query = "SELECT max_quota, current_quota FROM subcategories WHERE name = '$new_subcategory'";
    $max_quota_result = mysqli_query($con, $max_quota_query);

    if ($max_quota_result && mysqli_num_rows($max_quota_result) > 0) {
        $quota_data = mysqli_fetch_assoc($max_quota_result);
        $max_quota = $quota_data['max_quota'];
        $current_quota = $quota_data['current_quota'];

        if ($current_quota >= $max_quota) {
            $_SESSION['error'] = "Error: Subcategory '$new_subcategory' is full. Please choose another subcategory.";
            header("Location: participants_edit.php?id=$participants_id");
            exit();
        } else {
            $current_subcategory_query = "SELECT subcategory FROM participants WHERE id = '$participants_id'";
            $current_subcategory_result = mysqli_query($con, $current_subcategory_query);

            if ($current_subcategory_result && mysqli_num_rows($current_subcategory_result) > 0) {
                $current_subcategory_data = mysqli_fetch_assoc($current_subcategory_result);
                $current_subcategory = $current_subcategory_data['subcategory'];

                if ($current_subcategory != $new_subcategory) {
                    $updateOldQuotaQuery = "UPDATE subcategories SET current_quota = current_quota - 1 WHERE name = '$current_subcategory'";
                    mysqli_query($con, $updateOldQuotaQuery);

                    $updateNewQuotaQuery = "UPDATE subcategories SET current_quota = current_quota + 1 WHERE name = '$new_subcategory'";
                    mysqli_query($con, $updateNewQuotaQuery);
                }
            }
            $query = "UPDATE participants SET username='$username', password='$hashed_password', phone='$phone', email='$email',
                      category='$category', subcategory='$new_subcategory', user_type='$user_type' WHERE id='$participants_id' ";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                $_SESSION['message'] = "Participant Updated Successfully";
                header("Location: participants_edit.php?id=$participants_id");
                exit(0);
            } else {
                $_SESSION['message'] = "Participant Not Updated";
            }
        }
    } else {
        $_SESSION['error'] = "Error fetching max_quota information for subcategory '$new_subcategory'.";
        header("Location: participants_edit.php?id=$participants_id");
        exit();
    }
}

if (isset($_GET['change_role'])) {
    $user_id = $_GET['change_role'];
    $query = "SELECT user_type FROM participants WHERE id = $user_id";
    $result = mysqli_query($con, $query);

    if ($result && $user = mysqli_fetch_assoc($result)) {
        $new_role = ($user['user_type'] == 'admin') ? 'user' : 'admin';
        $updateQuery = "UPDATE participants SET user_type = '$new_role' WHERE id = $user_id";
        mysqli_query($con, $updateQuery);

        $_SESSION['success'] = "Role changed successfully";
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to change role";
        header("Location: admin.php");
        exit();
    }
}

if (isset($_POST['save_participants'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);

    $query = "INSERT INTO participants (username, password, phone, email, category, subcategory, user_type)
              VALUES ('$username', '$hashed_password', '$phone', '$email', '$category', '$subcategory', '$user_type')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Participant Created Successfully";

        $updateQuotaQuery = "UPDATE subcategories SET quota = quota - 1 WHERE name='$subcategory'";
        mysqli_query($con, $updateQuotaQuery);

    } else {
        $_SESSION['message'] = "Participant Not Created";
    }
    header("Location: participants_create.php");
    exit(0);
}

header("Location: participants_create.php");
exit(0);
?>