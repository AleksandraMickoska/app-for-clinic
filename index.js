$(document).ready(function(){

});
  

function Login()
{
    let email = document.getElementById('email');
    let password = document.getElementById('password');

    let data = new FormData();
    data.append("method", "LogIn");
    data.append("email", email.value);
    data.append("password", password.value);

    let xtmlRequest = new XMLHttpRequest();
    xtmlRequest.open("POST", "Services/Controler.php");
    xtmlRequest.onload = function ()
    {
        insertPatients(this.response)
    };
    xtmlRequest.send(data);
    return false;
}

function insertPatients(patients)
{
    console.log(patients);
}