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
    <style>
        /* Add your custom styles here for the pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        .pop-upDelete {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #540e03;
            color: #fff;
        }

        .pop-upCancel {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #262626;
            color: #fff;
        }

        /* Adjusted navbar styles */
        header {
            background-color: #5a873b; /* Light green background color */
            padding: 10px;
            display: flex;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            margin-left: 50px;
            padding: 0;
            display: flex;
            align-items: center;
        }

        nav ul li {
            margin-right: 10px;
        }

        nav ul li a {
            padding: 8px 15px;
            background-color: #2f4a1d; /* Dark green background color */
            color: #fff; /* White text color */
            border-radius: 10px; /* Rounded corners */
            font-weight: bold; /* Bold text */
            text-decoration: none;
            font-size: 14px; /* Smaller font size */
        }

        div {
            color: #fff; /* Black text color for header */
            font-weight: bold; /* Bold text for header */
            padding-left: 10px;
        }

        #deleteAccount {
            background-color: #2f4a1d; /* Dark green background color for delete account button */
        }

        /* Remove hover effect */
        nav ul li a:hover {
            /* No hover effect */
        }

        .popup p {
            color: #444; /* Dark grey text color for popup text */
            font-weight: normal; /* Normal font weight for popup text */
            font-size: 16px; /* Font size for popup text */
        }
    </style>
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