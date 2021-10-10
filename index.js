$(document).ready(function(){

});

function Login()
{
    let emailValue = document.getElementById("email").value;
    let passwordValue = document.getElementById("password").value;

    let data = new FormData();
    data.append("method", "Login");
    data.append("email", emailValue);
    data.append("password", passwordValue);

    let xtmlRequest = new XMLHttpRequest();
    xtmlRequest.open("POST", "Services/Service.php");
    xtmlRequest.onload = function () {
        //
    };
    xtmlRequest.send(data);
    console.log('Bidna');
    return false;
}


