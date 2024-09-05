console.log("initialized main script")

console.log(document.forms)

function submitLoginForm() {
    console.log("runnginggg")
    const loginform = document.forms[0];
    if (loginform == null) {
        console.log("null form")
        return;
    }
    
    const data = new FormData(loginform);
    
    fetch("/LAMPAPI/Login.php", {
        method: "POST",
        body: data
    }).then(
        changeOtherThing,
        null
    );
}

function changeOtherThing(response: Response) {
    function setResponseAreaText(text: string) {
        const elementById = document.getElementById("responsearea");
        elementById && (elementById.innerText = text);
    }
    
    response.body && response.text().then(setResponseAreaText, setResponseAreaText)
}

document.addEventListener("load", initLoginForm)

function initLoginForm(event: Event) {
    console.log("runninginit")
    const loginform = document.forms.namedItem("loginform");
    loginform ? loginform.addEventListener("submit", (event) => {
        event.preventDefault();
        submitLoginForm();
    }) : console.log("loginform is null")
}

