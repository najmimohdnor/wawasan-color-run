<?php
session_start();
require 'dbconnection.php';

if(isset($_GET['id'])) {
    $participant_id = $_GET['id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $new_username = mysqli_real_escape_string($con, $_POST['new_username']);
        $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
        $new_phone = mysqli_real_escape_string($con, $_POST['new_phone']);
        $new_email = mysqli_real_escape_string($con, $_POST['new_email']);
        $new_category = mysqli_real_escape_string($con, $_POST['new_category']);
        $new_subcategory = mysqli_real_escape_string($con, $_POST['new_subcategory']);

        $update_query = "UPDATE participants SET
            username = '$new_username',
            password = '$new_password',
            phone = '$new_phone',
            email = '$new_email',
            category = '$new_category',
            subcategory = '$new_subcategory'
            WHERE id = $participant_id";

        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            echo "<h2>Participant updated successfully</h2>";
        } else {
            echo "<h2>Error updating participant</h2>";
        }
    }

    $query = "SELECT * FROM participants WHERE id = $participant_id";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) > 0) {
        $participant_data = mysqli_fetch_assoc($result);

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
        </head>
        <body>
            <h2>Edit Participant</h2>
            <form action="participants_edit.php?id=<?= $participant_id; ?>" method="POST">
                <label for="new_username">Username:</label>
                <input type="text" name="new_username" value="<?= $participant_data['username']; ?>" required><br>

                <label for="new_password">Password:</label>
                <input type="password" name="new_password" value="<?= $participant_data['password']; ?>" required><br>

                <label for="new_phone">Phone:</label>
                <input type="text" name="new_phone" value="<?= $participant_data['phone']; ?>" required><br>

                <label for="new_email">Email:</label>
                <input type="email" name="new_email" value="<?= $participant_data['email']; ?>" required><br>

                <label for="new_category">Category:</label>
                <select name="new_category" required>
                    <option value="Beginner" <?= ($participant_data['category'] == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
                    <option value="Veteran" <?= ($participant_data['category'] == 'Veteran') ? 'selected' : ''; ?>>Veteran</option>
                </select><br>

                <label for="new_subcategory">Subcategory:</label>
                <select name="new_subcategory" required>
                    <?php
                    $subcategories_query = "SELECT * FROM subcategories";
                    $subcategories_result = mysqli_query($con, $subcategories_query);

                    if ($subcategories_result && mysqli_num_rows($subcategories_result) > 0) {
                        while ($subcategory = mysqli_fetch_assoc($subcategories_result)) {
                            $selected = ($participant_data['subcategory'] == $subcategory['name']) ? 'selected' : '';
                            echo "<option value='{$subcategory['name']}' $selected>{$subcategory['name']}</option>";
                        }
                    }
                    ?>
                </select><br>

                <button type="submit">Update</button>
            </form>
        </body>

        </html>
        <?php
    } else {
        echo "<h2>Participant not found</h2>";
    }
} else {
    echo "<h2>Invalid request</h2>";
}
?>