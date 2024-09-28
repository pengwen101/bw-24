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

$nrp = $_SESSION['nrp'];

//user can only fill in the test once
if ($db->checkCompleted($nrp)) {
    header('location: result.php');
}


//validate answer values
$answer_ids = [];
$answer_errs = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $questions = $db->getQuestions();
    $q_ids = [];

    foreach($questions as $question){
        array_push($q_ids, $question['id']);
    }

    foreach($q_ids as $q_id){
        $input_answer_id = isset($_POST[$q_id])? $_POST[$q_id] : "";
        $valid_answer_id = $db->getAnswerChoices($q_id);
        if ($input_answer_id != '' && in_array($input_answer_id, $valid_answer_id)) {
            array_push($answer_ids, $input_answer_id);
        } else {
            array_push($answer_errs, true);
        }
    }

    if (!in_array(true, $answer_errs)) {
        $nrp = $_SESSION['nrp'];
        $db->insertResult($nrp, $answer_ids);
        header("location:result.php");
    } else {
        header("location:error.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>
</head>

<body class="relative">
    <form method="post" action="index.php" class="h-full">
        <?php
        $questions = $db->getQuestions();
        if ($questions == -1) {
            header("location:error.php");
        }
        foreach ($questions as $question) {
            echo "<div id = '" . $question['id'] . "' class = 'quiz-container flex hidden flex-col min-h-screen relative justify-center items-center'>";
            echo "<div class = 'flex flex-col justify-center items-center max-w-[90%] md:max-w-[60%] rounded-lg p-10 border border-black'>";
            echo "<div class = 'question'>" . $question['question'] . "</div>";
            echo "<div class = 'answers flex flex-col gap-3'>";
            $answers = $db->getAnswers($question['id']);
            if ($answers == -1) {
                header("location:error.php");
            }
            foreach ($answers as $answer) {
                echo "<input type = 'radio' name = '" . $answer['q_id'] . "' class = 'hidden' value = '" . $answer['id'] . "' id = '" . $answer['id'] . "'>" . "<label for = '" . $answer['id'] . "'><div name = '" . $answer['q_id'] . "' class = 'choice-box px-4 py-2 rounded-lg border border-black'>" . $answer['answer'] . "</div></label>";
            }
            echo "</div>";
            echo "</div>";

            //prev and next button
            echo "<div class = 'prev-question absolute bottom-10 left-10'><i class='fa-solid fa-arrow-left'></i></div>";
            echo "<div class = 'next-question hidden absolute bottom-10 right-10'><i class='fa-solid fa-arrow-right'></i></div>";
            echo "</div>";
        }
        ?>
        <div class="quiz-container relative flex hidden flex-col min-h-screen relative justify-center items-center">
            <div class="flex flex-col max-w-[90%] md:max-w-[60%] justify-center gap-3 items-center rounded-lg p-10 border border-black">
                <div class="">You have finished the assessment, see your result!</div>
                <button type="submit" class="choice-box flex justify-center items-center px-4 py-2 rounded-lg border border-black">See my result</button>
            </div>
        </div>
    </form>
    <script src="index.js"></script>
</body>

</html>