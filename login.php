<?php

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    header("location:index.php");
    exit();
}

require_once("config.php");
$db = new Database();
$identification = $password=  "";
$identification_err = $password_err = "";
$success;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $input_identification = trim($_POST['identification']);
    if(empty($input_identification)){
        $identification_err = "Mohon masukkan nrp terdaftar.";
    }else if(!filter_var($input_identification, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "/^[a-zA-Z0-9\s]+$/"))) && !filter_var($input_identification, FILTER_VALIDATE_EMAIL)){
        $identification_err = "Mohon masukkan nrp valid.";
    }else{
        $sql = "SELECT * FROM users WHERE nrp = :identification";
        if ($stmt = $db->pdo->prepare($sql)){
            $stmt->bindParam(":identification", $input_identification);
            if($stmt->execute()){
                if($stmt ->rowCount() ==1){
                    $identification = $input_identification;
                }else{
                    $identification_err = "User belum terdaftar.";
                }
            }
        }
        unset($stmt);
    }

    $input_password = trim($_POST['password']);
    if(empty($input_password)){
        $password_err = "Mohon masukkan password.";
    }else{
        $password = $input_password;
    }

    if(empty($identification_err) && empty($password_err)){
       $sql = "SELECT password, nrp FROM users WHERE nrp = :identification";
       if($stmt = $db -> pdo ->prepare($sql)){
        $stmt->bindParam(":identification", $identification);
            if($stmt->execute()){
                $row = $stmt ->fetch();
                if($password == $row['password']){
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["nrp"] = $row['nrp'];

                   header("location:index.php");
                }else{
                    $success = false;
                }
                // $hashed_password = $row['password'];
                // if(password_verify($password, $hashed_password)){
                //     session_start();
                //     $_SESSION["loggedin"] = true;
                //     $_SESSION["nrp"] = $row['nrp'];

                //    header("location:index.php");
                // }else{
                //     $success = false;
                // }
            }
       }
       unset($stmt);
       unset($db -> pdo);
       
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/fc45e0c6e7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {    
            <?php if (isset($success) && !$success): ?>
                $("#modal").removeClass("hidden");
                $("#close-modal").on("click", function(e) {
                    $("#modal").addClass("hidden");
                });
                setTimeout(function(e) {
                    $("#modal").addClass("hidden");
                }, 3000);
            <?php endif; ?>


            $("#reveal-pass").on("click", function(){
                $("#password").attr("type", "text");
                $("#reveal-pass").addClass("hidden");
                $("#hide-pass").removeClass("hidden");
            });

            $("#hide-pass").on("click", function(){
                $("#password").attr("type", "password");
                $("#hide-pass").addClass("hidden");
                $("#reveal-pass").removeClass("hidden");
            });

        });
    </script>
</head>
<body>
<div class="relative container mx-auto flex flex-column justify-center">
        <div class="my-10 p-10 border-[1px] rounded-lg shadow-xl">
            <h1 class="text-2xl mb-5">Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="flex flex-col gap-2 mb-10 w-[80vw] sm:w-[40vw]">
                    <div class="grid grid-cols-3 items-center">
                        <label for="identification">NRP</label>
                        <input class="px-2 py-1 col-start-2 col-end-4 rounded-full border-[1px] border-slate-300" type="text" id="identification" name="identification" value="<?php if (isset($input_identification)) echo $input_identification; ?>">
                        <?php if ($identification_err != ""): ?>
                            <span class="col-start-2 col-end-4 text-red-500 text-[8px] md:text-[12px] leading-none"><?php echo $identification_err ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="grid grid-cols-3 items-center">
                        <label for="password">Password</label>
                        <div class = "relative col-start-2 col-end-4">
                            <input type = "password" class="w-full px-2 py-1 rounded-full border-[1px] border-slate-300" id="password" name="password" value="<?php if (isset($input_password)) echo $input_password; ?>">
                            <div id = "reveal-pass" class = "cursor-pointer absolute inline-block right-[10px] top-[5px]"><i class="fa-solid fa-eye"></i></div>
                            <div id = "hide-pass" class = "hidden cursor-pointer absolute inline-block right-[10px] top-[5px]"><i class="fa-solid fa-eye-slash"></i></div>
                        </div>
                        
                        <?php if ($password_err != ""): ?>
                            <span class="col-start-2 col-end-4 text-red-500 text-[8px] md:text-[12px] leading-none"><?php echo $password_err ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="w-full"><button class="w-full button px-3 py-2 bg-black rounded-full text-white mb-5">Login</button></div>
            </form>
        </div>
    </div>

    <div id="modal" class="hidden absolute top-0 left-0 w-screen h-screen flex flex-column justify-center">
        <div class="w-full h-full bg-black opacity-50"></div>
        <div class="fixed top-10 bg-white rounded p-10 h-fit text-xl">
            <div class="flex flex-col items-center gap-4">
                <i class="text-[60px] text-red-500 fa-solid fa-circle-xmark"></i>
                <div>Password salah!</div>
                <button id="close-modal" class="bg-black py-2 px-5 rounded-full text-white">OK</button>
            </div>
        </div>
    </div>
</body>
</html>