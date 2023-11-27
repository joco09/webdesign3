const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);

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

    let yo = document.getElementsByClassName("form")[0].getElementsByTagName("input");
    let bo = document.getElementsByTagName("form")[0].getElementsByTagName("input");

    bo[0].value = yo[0].value;
    bo[1].value = yo[1].value;
    bo[2].value = yo[2].value;
    bo[3].value = yo[3].value;
    bo[4].value = yo[4].value;
    bo[5].value = 4;
    bo[6].click();
    
}

const showButton = document.getElementsByClassName("passwordInputContainer")[0].getElementsByTagName("button")[0];
showButton.addEventListener("click", showPassword);

function showPassword(e)
{
    let passwordInput = document.getElementsByClassName("passwordInputContainer")[0].getElementsByTagName("input")[0];
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