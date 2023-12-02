<?php

include './../../../config/constants.php';

//Get the id to be deleted
if (filter_has_var(INPUT_GET, 'user_id')) {
$clean_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id = filter_var($clean_id, FILTER_VALIDATE_INT);

//SQL query to delete user
$deleteuserQuery = "DELETE FROM users WHERE user_id = :user_id";
$deleteuserStatement = $pdo->prepare($deleteuserQuery);
$deleteuserStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if ($deleteuserStatement->execute()) {
//Creating SESSION variable to display message.
$_SESSION['delete'] = "
<div class='msgalert alert--success' id='alert'>
    <div class='alert__message'>
        Admin Profile Deleted Successfully
    </div>
</div>
";
//Redirecting to the manage admin page.
header('location:' . SITEURL . 'inspection/admin/');
} else {
//Creating SESSION variable to display message.
$_SESSION['delete'] = "
<div class='msgalert alert--danger' id='alert'>
    <div class='alert__message'>
        Failed to Delete Admin Profile, Please try again
    </div>
</div>

";
//Redirecting to the manage admin page.
header('location:' . SITEURL . 'inspection/admin/');
}
} else {
echo "Id invalid";
}