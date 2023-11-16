/*document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navList = document.querySelector('.nav-list');

    hamburgerMenu.addEventListener('click', () => {
        navList.classList.toggle('active');
    });
})*/

document.getElementById("submit").disabled = true;

const formInputes = document.querySelectorAll(".form-input");
formInputes.forEach(formData => {
    formData.addEventListener("blur", function formValidation(){
    console.log(formData.value)
    if (formData.value == "" || formData.value == null){
        const divNode = document.createElement("div")
        const emptyErrorMessage = "Empty field!"
        let textnode = document.createTextNode(emptyErrorMessage);
        divNode.appendChild(textnode)
        document.getElementById("q").appendChild(divNode).style.color = "red";
    }
    else{
        document.getElementById("submit").disabled = false;
    }
});
    //console.log(formdata)
});

/*const divNode = document.createElement("div")
        const emptyErrorMessage = "Empty field!"
        let textnode = document.createTextNode(emptyErrorMessage);
        divNode.appendChild(textnode)
        document.getElementById("time").appendChild(divNode).style.color = "red";*/
function formValidation(formData){
    console.log("!")
    if (formData == "" || formData == null){
        const emptyErrorMessage = "Empty field!"
        let textnode = document.createTextNode(emptyErrorMessage);
        divNode.appendChild(textnode)
        formData.appendChild(divNode).style.color = "red";
    }
}