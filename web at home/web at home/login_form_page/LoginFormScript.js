const registerBtn = document.getElementsByClassName("registerBtn")[0];
registerBtn.addEventListener("click", validate);

function validate()
{
    let regx = new RegExp("^([a-zA-Z0-9\\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$");
    
    let listOfWarningLabels = document.getElementsByClassName("warningLabels");
    let li = document.getElementsByClassName("inputsContainer")[0];
    let listOfInputs = li.getElementsByTagName("input");
    
    if (listOfInputs[0].value == "" || listOfInputs[0].value == null)
        listOfWarningLabels[0].textContent = "(Empty field!)";
    else if (!regx.test(listOfInputs[0].value))
        listOfWarningLabels[0].textContent = "(Invalid email!)";
    else
    {
        listOfWarningLabels[0].textContent = "";

        let formInputs = document.getElementsByTagName("form")[0].getElementsByTagName("input");
        formInputs[0].value = listOfInputs[0].value;
        formInputs[1].value = listOfInputs[1].value;
        formInputs[2].click();

    }

    
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

const forgottenPinLink = document.getElementById("forgottenPinLink");

forgottenPinLink.addEventListener("click", setupPinRetrievalForm);

function setupPinRetrievalForm()
{
    document.getElementsByTagName("ul")[1].classList.add("translate");
}

const formBody = document.getElementsByTagName("ul")[1];
formBody.addEventListener("transitionend", setupVerificationForm);

var run = false;

function setupVerificationForm(event)
{
    let form = document.getElementsByClassName("form")[0];
    
    if (event.target != formBody)
        return;

    let formChildren;

    formChildren = form.children[0];
    form.removeChild(form.children[0]);

    let ulContainer = document.createElement("ul");
    ulContainer.classList.add("verificationForm");
    ulContainer.addEventListener("transitionend", returnBackToLoginForm);

    let li1 = document.createElement("li");
    li1.className = "verificationLabel";
    let instructionsLabel = document.createElement("label");
    instructionsLabel.innerText = "We'll send a verification code to the email you enter below to verify it's you.";
    li1.appendChild(instructionsLabel);

    let li2 = document.createElement("li");
    let emailLabel = document.createElement("label");
    let warningLabel = document.createElement("label");
    warningLabel.className = "warningLabels";
    emailLabel.textContent = "Email:";
    let emailInput = document.createElement("input");
    emailLabel.appendChild(warningLabel);
    li2.appendChild(emailLabel);
    li2.appendChild(emailInput);

    let li3 = document.createElement("li");
    let backButton = document.createElement("button");
    backButton.textContent = "BACK";
    backButton.addEventListener("click", goBack);
    let nextButton = document.createElement("button");
    nextButton.textContent = "NEXT";
    nextButton.addEventListener("click", sendVerificationCode);
    li3.className = "navigationButtonsContainer";
    li3.appendChild(backButton);
    li3.appendChild(nextButton);

    ulContainer.appendChild(li1);
    ulContainer.appendChild(li2);
    ulContainer.appendChild(li3);

    form.appendChild(ulContainer);

    function goBack()
    {
        document.getElementsByClassName("form")[0].classList.remove("expand");
        ulContainer.classList.toggle("translate");
    }

    function returnBackToLoginForm(anotherEvent)
    {
        if (anotherEvent.target != ulContainer)
            return;

        formChildren.classList.toggle("translate");
        ulContainer.remove();
        form.appendChild(formChildren);

    }

    function sendVerificationCode()
    {
        let regxEm = new RegExp("^([a-zA-Z0-9\\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z]+)?$");

        if (emailLabel.value == "" || emailInput.value == null)
            warningLabel.textContent = " (Empty field!)";
        else if (!regxEm.test(emailInput.value))
            warningLabel.textContent = " (Invalid email!)";
        else
        {
            warningLabel.textContent = "";

            // Some backend code to send verification code with php.

            instructionsLabel.innerText = "We've sent a verification code to Humma@gmail.com, type it in the boxes below.";
            emailLabel.innerHTML = "Verification code:  <label class=\"warningLabels\"></label>";

            let sixBoxesGrid = document.createElement("div");
            sixBoxesGrid.className = "verInpDiv";

            var numbersReg = new RegExp('^[0-9]$');

            for (let i = 0; i < 6; i++)
            {
                let verificationDigitInput = document.createElement("input");
                verificationDigitInput.setAttribute("maxlength", "1");
                verificationDigitInput.addEventListener("keypress", (e1) => 
                {
                    if (!numbersReg.test(e1.key))
                        e1.preventDefault();
                })

                verificationDigitInput.addEventListener("input", focusNext)
                sixBoxesGrid.appendChild(verificationDigitInput);
            }
            
            function focusNext(e2)
            {
                let inputsList = Array.from(sixBoxesGrid.getElementsByTagName("input"));
                
                if (e2.currentTarget.value != null && e2.currentTarget.value != "")
                {
                    for (let i = 0; i < inputsList.length; i++)
                    {
                        if (inputsList[i] === e2.currentTarget && i + 1 != inputsList.length)
                        {   
                            inputsList[i + 1].focus();
                        }    
                    }
                }
            }

            li2.removeChild(emailInput);
            li2.appendChild(sixBoxesGrid);

            nextButton.removeEventListener("click", sendVerificationCode);
            nextButton.addEventListener("click", resetPasswordForm);

            function resetPasswordForm()
            {
                let inputsList1 = Array.from(sixBoxesGrid.getElementsByTagName("input"));

                for (let input of inputsList1)
                {
                    if (input.value === null || input.value === "")
                    {
                        document.getElementsByClassName("warningLabels")[0].textContent = " [Type in all the digits]";
                        return;
                    }   
                }

                // Backend code to validate code.

                instructionsLabel.textContent = "Choose a new password and confirm it. Click NEXT when done.";

                document.getElementsByClassName("form")[0].classList.add("expand");

                let secondLI = document.getElementsByClassName("verificationForm")[0].getElementsByTagName("li")[1];
                secondLI.innerHTML = "";

                for (let i = 0; i < 2; i++)
                {
                    let newPassLabel = document.createElement("label");

                    switch(i)
                    {
                        case 0:
                            newPassLabel.textContent = "New password: ";
                            break;

                        case 1:
                            newPassLabel.textContent = "Confirm new password: ";
                            break;
                    }

                    let newPassWarningLabel = document.createElement("label");
                    newPassWarningLabel.className = "warningLabels";
                    newPassLabel.appendChild(newPassWarningLabel);

                    let newPassDiv = document.createElement("div");
                    newPassDiv.className = "passwordInputContainer";

                    let newPassInput = document.createElement("input");
                    newPassInput.type = "password";

                    let newPassBtn = document.createElement("button");

                    let newPassImg = document.createElement("img");
                    newPassImg.src = "Images\\eye (1).png";
                    newPassBtn.appendChild(newPassImg);

                    newPassBtn.addEventListener("click", () => {
                                
                        if (newPassInput.type == "password")
                        {
                            newPassInput.type = "text";
                            newPassImg.src = "Images\\seen.png";
                        }
                        else
                        {
                            newPassInput.type = "password";
                            newPassImg.src = "Images\\eye (1).png";
                        }
                    })

                    newPassDiv.appendChild(newPassInput);
                    newPassDiv.appendChild(newPassBtn);
    
                    secondLI.appendChild(newPassLabel);
                    secondLI.appendChild(newPassDiv);
                }

                nextButton.removeEventListener("click", resetPasswordForm);
                nextButton.addEventListener("click", () => 
                {
                    let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
                    let passwordInputs = secondLI.getElementsByTagName("input");
                    let passWarningLabels = secondLI.getElementsByClassName("warningLabels");

                    if (passwordInputs[0].value == "" || passwordInputs[0].value == null)
                        passWarningLabels[0].textContent = "(Empty field!)";
                    else if (!mediumRegex.test(passwordInputs[0].value))
                        passWarningLabels[0].textContent = "Password not strong enough!";
                    else
                        passWarningLabels[0].textContent = "";

                    if (passwordInputs[1].value == "" || passwordInputs[1].value == null)
                        passWarningLabels[1].textContent = "(Empty field!)";
                    else if (passwordInputs[0].value !== passwordInputs[1].value)
                        passWarningLabels[1].textContent = "Passwords do not match!";
                    else
                        passWarningLabels[1].textContent = "";

                });
                
            }
        }
            
    }

}