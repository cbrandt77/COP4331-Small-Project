import {getUserIdCookie} from "../main";

function checkCookie() {
    if (getUserIdCookie()) {
        document.getElementById("if_has_access").remove()
    } else {
        document.getElementById("if_no_access").remove()
    }
}

checkCookie()