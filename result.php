<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:login.php");
    exit;
}

require_once("config.php");

$db = new Database();
$nrp = $_SESSION['nrp'];
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Result</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
</head>

<body>
    <div class='relative min-h-screen max-w-screen flex flex-col justify-center items-center'>
        <div class='flex w-full justify-center gap-10 items-center'>
            <div class="flex flex-col gap-2 w-[30%]">
                <div class = "text-center">Your result:</div>
                <div class="text-3xl text-center"><?php echo array_key_first($result) ?></div>

            </div>

            <div class="w-[60%]"><canvas id="acquisitions"></canvas></div>
            <!-- <script type="module" src="dimensions.js"></script> -->
        </div>
    </div>

    <div class='relative min-h-screen w-screen flex flex-col justify-center items-center'>
        <div class='flex flex-col gap-3 p-10 justify-center items-center'>
            <div>Similarity with others:</div>
        </div>

        <div class="bottom-[20%] flex justify-center pb-10">
            <a class="text-blue-500 hover:underline" href="logout.php">Logout</a>
        </div>
    </div>

    </div>

    <script>
        const ctx = document.getElementById('acquisitions');
        Chart.register(ChartDataLabels);
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($result)); ?>,
                datasets: [{
                    label: '# of Votes',
                    data: <?php echo json_encode(array_values($result)); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 71, 1)',
                        'rgba(9, 31, 242, 0.8)',
                        'rgba(240, 255, 45, 0.8)',
                        'rgba(17, 231, 42, 0.8)',
                        'rgba(201, 30, 255, 0.8)',
                        'rgba(255, 128, 6, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 71, 1)',
                        'rgba(9, 31, 242, 0.8)',
                        'rgba(240, 255, 45, 0.8)',
                        'rgba(17, 231, 42, 0.8)',
                        'rgba(201, 30, 255, 0.8)',
                        'rgba(255, 128, 6, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        // Position of the labels 
                        // (start, end, center, etc.)
                        anchor: 'center',
                        // Alignment of the labels 
                        // (start, end, center, etc.)
                        align: 'center',
                        // Color of the labels
                        color: 'white',
                        font: {
                            weight: 'bold',
                        },
                        formatter: function(value, context) {
                            // Display the actual data value
                            return value;
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>