document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navList = document.querySelector('.nav-list');

    hamburgerMenu.addEventListener('click', () => {
        navList.classList.toggle('active');
    });
});




const classesArray = [{image:"images/running.jpg",day:"Monday",time: "10:00", class: "cardio", trainer: "John", button: "Sign up", showcase:"running"}, 
{image:"images/squats.jpg",day:"Sunday", time: "13:00", class: "squats", trainer: "John", button: "Sign up", showcase:"running"},
{image:"images/handstand.jpg",day:"Monday", time: "10:00", class: "handstand", trainer: "John", button: "Sign up", showcase:"running"}]

function loadingClasses(){   
    for(let classes of classesArray) {
        for (const classesInfo in classes) {
            let columnId= classes["time"] + "-" + classes["day"];
            console.log(columnId)
            let divNode = document.createElement("div")
                divNode.className = "class"
                document.getElementById(columnId).appendChild(divNode); 
                if(classesInfo == "image"){
                    let imageNode = document.createElement("img")
                    imageNode.setAttribute("src", classes[classesInfo]);
                    imageNode.setAttribute("alt", "handstand");
                    imageNode.setAttribute("style", "width: 50%");
                    divNode.appendChild(imageNode); 
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
                    let divNode = document.createElement("div")
                    divNode.className = "class"
                    let buttonNode = document.createElement("button")
                    buttonNode.setAttribute("type", "button");
                    let textnode = document.createTextNode(classes[classesInfo]); 
                    buttonNode.appendChild(textnode);
                    divNode.appendChild(buttonNode); 
                }
                else{
                    console.log("111")
                    let divNode = document.createElement("div")
                    divNode.className = "class-button"
                    document.getElementById(columnId).appendChild(divNode); 
                    let buttonNode = document.createElement("button")
                    buttonNode.setAttribute("type", "button");
                    let textnode = document.createTextNode(classes[classesInfo]); 
                    buttonNode.appendChild(textnode);
                    divNode.appendChild(buttonNode); 
                }
        }
    }
}
loadingClasses();
function classPopUp(){
    document.getElementsByClassName("class").style.display ="none";
}
document.getElementsByClassName("class-button").addEventListener("click",classPopUp)