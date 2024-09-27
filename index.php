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
$answer1_err = $answer2_err = $answer3_err = $answer4_err = $answer5_err = false;
$answer1 = $answer2 = $answer3 = $answer4 = $answer5 = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_answer1 = isset($_POST['Q1']) ? $_POST['Q1'] : "";
    //valid_answer1 contains valid answer's id for question number 1 
    $valid_answer1 = $db->getAnswerChoices('Q1');
    if ($input_answer1 != '' && in_array($input_answer1, $valid_answer1)) {
        $answer1 = $input_answer1;
    } else {
        $answer1_err = true;
    }

    $input_answer2 =  isset($_POST['Q2']) ? $_POST['Q2'] : "";
    $valid_answer2 = $db->getAnswerChoices('Q2');
    if ($input_answer2 != '' && in_array($input_answer2, $valid_answer2)) {
        $answer2 = $input_answer2;
    } else {
        $answer2_err = true;
    }

    $input_answer3 = isset($_POST['Q3']) ? $_POST['Q3'] : "";
    $valid_answer3 = $db->getAnswerChoices('Q3');
    if ($input_answer3 != '' && in_array($input_answer3, $valid_answer3)) {
        $answer3 = $input_answer3;
    } else {
        $answer3_err = true;
    }

    $input_answer4 = isset($_POST['Q4']) ? $_POST['Q4'] : "";
    $valid_answer4 = $db->getAnswerChoices('Q4');
    if ($input_answer4 != '' && in_array($input_answer4, $valid_answer4)) {
        $answer4 = $input_answer4;
    } else {
        $answer4_err = true;
    }

    $input_answer5 =  isset($_POST['Q5']) ? $_POST['Q5'] : "";
    $valid_answer5 = $db->getAnswerChoices('Q5');
    if ($input_answer5 != '' && in_array($input_answer5, $valid_answer5)) {
        $answer5 = $input_answer5;
    } else {
        $answer5_err = true;
    }

    if (!$answer1_err && !$answer2_err && !$answer3_err && !$answer4_err && !$answer5_err) {
        $nrp = $_SESSION['nrp'];
        $answers_id = [$answer1, $answer2, $answer3, $answer4, $answer5];

        $db->insertResult($nrp, $answers_id);
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