<?php
    session_start();
    include 'connexion.php';
    @$login = $_POST['userN'];
    @$pwd = $_POST['pwd'];
    $sqlUser = "SELECT idUser, login FROM user where login = '$login'";
    $sqlPwd = "SELECT password FROM user where password = '$pwd'";
    $executeUserSQL = $cnx->prepare($sqlUser);
    $executePwdSQL = $cnx->prepare($sqlPwd);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Login_style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form method="post" id="LoginF">
        <div class="box w-1/2 flex flex-row bg-white border-2 p-4 rounded-lg items-center">
            <div class="inputs flex flex-col w-1/2 gap-6">

                <div class="login">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/userIcon.png" alt="user" width="16px" height="16px">
                        <input class="w-full" id="userInp" type="text" name="userN" placeholder="Enter username"> 
                    </span>
                </div>
                <div class="pwd">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/lock.png" alt="pwd" width="16px" height="16px">
                        <input class="w-full" id="userInp" name="pwd" type="password" placeholder="Enter password"> 
                    </span>
                </div>
                <button type="submit" class="loginBtn bg-[#007DFE] text-white p-2 rounded-lg" name="login">Login</button>
                <?php
                    
                    if (isset($_POST['login'])) {
                        $executeUserSQL->execute();
                        $executePwdSQL->execute();
                        //FETCHING DATA
                        $result = $executeUserSQL->fetch(PDO::FETCH_ASSOC);
                        if ($executeUserSQL->rowCount()==1 && $executePwdSQL->rowCount()==1) {
                            $_SESSION['auth'] = true;
                            $_SESSION['user'] = $result['idUser'];
                            header('Location: index.php');
                        }else if ($executeUserSQL->rowCount()==0 || $executePwdSQL->rowCount()==0) {
                            echo '<span class="colorErr">email/password incorrect</span>';

                        }else if ($executeUserSQL->rowCount()==0 && $executePwdSQL->rowCount()==0) { 
                         echo '<span class="colorErr">Account not found must signup</span>';
                        }
                    }
                ?>
                <span id="textAcc">Don't have an account?<a href="./signup.php" class="text-[#007DFE]"> Create one</a></span>
            </div>
            <img src="./assets/Images/login.jpg" alt="login" width="400px" height="400px">
        </div>
    </form>
</body>
</html>