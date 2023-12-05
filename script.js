"use strict";
document.addEventListener("DOMContentLoaded",function(){
    let prompt = document.getElementById("prompter");

prompt.addEventListener("click",function(event){
    event.preventDefault();
    const user = document.getElementById("user").value;
    const pass = document.getElementById("pass").value;

    fetch("login.php",{
        method:"POST",
        body:`username=${user}&pass=${pass}`,
    })
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            if (resolution.includes("succesfull")){
                //something
                console.log(resolution);
            }
            else{
                alert("Incorrect User Information");
            }
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
})

})
