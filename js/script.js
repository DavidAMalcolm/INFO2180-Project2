"use strict";
document.addEventListener("DOMContentLoaded",function(){
    let prompt = document.getElementById("prompter");

prompt.addEventListener("click",function(event){
    event.preventDefault();
    const user = document.getElementById("user").value;
    const pass = document.getElementById("pass").value;

    if (!user || !pass) {
        alert("Username and password are required");
        return;
    }

    fetch("login.php",{
        method:"POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            username: user,
            pass: pass,
        }).toString(),
    })
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            if (resolution.includes("success")){
                //something
                getPage("dashboard.php");
                getSide("sidebar.html");
                console.log(resolution);
            }
            else{
                alert("Incorrect User Information");
                console.log(resolution);
            }
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
})

function getPage(url){
    fetch(url)
        .then(response => response.text())
        .then(html=>{
            document.getElementsByTagName('main')[0].innerHTML = html;
            document.getElementsByTagName('main')[0].style.display = "block";
            document.getElementsByTagName('main')[0].style.gridColumn = 2;
            document.getElementsByTagName("footer")[0].style.marginTop = "0px";
        }).catch(error => {
            console.log(error);
        })
}

function getSide(url){
    fetch(url)
        .then(response => response.text())
        .then(html=>{
            document.getElementsByTagName('nav')[0].innerHTML = html;
        }).catch(error => {
            console.log(error);
        })
}

})
