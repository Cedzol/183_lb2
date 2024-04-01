<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/vendor/autoload.php";

    function executeStatement($statement){
        $conn = getConnection();
        $statement = htmlspecialchars($statement);
        $stmt = $conn->prepare($statement);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }

    function getConnection()
    {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        require_once "$root/config.php";

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

function runSQL(){
    $commands = file_get_contents('delete_account_script.sql');
    require_once 'fw/db.php';
    $stmt = executeStatement($commands);
}

$cron = new Cron\CronExpression('@daily');
if ($cron->isDue()){
    runSQL();
}
