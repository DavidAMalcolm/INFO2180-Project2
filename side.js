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
  getSide("");
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
      .then(() => {
          getPage("index.html");
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
