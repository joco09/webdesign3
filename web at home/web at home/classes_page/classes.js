document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navList = document.querySelector('.nav-list');

    hamburgerMenu.addEventListener('click', () => {
        navList.classList.toggle('active');
    });
});




const classesArray = [{image:"../images/running.jpg",day:"Monday",time: "10:00", class: "cardio", trainer: "John", button: "Sign up"}, 
{image:"../images/squats.jpg",day:"Sunday", time: "13:00", class: "squats", trainer: "John", button: "Sign up"},
{image:"../images/handstand.jpg",day:"Monday", time: "10:00", class: "handstand", trainer: "John", button: "Sign up"},
{image:"../images/handstand.jpg",day:"Wednesday", time: "10:00", class: "handstand", trainer: "John", button: "Sign up"},
{image:"../images/handstand.jpg",day:"Saturday", time: "16:00", class: "handstand", trainer: "John", button: "Sign up"},
{image:"../images/handstand.jpg",day:"Friday", time: "9:00", class: "handstand", trainer: "John", button: "Sign up"}]

function loadingClasses(element){   
    for(let classes of element) {
        for (const classesInfo in classes) {
            const columnId= classes["day"];
            console.log(columnId)
            const divNode = document.createElement("div")
            divNode.className = "class";
            document.getElementById(columnId).appendChild(divNode); 
            if(classesInfo == "image"){
                let imageNode = document.createElement("img")
                imageNode.setAttribute("src", classes[classesInfo]);
                imageNode.setAttribute("alt", "handstand");
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
            else{
                let buttonNode = document.createElement("button")
                buttonNode.setAttribute("type", "button");
                let textnode = document.createTextNode(classes[classesInfo]); 
                buttonNode.appendChild(textnode);
                divNode.appendChild(buttonNode); 
            }
        }
    }
}
loadingClasses(classesArray);