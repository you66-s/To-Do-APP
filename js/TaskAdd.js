

function taskVerification() {
    const taskTitle = String(document.getElementById("taskTitle").value);
    const taskDate = String(document.getElementById("taskDate").value);
    if (taskDate.length === 0 || taskTitle.length === 0){
        document.getElementById("taskError").innerHTML = "Please fill out all the fields require";
        return false
    }else {
        return true
    }
}
function formValidation(e){
    return taskVerification();
}