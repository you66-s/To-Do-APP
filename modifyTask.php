<?php
    session_start();
    include './connexion.php';
    if (!$_SESSION['auth']) {
        header('Location: login.php');
    }else{
        @$idTask = $_SESSION['taskId'];
    }
    @$titleT = $_POST['taskTitle'];
    @$dateT = $_POST['taskDate'];
    @$prriorT = $_POST['taskPriority'];
    @$descT = $_POST['taskDesc'];

    if (isset($_POST['addTask'])) {
        $sqlUpdate = $cnx->prepare("UPDATE task SET title=?, date=?, Priority=?, Description=? WHERE idTask=?");
        $sqlUpdate->execute([$titleT, $dateT, $prriorT, $descT, $idTask]);
        header("Location: index.php");
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./Style/modifytTask.css">
    <title>Modify Task</title>

</head>
<body>
<form method="post" class="taskForm border-2 border-[#007DFE] flex flex-col gap-4 items-center w-1/2 rounded-lg p-4">
    <?php
        $sqlDisplay = $cnx->prepare("SELECT * FROM task WHERE idTask = ?");
        $result = $sqlDisplay->execute([$idTask]);
        $fetch = $sqlDisplay->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="inputs flex flex-col gap-2 w-full">
        <label >Title</label>
        <span class="w-full border-2 rounded-lg p-2">
                <input type="text" value="<?php echo @$fetch['title']; ?>" name="taskTitle" class="inpt w-full">
            </span>
    </div>
    <div class="inputs flex flex-col gap-2 w-full">
        <label >Date</label>
        <span class="w-full border-2 rounded-lg p-2">
                <input type="date" name="taskDate" class="inpt w-full">
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
    <button type="submit" class="bg-[#007DFE] text-white p-2 rounded-lg" name="addTask">Update Task Task</button>
</form>
</body>
</html>