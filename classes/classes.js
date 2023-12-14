/**
 * using dom to add the close button and actullu closing the popup
 */
function closePopUp(el2)
{
    /*
    closeButtonNode.addEventListener("click", function(){
        console.log(el2)
        el.appendChild(divNod);
        el2.remove();
    })*/
    el2.addEventListener("click", function(){
        console.log(el2)
        el2.style.display="none";
    })
}

document.getElementById("adding-classes-form").style.display = "none";
document.getElementById("add-classes").addEventListener("click",test)

function test()
{
    document.getElementById("adding-classes-form").style.display="block";
    console.log("show")
    closeFrom();
}

function closeFrom()
{
    document.getElementById("closeButton").addEventListener("click", function (){
        document.getElementById("adding-classes-form").style.display = "none";
        console.log("not show2")
    })
    document.getElementById('submit').addEventListener("click", validation)
    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let listOfInputs = document.getElementsByClassName("form-input");
    for (let i = 0; i < listOfInputs.length; i++) {
        listOfInputs[i].addEventListener('blur', function (){
            if (listOfInputs[i].value != "" || listOfInputs[i].value != null){
                listOfWarningLabels[i].textContent = "";
                document.getElementById("submit").disabled = false;
            }
        })
    }
}

/**
 * using dom to add show to add classes form
 */
/*document.getElementById("add-classes").addEventListener("click", function(){
    const background = document.getElementById("test");
    const addingClassForm = document.getElementById("adding-classes-form");
    addingClassForm.style.display = "block";
    background.addEventListener("click", function (){
        closePopUp(background);
    })

})*/
/**
 * vertifying  class form
 */

/*document.getElementById("submit").disabled = true;

const formInputes = document.querySelectorAll(".form-input");
formInputes.forEach(formData => {
    formData.addEventListener("blur", function formValidation(){
    
    if (formData.value == "" || formData.value == null){
        console.log(formData)
        const divNode = document.createElement("div")
        const emptyErrorMessage = "Empty field!"
        const textnode = document.createTextNode(emptyErrorMessage);
        divNode.appendChild(textnode);
        formData.appendChild(divNode).style.color = "red";
    }
    else{
        document.getElementById("submit").disabled = false;
    }
});
    //console.log(formdata)
});*/
function validation()
{
    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let listOfInputs = document.getElementsByClassName("form-input");
    for (let i = 0; i < listOfInputs.length; i++) {
        if (listOfInputs[i].value == "" || listOfInputs[i].value == null) {
            listOfWarningLabels[i].textContent = "Empty Field!";
            document.getElementById("submit").disabled = true;
        }
    }
}

const forms = document.querySelector("form.class");

for (const form of forms)
{
    let button = form.getElementsByTagName("button")[0];
    if (button.name === "bookingClass")
        button.addEventListener("click", (e) => { e.currentTarget.textContent === "Booked" ? e.currentTarget.textContent = "Book Class" : e.currentTarget.textContent = "Booked"});
}
