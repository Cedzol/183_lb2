<?php
require_once 'db.php';
if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
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
            </ul>
        </nav>
    <?php  } ?>
</header>
<main>