
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./Style/Inscription.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<form method="post" onsubmit="return formValidation()">
    <div class="box w-1/2 flex flex-row bg-white border-2 p-4 rounded-lg items-center">
    <img src="./assets/Images/signup.jpg" alt="signup" width="400px" height="400px">
            <div class="inputs flex flex-col w-1/2 gap-6">
                <div class="fname">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/userIcon.png" alt="user" width="16px" height="16px">
                        <input class="ipt w-full" id="fname" type="text" name="fname" placeholder="Enter first name">
                    </span>
                    <span style="color: red" id="fnameError"></span>
                </div>
                <div class="lname">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/userIcon.png" alt="pwd" width="16px" height="16px">
                        <input class="ipt w-full" id="lname" name="lname" type="text" placeholder="Enter last name">
                    </span>
                    <span style="color: red" id="lnameError"></span>
                </div>
                <div class="username">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/userIcon.png" alt="pwd" width="16px" height="16px">
                        <input class="ipt w-full" id="uname" name="Uname" type="text" placeholder="Enter username">
                    </span>
                    <span style="color: red" id="unameError"></span>
                </div>
                <div class="email">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/email.png" alt="pwd" width="16px" height="16px">
                        <input class="w-full" id="email" name="email" type="email" placeholder="Enter email">
                    </span>
                    <span style="color: red" id="emlError"></span>
                </div>
                <div class="password">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/lock.png" alt="pwd" width="16px" height="16px">
                        <input class="ipt w-full" id="pwd" name="pwd" type="password" placeholder="Enter password">
                    </span>
                    <span style="color: red" id="pwdError"></span>
                </div>

                <div class="confPass">
                    <span class="flex flex-row gap-4 items-center p-2 border-2 rounded-lg w-full">
                        <img src="./assets/Icons/lock.png" alt="pwd" width="16px" height="16px">
                        <input class="ipt w-full" id="confPwd" name="confPwd" type="password" placeholder="Confirm your password">
                    </span>
                    <span style="color: red"  id="confPwdError"></span>
                </div>
                <button type="submit" onsubmit="testFields()" class="loginBtn bg-[#007DFE] text-white p-2 rounded-lg" name="signup">sign up</button>
                <?php
                    include 'connexion.php';
                    @$fname = $_POST['fname'];
                    @$lname = $_POST['lname'];
                    @$userName = $_POST['Uname'];
                    @$email = $_POST['email'];
                    @$pwd = $_POST['pwd'];
                    @$confPwd = $_POST['confPwd'];
                
                
                    $exeSQL1 = $cnx->prepare("SELECT * FROM user WHERE login = '$userName'");
                    $exeSQL2 = $cnx->prepare("INSERT INTO user(login, nom, prenom, email, password) VALUES ('$userName', '$fname', '$lname', '$email', '$confPwd')");
                    if (isset($_POST['signup'])) {
                        $exeSQL1->execute();
                        if ($exeSQL1->rowCount()==1) {
                            echo '<span id="err">user Already exists</span>';
                        }else {
                            if ($pwd != $confPwd) {
                                echo '<span id="err">password not match</span>';
                            }else {
                                $exeSQL2->execute();
                                header('Location: login.php');
                            }
                        }
                     }
                ?>
                <span id="textAcc">Already have an account?<a href="./login.php" class="text-[#007DFE]"> Login</a></span>
            </div>
        </div>
</form>
<script src="./js/signupVerification.js"></script>
</body>
</html>