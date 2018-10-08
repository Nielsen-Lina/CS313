function tip(theClass) {
    switch (theClass) {
    case "number-info": 
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: 0000 0000 0000 0000 or 0000000000000000)";
        break;
    case "fname-info":
    case "lname-info":
    case "city-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(only letters, no symbols or numbers)";
        break;
    case "stAddress-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(no PO Box, example: 4578 Smith St)";
        break;
    case "state-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(two uppercase letters only)";
        break;
    case "zip-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(only numbers, example: 48658)";
        break;
    case "phone-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: (555)555-5555)";
        break;
    case "date-info":
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: 06/2021)";
        break;
    }        
}

function hide(theClass) {
    document.getElementsByClassName(theClass)[0].innerHTML = " ";
}

function validateName(value, theClass) {
    var RegExTest = /\s*^[a-zA-Z]+\s*$/;
    if (value.match(RegExTest)){
        document.getElementsByClassName(theClass)[0].style.visibility = "hidden";
    }
    else {
        document.getElementsByClassName(theClass)[0].style.visibility = "visible";
    }
}

function validateZip(value, theClass) {
    var RegExTest = /\s*^[0-9]{5}\s*$/;
    if (value.match(RegExTest)){
        document.getElementsByClassName(theClass)[0].style.visibility = "hidden";
    }
    else {
        document.getElementsByClassName(theClass)[0].style.visibility = "visible";
    }
}

function validatePhone(theNumber, theClass) {
    var RegExTest = /^\s*\([0-9]{3}\)[0-9]{3}\-[0-9]{4}\s*$/;
    if (theNumber.match(RegExTest)) {
        document.getElementsByClassName(theClass)[0].style.visibility = "hidden";
    }
    else {
        document.getElementsByClassName(theClass)[0].style.visibility = "visible";
    }
}

function validateStAddress(value, theClass) {
    var RegExTest = /^\s*[0-9]+\s[a-zA-Z]+\s[a-zA-Z]+\s*$/;
    if (value.match(RegExTest)) {
         document.getElementsByClassName(theClass)[0].style.visibility = "hidden";
    }
    else {
        document.getElementsByClassName(theClass)[0].style.visibility = "visible";
    }
}

function validateState(theState, theClass) {
    var RegExTest = /^\s*(A[LKZR]|C[AOT]|DE|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])\s*$/;
    if (theState.match(RegExTest)) {
         document.getElementsByClassName(theClass)[0].style.visibility = "hidden";
    }
    else {
        document.getElementsByClassName(theClass)[0].style.visibility = "visible";
    }
}

function focusOnForm() {
    document.form.first.focus();
    update('tableItems', 'tableTotalPrice');
}
