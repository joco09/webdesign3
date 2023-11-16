const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);

function validate()
{
    let regx = new RegExp("^([a-zA-Z0-9\\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$");
    let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");


    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let li = document.getElementsByClassName("inputsContainer")[0];
    let listOfInputs = li.getElementsByTagName("input");

    console.log(regx.test(listOfInputs[0].value));

    if (listOfInputs[0].value == "" || listOfInputs[0].value == null)
        listOfWarningLabels[0].textContent = "(Empty field!)";
    else if (!regx.test(listOfInputs[0].value))
        listOfWarningLabels[0].textContent = "(Invalid email!)";
    else
        listOfWarningLabels[0].textContent = "";

    if (listOfInputs[1].value == "" || listOfInputs[1].value == null)
        listOfWarningLabels[1].textContent = "(Empty field!)";
    else if (!mediumRegex.test(listOfInputs[1].value))
        listOfWarningLabels[1].textContent = "Password not strong enough";
    else
        listOfWarningLabels[1].textContent = "";
    
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
        img.src = "Images\\seen.png";
    }
    else
    {
        passwordInput.type = "password";
        img.src = "Images\\eye (1).png";
    }
}
