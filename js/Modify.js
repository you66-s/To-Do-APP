function taskVerification() {
    const taskTitle = String(document.getElementById("tTitle").value);
    const taskDate = String(document.getElementById("tDate").value);
    if (taskDate.length === 0 || taskTitle.length === 0){
        document.getElementById("taskError").innerHTML = "Please fill out all the fields require";
        return false
    }else {
        return true
    }
}
function formValidation(){
    return taskVerification();
}