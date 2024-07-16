<?php
    session_start();
    include './connexion.php';
    if (!$_SESSION['auth']) {
        header('Location: login.php');
    }else{
        @$idUser = $_SESSION['user'];
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    }
    if (isset($_POST['DeleteTask'])){
        $sqlDelete = $cnx->prepare("DELETE FROM Task WHERE idTask = ?");
        $sqlDelete->execute([$_POST['TaskId']]);
        header("Refresh:0");
    }
    if (isset($_POST['ModifyTask'])){
        $_SESSION['taskId'] = $_POST['TaskId'];
        header('location: ModifyTask.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./Style/index.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="p-4 flex flex-row items-center justify-between">
        <span class="logo">
            <img src="./assets/Images/To-Do.png" alt="Logo">
        </span>
        <ol class="navigation flex flex-row gap-4">
            <a href="./index.php"><li>Home</li></a>
            <a href="./AddTask.php"><li>Add Task</li></a>
        </ol>
        <form method="post">
            <button id="logoutBtn" class="bg-white text-[#007DFE] border-2 border-[#007DFE] p-2 rounded-lg" type="submit" name="logout">logout</button>
        </form>
    </nav>
    <section class="taskContainer w-1/2 flex flex-col gap-4 ">
    <?php
        $sqlDisplay = $cnx->prepare("SELECT * FROM task as t INNER JOIN user as u ON t.idUser = u.idUser WHERE t.idUser = '$idUser'");
        $result = $sqlDisplay->execute();

        foreach($sqlDisplay as $res){
            echo '
                <div class="taskBox w-full border-2 border-[#007DFE] rounded-lg p-2">
            <div class="title w-full">'.$res['title'].'</div>
            <div class="content flex flex-row items-center justify-between gap-4">
                <span class="desc">'.$res['Description'].'</span>
                <form method="post">
                    <input type="hidden" name="TaskId" value="'.$res['idTask'].'"> 
                    <button id="selectionBtn" name="DeleteTask" type="submit" class="submit border-2 border-black rounded-full p-2">
                        <img src="./assets/Icons/delete.png" alt="delete" width="26px" height="26px">
                    </button>
                    <button id="selectionBtn" name="ModifyTask" value="'.$res['idTask'].'" type="submit" class="submit border-2 border-black rounded-full p-2">
                        <img src="./assets/Icons/edit.png" alt="delete" width="26px" height="26px">
                    </button>
                </form>
            </div>
            <div class="infos flex flex-row justify-evenly">
                <span class="priority">Priority: '.$res['Priority'].'</span>
                <span class="Date">Due To: '.$res['date'].'</span>
            </div>
        </div>
            ';
        }

    ?>
    </section>
</body>
</html>