const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);

let membershipType = "";
document.getElementById("Bronze").addEventListener("click", function (){
    membershipType = document.getElementById("Bronze").value;
})
document.getElementById("Silver").addEventListener("click", function (){
    membershipType = document.getElementById("Silver").value;
})
document.getElementById("Gold").addEventListener("click", function (){
    membershipType = document.getElementById("Gold").value;
    console.log(membershipType)
})

function validate()
{
    let regx = new RegExp("^([a-zA-Z0-9\\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$");
    let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let listOfInputs = document.getElementsByClassName("form")[0].getElementsByTagName("input");

    for (let i = 0; i < listOfInputs.length; i++)
    {
        if (listOfInputs[i].value == "" || listOfInputs[i].value == null)
        {
            listOfWarningLabels[i].textContent = "Empty Field!";
        }
        else
            listOfWarningLabels[i].textContent = "";

    }

    if (listOfInputs[3].value == "" || listOfInputs[3].value == null)
        listOfWarningLabels[3].textContent = "(Empty field!)";
    else if (!regx.test(listOfInputs[3].value))
        listOfWarningLabels[3].textContent = "(Invalid email!)";
    else
        listOfWarningLabels[3].textContent = "";

    if (listOfInputs[4].value == "" || listOfInputs[4].value == null)
        listOfWarningLabels[4].textContent = "(Empty field!)";
    else if (!mediumRegex.test(listOfInputs[4].value))
        listOfWarningLabels[4].textContent = "PIN not strong enough.";
    else
        listOfWarningLabels[4].textContent = "";


    if (listOfInputs[4].value != "" && listOfInputs[4].value != null && listOfInputs[5].value != "" && listOfInputs[5].value != null)
    {
        if (listOfInputs[4].value !== listOfInputs[5].value)
            listOfWarningLabels[5].textContent = "PINs don't match."
    }

    let formInps = document.getElementsByClassName("form")[0].getElementsByTagName("input");
    let actualFormInps = document.getElementsByTagName("form")[0].getElementsByTagName("input");



    actualFormInps[0].value = formInps[0].value;
    actualFormInps[1].value = formInps[1].value;
    actualFormInps[2].value = formInps[2].value;
    actualFormInps[3].value = formInps[3].value;
    actualFormInps[4].value = formInps[4].value;
    actualFormInps[5].value = membershipType;
    actualFormInps[6].click();

}

const showButton1 = document.getElementsByClassName("passwordInputContainer")[0].getElementsByTagName("button")[0];
const showButton2 = document.getElementsByClassName("passwordInputContainer")[1].getElementsByTagName("button")[0];
showButton1.addEventListener("click", showPassword);
showButton2.addEventListener("click", showPassword);

function showPassword(e)
{
    let passwordInput = e.currentTarget.parentElement.children[0];
    let img = e.currentTarget.children[0];

    if (passwordInput.type == "password")
    {
        passwordInput.type = "text";
        img.src = "..\\images\\seen.png";
    }
    else
    {
        passwordInput.type = "password";
        img.src = "..\\images\\eye.png";
    }
}

for (const membershipBtns of document.getElementsByClassName("membershipsContainer")[0].getElementsByTagName("button"))
{
    membershipBtns.addEventListener("click", chooseMembership);
}

function chooseMembership(e)
{
    if (!e.currentTarget.parentElement.classList.contains("highlight"))
    {
        e.currentTarget.parentElement.classList.add("highlight");
        for (const siblingDiv of document.getElementsByClassName("membershipsContainer")[0].getElementsByTagName("div"))
        {
            if (siblingDiv === e.currentTarget.parentElement)
                continue;
            else
                siblingDiv.classList.remove("highlight");
        }
    }
    else
    {
        e.currentTarget.parentElement.classList.remove("highlight");
    }
}
