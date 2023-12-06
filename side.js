"use strict";

function newUser(event){
    event.preventDefault();
    getPage("add.html");
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
        getPage();
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
