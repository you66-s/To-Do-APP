<?php
    session_start();
    include 'connexion.php';
    if (!$_SESSION['auth']) {
        header('Location: login.php');
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    }
    @$titleT = $_POST['taskTitle'];
    @$dateT = $_POST['taskDate'];
    @$prriorT = $_POST['taskPriority'];
    @$descT = $_POST['taskDesc'];
    @$idUser = $_SESSION['user'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./Style/AddTask.css">

</head>
<body>
    <nav class="flex flex-row items-center justify-between">
            <span class="logo">
                <img src="./assets/Images/To-Do.png" alt="Logo">
            </span>
            <ol class="navigation flex flex-row gap-4">
                <a href="./index.php"><li>Home</li></a>
                <a href="./AddTask.php"><li>Add Task</li></a>
                <a href="#"><li>about</li></a>
                <a href="#"><li>Contact us</li></a>
            </ol>
            <form method="post">
                <button class="bg-white text-[#007DFE] border-2 border-[#007DFE] p-2 rounded-lg" type="submit" name="logout">logout</button>
            </form>
    </nav>
    <form method="post" onsubmit="return formValidation()" class="taskForm border-2 border-[#007DFE] flex flex-col gap-4 items-center w-1/2 rounded-lg p-4">
        <div class="inputs flex flex-col gap-2 w-full">
            <label >Title</label>
            <span class="w-full border-2 rounded-lg p-2">
                <input type="text" id="taskTitle" name="taskTitle" class="inpt w-full">
            </span>
        </div>
        <div class="inputs flex flex-col gap-2 w-full">
            <label >Date</label>
            <span class="w-full border-2 rounded-lg p-2">
                <input type="date" id="taskDate" name="taskDate" class="inpt w-full">
            </span>
        </div>
        <div class="inputs flex flex-col gap-2 w-full">
            <label >Priority</label>
            <span class="w-full flex flex-row gap-2 items-center"> 
                <div class="radioBtn flex flex-row gap-2">
                    <span>Extreme</span>
                    <input type="radio" name="taskPriority" value="Extreme" class="inpt" checked>
                </div>
                <div class="radioBtn flex flex-row gap-2">
                    <span>Moderate</span>
                    <input type="radio" value="Moderate" name="taskPriority" class="inpt">
                </div>
                <div class="radioBtn flex flex-row gap-2">
                    <span>Low</span>
                    <input type="radio" value="Low" name="taskPriority" class="inpt">
                </div>
            </span>
        </div>
        <div class="inputs flex flex-col gap-2 w-full">
            <label >Task Description</label>
            <span class="w-full border-2 rounded-lg p-2">
                <textarea name="taskDesc" id="descArea" class="w-full" placeholder="start writing here"></textarea>
            </span>
        </div>
        <button type="submit" onclick="taskVerification()" class="bg-[#007DFE] text-white p-2 rounded-lg" name="addTask">Add Task</button>
        <span style="color: red" id="taskError"></span>
        <?php
            if (isset($_POST['addTask'])) {
                $sqlAdd = $cnx->prepare("INSERT INTO task (title, date, Priority, Description, idUser) VALUES ('$titleT', '$dateT', '$prriorT', '$descT', '$idUser')");
                $sqlAdd->execute();
                echo '<span id="successP">Task Added successfully</span>';
            }
        ?>
    </form>
    <script src="js/TaskAdd.js"></script>
</body>
</html>