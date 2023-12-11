"use strict";

    function hangON(event){
        event.preventDefault()
        console.log("LOL");
        const firstname = document.getElementById("first").value;
        const lastname = document.getElementById("last").value;
        const email = document.getElementById("mail").value;
        const password = document.getElementById("passkey").value;
        const role = document.getElementById("roler").value;

            
        if (!firstname || !lastname || !email || !password || !role) {
            alert("All fields are required");
            return;
        }


        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!passwordPattern.test(password)) {
            alert("Password must follow the pattern: At least one lowercase letter, one uppercase letter, one digit, and be at least 8 characters long");
            return;
        }

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

