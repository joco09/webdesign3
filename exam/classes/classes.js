const classesArray = [{image:"images/running.jpg",day:"Monday",time: "10:00", class: "cardio", trainer: "John", button: "Sign up", showcase:"running"}, 
{image:"images/squats.jpg",day:"Sunday", time: "13:00", class: "squats", trainer: "John", button: "Sign up", showcase:"running"},
{image:"images/handstand.jpg",day:"Monday", time: "10:00", class: "handstand", trainer: "John", button: "Sign up", showcase:"running"}]
/**
 * using dom to add the calsses and information about class
 */
function loadingClasses(el){   
    for(let classes of el) {
        /*let divNode = document.createElement("div")
        divNode.className = "class"*/
        for (const classesInfo in classes) {
            let columnId= classes["time"] + "-" + classes["day"];
            //document.getElementById(columnId).appendChild(divNode);
                if (classesInfo == "showcase"){
                    let buttonDivNode = document.createElement("div")
                    buttonDivNode.className = "class-button"
                    document.getElementById(columnId).appendChild(buttonDivNode); 
                    let buttonNode = document.createElement("button")
                    buttonNode.setAttribute("type", "button");
                    let textnode = document.createTextNode(classes[classesInfo]); 
                    buttonNode.appendChild(textnode);
                    
                    buttonDivNode.appendChild(buttonNode).addEventListener("click",function(){
                        console.log("el");
                        let containerDivNode = document.createElement("div");
                        containerDivNode.className = "class-background";
                        let divNode = document.createElement("div");
                        divNode.className = "class-info";
                        containerDivNode.appendChild(divNode);

                        closePopUp(containerDivNode);

                        for (const classesInfo in classes) {
                            let columnId= classes["time"] + "-" + classes["day"];
                            document.getElementById(columnId).appendChild(containerDivNode);
                            
                            
                            if(classesInfo == "image"){
                                let imageNode = document.createElement("img")
                                imageNode.setAttribute("src", classes[classesInfo]);
                                imageNode.setAttribute("alt", "handstand");
                                divNode.appendChild(imageNode); 
                                console.log("1")
                            }
                            else if (classesInfo !== "image" && classesInfo !== "button"&& classesInfo !== "showcase"){
                                let textDiveNode = document.createElement("div");
                                textDiveNode.className = "textbox";
                                let text = classesInfo + " : " + classes[classesInfo];
                                let textnode = document.createTextNode(text); 
                                textDiveNode.appendChild(textnode);
                                divNode.appendChild(textDiveNode);   
                            }
                            else if(classesInfo == "button"){
                                let inputNode = document.createElement("input");
                                inputNode.className= "booking";
                                inputNode.setAttribute("type","submit",);
                                inputNode.setAttribute("value" ,"Submit");
                                let buttonNode = document.createElement("button");
                                buttonNode.setAttribute("type", "button");
                                let textnode = document.createTextNode(classes[classesInfo]); 
                                buttonNode.appendChild(textnode);
                                inputNode.appendChild(buttonNode);
                                divNode.appendChild(inputNode); 
                            }
                        }
                    })
                }
        }
    }
}
loadingClasses(classesArray);

/**
 * using dom to add the close button and actullu closing the popup
 */
function closePopUp(el2){
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
function test(){
    document.getElementById("adding-classes-form").style.display="block";
    console.log("show")
    closeFrom();
}
function closeFrom(){
    console.log("not show")

    document.getElementById("closeButton").addEventListener("click", function (){
        document.getElementById("adding-classes-form").style.display = "none";
        console.log("not show2")
    })
    document.getElementById("submit").addEventListener("click",validation);
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
function validation(){
    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let listOfInputs = document.getElementsByClassName("form-input");
    for (let i = 0; i < listOfInputs.length; i++)
    {
        if (listOfInputs[i].value == "" || listOfInputs[i].value == null)
        {
            console.log("1111")
            listOfWarningLabels[i].textContent = "Empty Field!";
        }
        else
        {
            console.log("2222")
            listOfWarningLabels[i].textContent = "";
        }

    }
}