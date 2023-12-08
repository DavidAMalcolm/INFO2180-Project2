"use strict";

function newUser(event){
    event.preventDefault();
    getPage("add.html");
}

function userList(event){
  event.preventDefault();
  getPage("users.php");
}

function logOut(event){
  event.preventDefault();
  logoutUser();
}

function handleMenuItemClick(caseNo) {
    switch (caseNo) {
      case 0:
        getPage();
        break;
      case 1:
        getPage('add.html');
        break;
      case 2:
        getPage("users.php");
        break;
      default:
        getPage();
        break;
    }
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


function logoutUser() {
  fetch("logout.php")
      .then(response => {
          if (response.ok) {
              return response.text();
          } else {
              throw new Error("Logout request failed.");
          }
      })
      .then((responseText) => {
          document.getElementsByTagName('html')[0].innerHTML = responseText;
          
            let prompt = document.getElementById("prompter");
        
            prompt.addEventListener("click",function(event){
              event.preventDefault();
              const user = document.getElementById("user").value;
              const pass = document.getElementById("pass").value;
        
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
                        getPage("add.html");
                        document.getElementsByTagName('main')[0].style.display = "block";
                        document.getElementsByTagName('main')[0].style.gridColumn = 2;
                        document.getElementsByTagName("footer")[0].style.marginTop = "0px";
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
        })
          
      .catch(error => {
          console.error("Error: " + error.message);
      });
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
