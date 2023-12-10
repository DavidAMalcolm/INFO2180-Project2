function addContact(event){
    event.preventDefault();
    getPage("contactAdd.php");
}


function detailView(event){
    event.preventDefault();
    const email = event.currentTarget.getAttribute('data-custom-value');
    console.log(email);
    fetch(`contactDetail.php?mail=${encodeURIComponent(email)}`)
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            document.getElementsByTagName('main')[0].innerHTML = resolution;
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
}

function assignMe(event){
    event.preventDefault();
    const mail = document.getElementById("emailer").innerText;

    fetch("assign.php", {
        method: "POST",
        headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            email: mail
        }).toString(),
    })
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            console.log(resolution);
            if (resolution.includes("success")){
                getPage("dashboard.php");
            }
            else{
                alert("Unable to Assign");
                console.log(responseText);
            }
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
    
}

function switchMe(event){
    const mailer = document.getElementById("emailer").innerText;
    event.preventDefault();
    console.log(mailer);
    fetch("switch.php", {
        method: "POST",
        headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            email: mailer
        }).toString(),
    })
        .then((response)=>response.text())
        .then((responseText)=>{
            let resolution = responseText;
            console.log(resolution);
            if (resolution.includes("success")){
                getPage("dashboard.php");
            }
            else{
                alert("Unable to Assign");
                console.log(responseText);
            }
        })
        .catch(error=>{
            console.error("Error:"+ error);
        })
    
}


function getPage(url){
    fetch(url)
        .then(response => response.text())
        .then(html=>{
            document.getElementsByTagName('main')[0].innerHTML = html;
        }).catch(error => {
            console.log(error);
        })
}
