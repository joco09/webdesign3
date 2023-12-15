
const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);
// This event listener validates function to validate the user input.


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
    console.log(membershipType)
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
        // for loop to validate each inputs.

    {
        if (listOfInputs[i].value == "" || listOfInputs[i].value == null)
            // if input is empty a comment will show saying empty.

        {
            listOfWarningLabels[i].textContent = "Empty Field!";
            //    warning label "Empty Field".
        }
        else
            listOfWarningLabels[i].textContent = "";
        //

    }

    if (listOfInputs[3].value == "" || listOfInputs[3].value == null)
        listOfWarningLabels[3].textContent = "(Empty field!)";
    // shows an empty field message when input is empty.

    else if (!regx.test(listOfInputs[3].value))
        listOfWarningLabels[3].textContent = "(Invalid email!)";
    // shows invalid email message when email doesnt meet standard.

    else
        listOfWarningLabels[3].textContent = "";


    if (listOfInputs[4].value == "" || listOfInputs[4].value == null)
        listOfWarningLabels[4].textContent = "(Empty field!)";
    // empty field message when left empty.

    else if (!mediumRegex.test(listOfInputs[4].value))
        listOfWarningLabels[4].textContent = "PIN not strong enough.";
    // pin not strong enough message when pin is not strong enough.

    else
        listOfWarningLabels[4].textContent = "";


    if (listOfInputs[4].value != "" && listOfInputs[4].value != null && listOfInputs[5].value != "" && listOfInputs[5].value != null)
    {
        if (listOfInputs[4].value !== listOfInputs[5].value)
            listOfWarningLabels[5].textContent = "PINs don't match."
        // a message will pop up if the passwords don't match.
    }

    let formInps = document.getElementsByClassName("form")[0].getElementsByTagName("input");
    let actualFormInps = document.getElementsByTagName("form")[0].getElementsByTagName("input");
    // to put the user input from the form to the actual form.

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
// buttons to see the password as plain text.

showButton1.addEventListener("click", showPassword);
showButton2.addEventListener("click", showPassword);
// event listeners for show password.

function showPassword(e)
{
    let passwordInput = e.currentTarget.parentElement.children[0];
    let img = e.currentTarget.children[0];
    // for image responsiveness for view password

    if (passwordInput.type == "password")
    {
        passwordInput.type = "text";
        img.src = "..\\images\\seen.png";
        //    open eye image.

    }
    else
    {
        passwordInput.type = "password";
        img.src = "..\\images\\eye.png";
        //    closed eye image.
    }
}

for (const membershipBtns of document.getElementsByClassName("membershipsContainer")[0].getElementsByTagName("button"))
{
    membershipBtns.addEventListener("click", chooseMembership);
//    membership button event listener.
}

function chooseMembership(e)
// this function will make the membership chosen to be more visible.
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
