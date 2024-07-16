function passwordCheck() {
    const password = String(document.getElementById('pwd').value);
    const confirmPassword = String(document.getElementById('confPwd').value);
    if (password.length < 8){
        document.getElementById("pwdError").innerHTML = "password must be more than 8 characters";
        return false;
    }else if (password !== confirmPassword){
        document.getElementById("pwdError").innerHTML = "password doesn't match";
        document.getElementById("confPwdError").innerHTML = "password doesn't match";
        return false;   
    }else return true;
}

function checkEmail() {
    const email = String(document.getElementById('email').value)
    if (email.length === 0 || !email.includes("@")){
        document.getElementById("emlError").innerHTML = "email is incorrect";
        return false
    }else return true;

}
function checkCrd() {
    const fname = String(document.getElementById('fname').value);
    const lname = String(document.getElementById('lname').value);
    const uname = String(document.getElementById('uname').value);
    if (fname.length===0){
        document.getElementById("fnameError").innerHTML = "fill out this field";
        return false;
    }else if (lname.length===0){
        document.getElementById("lnameError").innerHTML = "fill out this field";
        return false;
    }else if(uname.length===0){
        document.getElementById('unameError').innerHTML = "fill out this field";
        return false;
    }else if (uname.length < 3){
        document.getElementById("unameError").innerHTML = "username must be more than 3 characters";
        return false;
    }else return true
}
function testFields() {
    return (passwordCheck() && checkEmail() && checkCrd());
}
function formValidation() {
    return testFields();
}