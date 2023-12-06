"use strict";

    function hangON(event){
        event.preventDefault()
        console.log("LOL");
        const firstname = document.getElementById("first").value;
        const lastname = document.getElementById("last").value;
        const email = document.getElementById("mail").value;
        const password = document.getElementById("passkey").value;
        const role = document.getElementById("roler").value;
        console.log(firstname);
        console.log(lastname);
        console.log(email);
        console.log(password);
        console.log(role);
        fetch("register.php", {
            method: "POST",
            headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                first: firstname,
                last: lastname,
                email: email,
                pass: password,
                role: role,
            }).toString(),
        })
            .then((response)=>response.text())
            .then((responseText)=>{
                let resolution = responseText;
                console.log(resolution);
                if (resolution.includes("success")){
                    alert("Successful Registration");
                }
                else{
                    alert("Incorrect User Information");
                    console.log(responseText);
                }
            })
            .catch(error=>{
                console.error("Error:"+ error);
            })
        }

