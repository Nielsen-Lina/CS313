function tip(theClass) {
    switch (theClass) {
    case "category-name": 
    case "category-name2":
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: income or Income)";
        break;
    case "amount":
    case "transaction":
        document.getElementsByClassName(theClass)[0].innerHTML = "(only numbers, example: 100 or 100.50)";
        break;
    case "company-name":
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: costco or Costco)";
        break;
    case "date":
        document.getElementsByClassName(theClass)[0].innerHTML = "(example: 2018-10-25 or 25 Oct 2018)";
        break;
    }        
}

function hide(theClass) {
    document.getElementsByClassName(theClass)[0].innerHTML = " ";
}

function focusOnForm() {
    document.form.first.focus();
}