function validateMyForm() {
    // The field is empty, submit the form.
    if(!document.getElementById("honeypot").value) { 
        return true;
    } 
     // the field has a value it's a spam bot
    else {
        return false;
    }
}