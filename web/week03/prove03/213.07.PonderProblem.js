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

function validateCardNumber(theCard, theClass) {
    var RegExTest = /^\s*[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s*$/;
    var RegExTest2 = /^\s*[0-9]{16}\s*$/;
    if (theCard.match(RegExTest) || theCard.match(RegExTest2)) {
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

function validateDate(theDate, theClass) {
    var RegExTest = /^\s*(0?[1-9]|1[0-2])\/\b(201[8-9]|202[0-9]|2030)\s*$/;
    if (theDate.match(RegExTest)) {
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

function update (tableIt, tablePr) {
    var numItems = document.getElementById(tableIt).rows.length;
    var rowsTotal =  document.getElementById(tablePr).rows.length;
    for (var i = 1; i < numItems; i++) {
        document.getElementById(tableIt).rows[i].cells[4].innerHTML = "0.00";
    }
    for (var e = 0; e < rowsTotal; e++) {
        document.getElementById(tablePr).rows[e].cells[1].innerHTML = "0.00";
    }
}

//function submitForm() {
//    alert("The form was submitted");
//}

function sumAmount(number, price, totalprice, tableIt) {
    var value1 = Number(document.getElementById(price).innerHTML);
    var total = value1 * Number(Math.round(number));
    document.getElementById(totalprice).innerHTML = total.toFixed(2);
    grandtotal(tableIt);

}

function grandtotal(tableIt) {
    var numItems = document.getElementById(tableIt).rows.length;
    var subtotal = 0;
    for (var i = 1; i < numItems; i++) {
        subtotal += Number(document.getElementById(tableIt).rows[i].cells[4].innerHTML);
    }

    var tax = Number((subtotal * 0.06).toFixed(2));
    var shipping = Number(6.99);
    var grandtotal = subtotal + tax + shipping;
    document.getElementById("subtotal-price").innerHTML = subtotal.toFixed(2);
    document.getElementById("tax").innerHTML = tax.toFixed(2);
    document.getElementById("shipping").innerHTML = shipping;
    document.getElementById("grandtotal").innerHTML = grandtotal.toFixed(2);
}

