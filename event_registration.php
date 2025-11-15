<?php
session_start();
require_once("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userDetails = $_SESSION['user_details'];

    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $subcategoryName = $_POST['subcategory'];

    $checkQuotaQuery = "SELECT max_quota FROM subcategories WHERE name = '$subcategoryName'";
    $quotaResult = $conn->query($checkQuotaQuery);

    if ($quotaResult && $quota = $quotaResult->fetch_assoc()) {
        $maxQuota = $quota['max_quota'];

        $currentQuotaQuery = "SELECT COUNT(*) as current_quota FROM participants WHERE subcategory = '$subcategoryName'";
        $currentQuotaResult = $conn->query($currentQuotaQuery);

        if ($currentQuotaResult && $currentQuota = $currentQuotaResult->fetch_assoc()) {
            $currentQuota = $currentQuota['current_quota'];

            if ($currentQuota >= $maxQuota) {
                $_SESSION['error'] = "Sorry, the subcategory is full. Please choose another subcategory.";
                header("Location: event_registration.php");
                exit();
            }
        }
    }
    $incrementQuotaQuery = "UPDATE subcategories SET current_quota = current_quota + 1 WHERE name = '$subcategoryName'";
    $conn->query($incrementQuotaQuery);

    $insertQuery = "INSERT INTO participants (username, email, password, user_type, phone, category, subcategory)
                    VALUES (
                        '{$userDetails['username']}',
                        '{$userDetails['email']}',
                        '{$userDetails['password']}',
                        '{$userDetails['user_type']}',
                        '$phone',
                        '$category',
                        '$subcategoryName'
                    )";
    $conn->query($insertQuery);

    unset($_SESSION['user_details']);
    header("Location: signin.php");
    exit();
}

$subcategoriesQuery = "SELECT * FROM subcategories";
$subcategoriesResult = $conn->query($subcategoriesQuery);
$subcategories = $subcategoriesResult->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration | Wawasan Color Run</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form_container">
        <div class="form registration_form">
            <form action="event_registration.php" method="POST">
                <h2>Event Registration</h2>
                <div class="msg">
                <?php
                    if (isset($_SESSION['error'])) {
                        echo '<p class="error">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']);
                    }
                ?>
                </div>
                <div class="input_box">
                    <input type="tel" placeholder="Enter your phone number" name="phone" required/>
                </div>
                <div class="input_box">
                    <label for="category">Select category:</label>
                    <select id="category" name="category" required>
                        <option value="Beginner">Beginner</option>
                        <option value="Veteran">Veteran</option>
                    </select>
                </div>
                <div class="input_box">
                    <label for="subcategory">Select subcategory:</label>
                    <select id="subcategory" name="subcategory" required>
                    <?php
                    foreach ($subcategories as $subcat) {
                        echo '<option value="' . $subcat['name'] . '">' . $subcat['name'] . '</option>';
                    }
                    ?>
                    </select>
                </div>
                <button class="button" type="submit">Complete Registration</button>
            </form>
        </div>
    </div>
</body>
</html>