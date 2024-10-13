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

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        :root {
            --flamingo: #f2712e;
            --jaffa: #f28b30;
            --albescent: #f2dcc2;
            --charcoal: #011526;
        }

        .bg-flamingo {
            background-color: var(--flamingo) !important;
        }

        .color-jaffa {
            color: var(--jaffa) !important;
        }

        .color-flamingo {
            color: var(--flamingo) !important;
        }

        .bg-jaffa {
            background-color: var(--jaffa) !important;
        }

        .gradient-orange {
            background: linear-gradient(269deg, #f4651a, #f28b30, #f8ae57);
            background-size: 600% 600%;

            -webkit-animation: AnimationName 12s ease infinite;
            -moz-animation: AnimationName 12s ease infinite;
            animation: AnimationName 12s ease infinite;
        }

        @-webkit-keyframes AnimationName {
            0% {
                background-position: 0% 48%
            }

            50% {
                background-position: 100% 53%
            }

            100% {
                background-position: 0% 48%
            }
        }

        @-moz-keyframes AnimationName {
            0% {
                background-position: 0% 48%
            }

            50% {
                background-position: 100% 53%
            }

            100% {
                background-position: 0% 48%
            }
        }

        @keyframes AnimationName {
            0% {
                background-position: 0% 48%
            }

            50% {
                background-position: 100% 53%
            }

            100% {
                background-position: 0% 48%
            }
        }

        .button-orange{
            transition: all 0.64s ease;
        }

        .button-orange:hover{
            color: var(--albescent) !important;
            background-color: var(--charcoal);
            border: 1px white;
            
        }

         .gsi-material-button-icon {
  height: 20px;
  margin-right: 12px;
  min-width: 20px;
  width: 20px;
}
    </style>
</head>

<body>
    <div class="overflow-hidden relative h-screen gradient-orange w-screen flex justify-center items-center bg-flamingo">
        <div class=" border border-slate-100 backdrop-blur-sm bg-white/30 flex flex-col justify-center items-center w-[75%] sm:w-[50%] px-[50px] py-[30px] md:px-[70px] md:py-[50px] rounded-3xl">
            <div class="text-3xl md:text-5xl font-extrabold mb-5 text-white text-center">BEGINNING WELL 2024</div>
            <a href = "google-oauth.php">
            <div class="cursor-pointer button-orange flex gap-1 text-sm color-flamingo md:text-xl items-center font-semibold text-center rounded-full px-6 py-2 bg-white">
           
            <div class = "gsi-material-button-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
        <path fill="none" d="M0 0h48v48H0z"></path>
      </svg></div>    
            <div>Sign In With Google</div>
            </div>
            </a> 

        </div>
        <div class = "absolute left-[50px] bottom-[-10px] w-[30%]"><img src = "assets/Hopes Menyapa.png"></div>

    </div>

</body>

</html>