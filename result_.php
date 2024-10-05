<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

require_once('config.php');

$db = new Database();
$nrp = $_SESSION['nrp'];
$result = $db->getResultPrc($nrp);
if ($result == -1) {
    echo json_encode(["error" => "Result processing failed"]);
    exit;
}
$similarity  = $db->getSimilarity($nrp);
if ($similarity == -1) {
    echo json_encode(["error" => "Similarity calculation failed"]);
    exit;
}

// Return the result as JSON
echo json_encode(['result' => $result, 'similarity' => $similarity]);