function contactAdd(event){
    event.preventDefault()
    const title = document.getElementById("title").value;
    const telephone = document.getElementById("number").value;
    const firstname = document.getElementById("first").value;
    const lastname = document.getElementById("last").value;
    const email = document.getElementById("mail").value;
    const company = document.getElementById("company").value;
    const assigned = document.getElementById("assign").value;
    const job = document.getElementById("job").value;
    console.log(assigned);
    
    if (!title || !telephone || !firstname || !lastname || !email || !company || !assigned || !job) {
        alert("Please fill in all required fields.");
        return;
    }

    fetch("contactRegister.php", {
        method: "POST",
        headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            first: firstname,
            last: lastname,
            email: email,
            tele: telephone,
            company: company,
            titles: title,
            assigned:assigned,
            jobs:job,

        }).toString(),
    })
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            console.log(resolution);
            if (resolution.includes("success")){
                alert("Contact Registered");
            }
            else{
                alert("Incorrect Contact Information");
                console.log(responseText);
            }
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
    }


