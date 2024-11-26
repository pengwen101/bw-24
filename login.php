<?php
session_start();

if (isset($_SESSION['google_loggedin']) && $_SESSION['google_loggedin'] == true) {
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Sign In</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel = "stylesheet" href = "style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="assets/Logo BW.png">

</head>

<body>
    <div class="overflow-hidden relative h-screen bg-charcoal w-screen flex justify-center items-center">
        <div class = "absolute top-0 left-0 w-full h-full"><img class = "object-cover w-full h-full opacity-[18%]" src = "assets/asset bw_white-01.png"></div>
        <div class=" border border-slate-100 backdrop-blur-sm bg-white/30 flex flex-col justify-center items-center w-[75%] sm:w-[50%] px-[50px] py-[30px] md:px-[70px] md:py-[50px] rounded-3xl">
            <div id = 'title' class="text-4xl md:text-5xl font-extrabold mb-3 text-white text-center">BEGINNING WELL 2024</div>
            <div id = 'text-1' class = "hidden text-center text-lg font-bold text-white">Which type of characters are you?</div>
            <div id = 'text-2' class = "hidden text-center text-lg font-bold text-white mb-5">Find out by taking this mini quiz!</div>
            <a href="google-oauth.php">
                <div id = 'container-text-3' class="hidden cursor-pointer flex hover:!bg-charcoal hover:!text-white text-sm bg-[#ffd451] color-charcoal transition-all md:text-xl items-center font-bold text-center rounded-full px-4 py-2 transition duration-500">
                    <div id = 'text-3' class = 'hidden'>Sign In With Google</div>
                </div>
            </a>

        </div>
        
        <div class="fixed bottom-0 left-[-30px] z-5 w-[60%] lg:w-[30%]"><img class="drop-shadow-lg object-cover" src="assets/Hopes Menyapa.png"></div>
    

    </div>

    <script>
            window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('unauthorized') && urlParams.get('unauthorized') === 'true') {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Use PCU email to sign in!",
                });
        }
    };
    
    function typeEffect(element, speed) {
            var text = element.innerHTML;
            element.innerHTML = "";

            var i = 0;
            var timer = setInterval(function() {
                if (i < text.length) {
                    element.append(text.charAt(i));
                    i++;
                } else {
                    clearInterval(timer);
                }
            }, speed);
        }

        var speed = 75;
        var title = document.querySelector('#title');
        var text1 = document.querySelector('#text-1');
        var text2 = document.querySelector('#text-2');
        var text3 = document.querySelector('#text-3');
      
        var delay = title.innerHTML.length * speed + speed;

        typeEffect(title, speed);

        setTimeout(function() {
            text1.style.display = "inline-block";
            typeEffect(text1, speed);
        }, delay + 700);

        setTimeout(function() {
            text2.style.display = "inline-block";
            typeEffect(text2, speed);
        }, delay + 3300);

        setTimeout(function() {
            containerText3 = document.querySelector('#container-text-3');
            containerText3.classList.remove('hidden');
            text3.style.display = "inline-block";
            typeEffect(text3, speed);
        }, delay + 5800);

     
    </script>

</body>

</html>