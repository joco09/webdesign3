const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);
// Gets register button and assigns it a function;

let membershipType = "";
// variable for membership type.

document.getElementById("Bronze").addEventListener("click", function (){
    membershipType = document.getElementById("Bronze").value;
})
// event listener to turn the membership type into Bronze.

document.getElementById("Silver").addEventListener("click", function (){
    membershipType = document.getElementById("Silver").value;
})
// event listener to turn the membership type into Silver.

document.getElementById("Gold").addEventListener("click", function (){
    membershipType = document.getElementById("Gold").value;
})
// event listener to turn the membership type into Gold.

function validate()
{
    let regx = new RegExp("^([a-zA-Z0-9\\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$");
    // Regular Expression for inputs that do not adhere email formats.

    let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    // Regular Expression for inputs that aren't strong enough as passwords.

    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    // list of warning labels.
    let listOfInputs = document.getElementsByClassName("form")[0].getElementsByTagName("input");
    // list of inputs.

    for (let i = 0; i < listOfInputs.length; i++)
    {
        if (listOfInputs[i].value == "" || listOfInputs[i].value == null)
            // if input is empty a comment will show saying empty.
            listOfWarningLabels[i].textContent = "Empty Field!";
            // display warning.
        else
            listOfWarningLabels[i].textContent = "";
            // reset label.
    }

    if (listOfInputs[5].value == "" || listOfInputs[5].value == null)
        listOfWarningLabels[5].textContent = "Empty field!";
    // shows an empty field message when input is empty.
    else if (listOfInputs[5].value !== listOfInputs[4].value)
        listOfWarningLabels[5].textContent = "PINs don't match.";
    // shows warning message when password and confirm password aren't identical.
    else
        listOfWarningLabels[5].textContent = "";
    // else reset label.

    if (listOfInputs[3].value == "" || listOfInputs[3].value == null)
        listOfWarningLabels[3].textContent = "Empty field!";
    // shows an empty field message when input is empty.
    else if (!regx.test(listOfInputs[3].value))
        listOfWarningLabels[3].textContent = "Invalid email!";
    // shows invalid email message when email doesnt meet standard.
    else
        listOfWarningLabels[3].textContent = "";
    // else reset label.

    if (listOfInputs[4].value == "" || listOfInputs[4].value == null)
        listOfWarningLabels[4].textContent = "Empty field!";
    // shows an empty field message when input is empty.
    else if (!mediumRegex.test(listOfInputs[4].value))
        listOfWarningLabels[4].textContent = "PIN not strong enough.";
    // displays warning message when the input password is not strong enough.
    else
        listOfWarningLabels[4].textContent = "";
    // else reset label.

    let membershipDiv = document.getElementsByClassName("membershipsContainer")[0];
    // Gets container of membership selection section.

    // Loops through the divs inside it.
    for (const div of membershipDiv.getElementsByTagName("div"))
    {
        if (!div.classList.contains("highlight"))
            // if no div is highlighted then set warning message.
            listOfWarningLabels[6].textContent = "Choose membership!";
        else
        // if one of the divs is highlighted, reset label and break out of the loop.
        {
            listOfWarningLabels[6].textContent = "";
            break;
            // else reset label and break out of the loop.
        }

    }

    if (listOfInputs[0].value != "" && listOfInputs[0].value != null && listOfInputs[1].value != "" && listOfInputs[1].value != null && listOfInputs[2].value != "" && listOfInputs[2].value != null && listOfInputs[3].value != "" && listOfInputs[3].value != null && listOfInputs[4].value != "" && listOfInputs[4].value != null && listOfInputs[5].value != "" && listOfInputs[5].value != null && listOfInputs[6].value != "" && listOfInputs[6].value != null)
    // If all the warning labels are not empty...
    {
        let actualFormInps = document.getElementsByTagName("form")[0].getElementsByTagName("input");
        // Get the actual form in the page which is not displayed.

        actualFormInps[0].value = listOfInputs[0].value;
        actualFormInps[1].value = listOfInputs[1].value;
        actualFormInps[2].value = listOfInputs[2].value;
        actualFormInps[3].value = listOfInputs[3].value;
        actualFormInps[4].value = listOfInputs[4].value;
        actualFormInps[5].value = membershipType;
        actualFormInps[6].click();
        // Set each of those inputs' values to the displayed form's inputs' values.
        // Sends post request by clicking the button in the actual form.
    }
}

const phoneNumberInput = document.getElementsByClassName("form")[0].getElementsByTagName("input")[2];
phoneNumberInput.addEventListener("keydown", preventTyping);
// get phone number input and assigns it a function.

function preventTyping(e)
{
    let phoneRegex = new RegExp("^[0-9]", "g");
    // Regular Expression that prevents numbers to be entered.

    if (e.key == "Backspace" || e.key == "ArrowLeft" || e.key == "ArrowRight")
        // Allows BackSpace and Arrows.
        return;
    else if(!phoneRegex.test(e.key) || e.currentTarget.value.length == 11)
        // Prevent character to be input if it is not a number or the whole number length is greater than 11.
        e.preventDefault();
}

const showButton1 = document.getElementsByClassName("passwordInputContainer")[0].getElementsByTagName("button")[0];
const showButton2 = document.getElementsByClassName("passwordInputContainer")[1].getElementsByTagName("button")[0];
// buttons to see the password as plain text.

showButton1.addEventListener("click", showPassword);
showButton2.addEventListener("click", showPassword);
// event listeners for show password.

function showPassword(e)
{
    let passwordInput = e.currentTarget.parentElement.children[0];
    // Gets the show button that triggered this function.
    let img = e.currentTarget.children[0];
    // Gets the image inside the show button.

    if (passwordInput.type == "password")
    {
        passwordInput.type = "text";
        // Set input type to show plain text.
        img.src = "..\\images\\seen.png";
    }
    else
    {
        passwordInput.type = "password";
        // Set input type to censor text.
        img.src = "..\\images\\eye.png";
    }
}

// loops through all the buttons inside the membership section and assigns them a function.
for (const membershipBtns of document.getElementsByClassName("membershipsContainer")[0].getElementsByTagName("button"))
    membershipBtns.addEventListener("click", chooseMembership);

function chooseMembership(e)
// this function is responsible for highlighting the membership chosen by the user.
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

        // Highlights the selected button and makes sure other buttons are not highlighted.
    }
    else
        e.currentTarget.parentElement.classList.remove("highlight");
    // Removes highlight if user deselectes button.
}
