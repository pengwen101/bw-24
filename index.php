<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["google_loggedin"]) || $_SESSION["google_loggedin"] !== true) {
    header("location: login.php");
    exit;
}


require_once('config.php');
$db = new Database();

$email = $_SESSION['google_email'];
$nrp =  explode('@', $email)[0];

//user can only fill in the test once
if ($db->checkCompleted($nrp)) {
    header('location: result.php');
}


//validate answer values
$answer_ids = [];
$answer_errs = [];
$other_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $questions = $db->getQuestions();
    $q_ids = [];

    foreach ($questions as $question) {
        array_push($q_ids, $question['id']);
    }

    foreach ($q_ids as $q_id) {
        $input_answer_id = isset($_POST[$q_id]) ? $_POST[$q_id] : "";
        $valid_answer_id = $db->getAnswerChoices($q_id);
        if ($input_answer_id != '' && in_array($input_answer_id, $valid_answer_id)) {
            array_push($answer_ids, $input_answer_id);
        } else {
            array_push($answer_errs, true);
        }
    }
    
    $email = $_SESSION['google_email'];
    $nrp =  explode('@', $email)[0];
    if(strlen($nrp) != 9){
        $other_err = true;
    }

    if (!in_array(true, $answer_errs) && !$other_err) {
        $full_name = $_SESSION['google_name'];
        $db->insertResult($nrp, $full_name, $answer_ids);
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
    <title>Quiz</title>
    <link rel = "stylesheet" href = "style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="assets/Logo BW.png">
</head>

<body class="relative">
    <form method="post" action="index.php" class="h-full bg-light-cream">
        <?php
        $questions = $db->getQuestions();
        if ($questions == -1) {
            header("location:error.php");
        }
        $i = 1;
        foreach ($questions as $question) {
            echo "<div id = '" . $question['id'] . "' class = 'quiz-container flex hidden flex-col min-h-screen relative justify-center items-center py-10'>";
            echo "<div class = 'bg-light-orange flex flex-col justify-center items-center max-w-[90%] md:max-w-[50%] rounded-3xl relative gap-5 p-10 shadow-lg bg-white pb-[100px]'>";
            $progress = $i*10;
            echo "<div class = 'flex w-full flex-col gap-1'>";
            echo "<div class='w-full bg-gray-200 rounded-full h-2.5'>";
            echo "<div class='bg-charcoal h-2.5 rounded-full' style='width:". $progress ."%'></div>";
            echo "</div>";
            echo "<div class = 'text-xs color-charcoal font-semibold'>Question ". $i ." of 10</div>";
            echo "</div>";
            echo "<div class = 'p-8 color-charcoal rounded-lg bg-slate-100 text-center question font-bold'>" . $question['question'] . "</div>";
            
            echo "<div class = 'w-[90%] answers flex flex-col gap-4'>";
            $answers = $db->getAnswers($question['id']);
            if ($answers == -1) {
                header("location:error.php");
            }
            foreach ($answers as $answer) {
                echo "<input type = 'radio' name = '" . $answer['q_id'] . "' class = 'hidden' value = '" . $answer['id'] . "' id = '" . $answer['id'] . "'>" . "<label for = '" . $answer['id'] . "'><div name = '" . $answer['q_id'] . "' class = 'text-center choice-box px-4 py-2 cursor-pointer transition duration-500'>" . $answer['answer'] . "</div></label>";
            }
            echo "</div>";
            echo "<div class = 'transition duration-500 cursor-pointer absolute bottom-[30px] left-[30px] prev-question bg-slate-100 rounded-full w-[50px] flex justify-center items-center h-[50px]'><i class='fa-solid fa-arrow-left'></i></div>";
            echo "<div class = 'transition duration-500 cursor-pointer  absolute bottom-[30px] right-[30px] next-question bg-slate-100 rounded-full flex justify-center items-center w-[50px] h-[50px] hidden'><i class='fa-solid fa-arrow-right'></i></div>";
            echo "</div>";

            //prev and next button
        
            echo "</div>";
            $i++;
        }
        
        ?>
        <div class="quiz-container flex hidden flex-col min-h-screen relative justify-center items-center py-10">
            <div class="bg-charcoal flex flex-col justify-center items-center max-w-[90%] md:max-w-[50%] rounded-3xl relative gap-5 p-10 shadow-lg ">
            <!-- <div class='cursor-pointer absolute top-[30px] left-[30px] prev-question bg-slate-100 rounded-full w-[50px] flex justify-center items-center h-[50px]'><i class='fa-solid fa-arrow-left'></i></div>
            <div class='cursor-pointer  absolute top-[30px] right-[30px] next-question bg-slate-100 rounded-full flex justify-center items-center w-[50px] h-[50px] hidden'><i class='fa-solid fa-arrow-right'></i></div> -->
                <div class="rounded-lg text-white text-center question text-lg font-semibold">You have finished the assessment, see your result!</div>
                <button type="submit" class="w-full text-center rounded-lg bg-slate-orange color-charcoal hover:font-bold hover:!bg-[#ffd451] px-4 py-2 font-semibold cursor-pointer transition-all duration-500]">See my result</button>

            </div>
            
        </div>
        </div>
    </form>
    <script src="index.js"></script>
</body>

</html>