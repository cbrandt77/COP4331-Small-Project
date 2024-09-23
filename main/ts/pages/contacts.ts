import {getUserIdCookie} from "../main";
import {Networking} from "util/networkhandling";
import {ContactSearchResponsePacket, ContactsSearchQueryPacket} from "types/packets";
import {Contact} from "types/objects";

function checkCookie() {
    if (getUserIdCookie()) {
        document.getElementById("if_no_access").remove()
    } else {
        document.getElementById("if_has_access").remove()
    }
}

checkCookie()

const CONSTANTS = {
    searchBarFormName: 'searchbar',
    contactsTableId: 'contacts_table',
    searchBarName: 'search_bar_input',
    editButtonClassName: 'contact-editbutton',
    editButtonId: (contact_id: number) => `contact-editbutton-${contact_id}`,
    deleteButtonClassName: 'contact-deletebutton',
    deleteButtonId: (contact_id: number) => `contact-deletebutton-${contact_id}`
}

function doSearch() {
    const form = document.forms.namedItem(CONSTANTS.searchBarFormName)
    const data = new FormData(form)
    const table: HTMLTableElement = <HTMLTableElement>document.getElementById(CONSTANTS.contactsTableId)
    Networking.postToLAMPAPI(new ContactsSearchQueryPacket(parseInt(getUserIdCookie()), <string>data.get(CONSTANTS.searchBarName)), "SearchContact")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then((obj: ContactSearchResponsePacket) => {
                  for (let contact of obj.contacts)
                      contactToRow(contact, table)
              })
}

function makeEditButton(contact_id: number) {
    const button = new HTMLButtonElement();
    button.innerText = 'EDIT'
    button.className = CONSTANTS.editButtonClassName
    button.id = CONSTANTS.editButtonId(contact_id)
    button.onclick = () => editPop(contact_id)
    return button;
}

function makeDeleteButton(contact_id: number) {
    const button = new HTMLButtonElement();
    button.innerText = 'DELETE'
    button.className = CONSTANTS.deleteButtonClassName
    button.id = CONSTANTS.deleteButtonId(contact_id)
    button.onclick = () => deletePop(contact_id)
    return button;
}

function editPop(contact_id: number) {
    document.getElementById('edit_popout').style.display = 'block';
    document.getElementById('submit_edit').onclick = () => editContact(contact_id)
    document.getElementById('no_edit').onclick = () => document.getElementById('edit_popout').style.display = 'none';
    // TODO
}

function editContact(contact_id: number) {
    // TODO
}

function deletePop(contact_id: number) {
    document.getElementById('delete_popout').style.display = 'block';
    document.getElementById('submit_delete').onclick = () => deleteContact(contact_id)
    document.getElementById('no_delete').onclick = () => document.getElementById('delete_popout').style.display = 'none';
}

function deleteContact(contact_id: number) {
    // TODO
}

function contactToRow(contact: Contact, table: HTMLTableElement) {
    const row = table.insertRow();
    for (let property in contact) {
        const cell = row.insertCell();
        cell.className = `contact-${property}`;
        cell.id = `contact-${property}-${contact.contact_id}`
        cell.innerText = <string>contact[property as keyof Contact]
    }
    row.insertCell().appendChild(makeEditButton(contact.contact_id))
    row.insertCell().appendChild(makeDeleteButton(contact.contact_id))
}

document.getElementById("send_search").onclick = doSearch