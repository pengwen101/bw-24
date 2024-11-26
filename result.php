<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


session_start();


if (!isset($_SESSION["google_loggedin"]) || $_SESSION["google_loggedin"] !== true) {
    header("location:login.php");
    exit;
}

require_once("config.php");

$db = new Database();
$email = $_SESSION['google_email'];
$nrp =  explode('@', $email)[0];
$result = $db->getResultPrc($nrp);
if ($result == -1) {
    header("location:error.php");
    exit;
}



$similarity  = $db->getSimilarity($nrp);
if ($similarity == -1) {
    header("location:error.php");
    exit;
}



reset($similarity);
$top_1 = key($similarity);
$top_1_similarity_label = [key($similarity), 'others'];
$top_1_similarity_data = [reset($similarity), (100 - reset($similarity))];

$name = explode(' ', $_SESSION['google_name'])[0];
$name = ucfirst(strtolower($name));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Result</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="assets/Logo BW.png">
</head>
<body class="bg-light-orange">
    <div class="container py-10 pb-[150px] relative min-h-screen flex justify-center items-center">
        
        <div class="absolute top-0 left-0 w-full h-full"><img class="object-cover w-full h-full opacity-25" src="assets/asset bw_white-01.png"></div>
    
        
        
        <div class=' bg-light-cream flex flex-col justify-center items-center max-w-[90%] md:w-[50%] rounded-lg relative gap-2 px-5 py-10 shadow-lg  pb-[100px]'>
            <div class="mt-5 text-3xl font-semibold">Hi, <?php echo $name; ?></div>
            <div class="text-xl mt-5 text-center mx-5">You look like someone who values <span class="font-bold bg-[#f5a30a] px-2"><?php echo $top_1 ?></span></div>
            <div class="w-full sm:block hidden"><canvas class="bg-slate-100 shadow-xl rounded-lg mx-5 md:mx-10 mt-2 mb-5 p-5 " id="verticalBar"></canvas></div>
            <div class="w-full block sm:hidden"><canvas class="bg-slate-100 shadow-xl rounded-lg  mx-5 my-5 p-5 md:mx-10" id="horizontalBar"></canvas></div>
            <div class="mt-5 flex flex-col md:flex-row justify-center items-center w-full">
                <div class="w-full md:w-[70%]"><canvas class = "shadow-xl rounded-lg mx-10 my-5 p-5 bg-slate-100" id="pie"></canvas></div>
                <div class="text-xl md:text-left text-center w-full pl-0 pr-5 md:w-[30%]">There are <span class="text-center text-2xl font-bold px-2 bg-[#f5a30a]"> <?php echo $top_1_similarity_data[0]; ?>%</span> of others who value <?php echo $top_1_similarity_label[0];?> just like you</div>
            </div>
            
            
            <a class="px-6 py-2 rounded-full mt-10 hover:!text-bold hover:underline hover:!text-[#f5a30a] transition duration-500" href="logout.php">Logout</a>
        </div>
        <div class="fixed bottom-0 left-[-30px] z-5 w-[60%] sm:w-[40%] lg:w-[30%]"><img class="drop-shadow-lg object-cover" src="assets/Hopes Menunjuk ke Atas.png"></div>
    </div>
    <script>
        
        const pie = document.getElementById('pie');
        new Chart(pie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($top_1_similarity_label); ?>,
                datasets: [{
                    data: <?php echo json_encode($top_1_similarity_data); ?>,
                    backgroundColor: [
                        '#f5a30a', '#b3c4d6'
                    ],
                    borderColor: [
                        '#F1F5F9'
                    ],
                    borderWidth: 10,
                    circumference: 180,
                    rotation: 270,
                    // cutout: '90%',
                    borderRadius: 20,
                    spacing: 50,
                    cutout: "80%",
                    
                }]
            },
            options: {
                aspectRatio: 1.5,
                plugins: {
                    legend: {
                        display: false
                    },
                },
            }
        });


        const ctxVerticalBar = document.getElementById('verticalBar');
        new Chart(ctxVerticalBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($result)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($result)); ?>,
                    backgroundColor: [
                        '#224366'
                    ],
                }]
            },
            options: {
                aspectRatio: 1.5,
                scales: {
                    y: {
                        display: false,
                        grid: {
                            display: false // removes the gridlines on the y-axis
                        }
                    },
                    x: {
                        grid: {
                            display: false // removes the gridlines on the y-axis
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend
                    },
                },
            }
        });


        const ctxHorizontalBar = document.getElementById('horizontalBar');
        new Chart(ctxHorizontalBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($result)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($result)); ?>,
                    backgroundColor: [
                        '#224366'
                    ],
                }]
            },
            options: {
                aspectRatio:0.95,
                indexAxis: 'y',
                scales: {
                    y: {
                        grid: {
                            display: false // removes the gridlines on the y-axis
                        }
                    },
                    x: {
                        display: false,
                        grid: {
                            display: false // removes the gridlines on the y-axis
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend
                    },
                },
            }
        });
    </script>
</body>
</html>