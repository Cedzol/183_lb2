<?php
require_once 'db.php';
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/logging/LOG.php";

if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
}
$log = new Log();

$userid = $_SESSION['userid'];
if (array_key_exists('confirmDelete', $_POST)){
$conn = getConnection();
$stmt = $conn->prepare("UPDATE users SET to_delete = true, delete_date = CURRENT_DATE WHERE ID = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();
if ($stmt) {
    $log->wh_log("Updated user for deletion userid " . $userid . "at " . date("Y-m-d H:i:s "));
    header("Location: logout.php");
    exit();
} else {
    $log->wh_log("Failed to update user for deletion userid " . $userid);
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TBZ 'Secure' App</title>
    <link rel="stylesheet" href="/fw/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
</head>
<body>
<header>
    <div>This is the insecure m183 test app</div>
    <?php  if (isset($_SESSION['userid'])) { ?>
        <nav>
            <ul>
                <li><a href="/">Tasks</a></li>
                <?php if ($_SESSION['role'] == 1) { ?>
                    <li><a href="/admin/users.php">User List</a></li>
                <?php } ?>
                <li><a href="/logout.php">Logout</a></li>
                <li><a href="#" id="deleteAccount">Delete Account</a></li>
            </ul>
        </nav>
    <?php  } ?>
</header>
<main>

<!-- Pop-up for Delete Account -->
<div id="deleteAccountPopup" class="popup">
    <h2 style="color: #000;">Delete Account</h2>
    <p>Are you sure you want to delete your Account?</p>
    <form method="post">
        <input type="submit" name="confirmDelete" value="confirmDelete" id="confirmDelete" class="pop-upDelete">Delete Account</input>
    </form>
    <button id="cancelDelete" class="pop-upCancel">Cancel</button>
</div>

<!-- Add your main content here -->

</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show the delete account pop-up when clicked
        document.getElementById('deleteAccount').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('deleteAccountPopup').style.display = 'block';
        });

        // Close the delete account pop-up when cancel button is clicked
        document.getElementById('cancelDelete').addEventListener('click', function() {
            document.getElementById('deleteAccountPopup').style.display = 'none';
        });
        
    });
</script>