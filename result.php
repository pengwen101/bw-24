<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once('config.php');

$db = new Database();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Result</title>
</head>

<body>

    <?php
    $nrp = $_SESSION['nrp'];
    $result = $db->getResultPrc($nrp);
    if($result==-1) header("location:error.php");
    $similarity  = $db->getSimilarity($nrp);
    if($similarity==-1) header("location:error.php");
    ?>

    <div class='relative h-screen w-screen flex justify-center items-center'>
        <div class='flex flex-col gap-3 p-10 justify-center items-center'>
            <div>Your result:</div>

            <?php
            foreach ($result as $key => $value) {
                echo "<div>" . $key . " : " . $value . "%</div>";
            }

            ?>
        </div>

        <div class='flex flex-col gap-3 p-10 justify-center items-center'>
            <div>Similarity with others:</div>

            <?php
            foreach ($similarity as $key => $value) {
                echo "<div>" . $key . " : " . $value . "%</div>";
            }

            ?>
        </div>

        <div class="absolute bottom-[20%] flex justify-center">
            <a class="text-blue-500 hover:underline" href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>