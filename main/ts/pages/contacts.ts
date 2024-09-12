import {getUserIdCookie} from "../main";
import {Networking} from "~util/networkhandling";
import {ContactSearchResponsePacket, ContactsSearchQueryPacket} from "~types/packets";

function checkCookie() {
    if (getUserIdCookie()) {
        document.getElementById("if_no_access").remove()
    } else {
        document.getElementById("if_has_access").remove()
    }
}

checkCookie()

function doSearch() {
    const form = document.forms.namedItem("searchbar")
    const data = new FormData(form)
    const table: HTMLTableElement = <HTMLTableElement>document.getElementById("contacts_table")
    Networking.postToLAMPAPI(new ContactsSearchQueryPacket(parseInt(getUserIdCookie()), <string>data.get("search_bar_input")), "SearchContact")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then() // TODO
}

document.getElementById("send_search").onclick = doSearch