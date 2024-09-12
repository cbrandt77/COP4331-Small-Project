console.log("initialized main script");
console.log(document.forms);
function submitLoginForm() {
    console.log("runnginggg");
    var loginform = document.forms[0];
    if (loginform == null) {
        console.log("null form");
        return;
    }
    var data = new FormData(loginform);
    fetch("/LAMPAPI/Login.php", {
        method: "POST",
        body: data
    }).then(changeOtherThing, null);
}
function changeOtherThing(response) {
    function setResponseAreaText(text) {
        var elementById = document.getElementById("responsearea");
        elementById && (elementById.innerText = text);
    }
    response.body && response.text().then(setResponseAreaText, setResponseAreaText);
}
document.addEventListener("load", initLoginForm);
function initLoginForm(event) {
    console.log("runninginit");
    var loginform = document.forms.namedItem("loginform");
    loginform ? loginform.addEventListener("submit", function (event) {
        event.preventDefault();
        submitLoginForm();
    }) : console.log("loginform is null");
}
