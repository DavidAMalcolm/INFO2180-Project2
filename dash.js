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
            console.log(resolution);
            document.getElementsByTagName('main')[0].innerHTML = resolution;
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