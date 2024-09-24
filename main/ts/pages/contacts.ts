import {getUserIdCookie} from "../main";
import {Networking} from "util/networkhandling";
import {
    ContactAddPacket,
    ContactDeletePacket,
    ContactSearchResponsePacket,
    ContactsSearchQueryPacket,
    PacketFunctions
} from "types/packets";

import {Contact, EmailAddress, PhoneNumberE016} from "types/objects";
import JSCookieLib from "js-cookie";

JSCookieLib.remove("cookieconsent_status")

function checkCookie() {
    if (getUserIdCookie()) {
        document.querySelectorAll('.nocookie')
                .forEach(n => {
                    if (!(n instanceof HTMLBodyElement))
                        n.remove()
                })
    }
    // else {
    //     document.querySelectorAll(":not(.nocookie)")
    //             .forEach(n => n.remove())
    // }
}

checkCookie()

const CONSTANTS = {
    searchBarFormName: 'searchbar',
    contactsTableId: 'contacts_table',
    searchBarInputName: 'search',
    editButtonClassName: 'contactbutton contact-editbutton',
    editButtonId: (contact_id: number) => `contact-editbutton-${contact_id}`,
    deleteButtonClassName: 'contactbutton contact-deletebutton',
    deleteButtonId: (contact_id: number) => `contact-deletebutton-${contact_id}`,
    contactTableHeaderId: 'contacts-table-header'
}

function doSearch() {
    const form = document.forms.namedItem(CONSTANTS.searchBarFormName)
    const data = new FormData(form)
    const table: HTMLTableElement = <HTMLTableElement>document.getElementById(CONSTANTS.contactsTableId)
    clearContactsTable()
    
    Networking.postToLAMPAPI(new ContactsSearchQueryPacket(getUserIdCookie(), <string>data.get(CONSTANTS.searchBarInputName)), "SearchContact")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then(PacketFunctions.rejectIfError)
              .then((obj: ContactSearchResponsePacket) => {
                  for (let contact of obj.contacts)
                      contactToRow(contact, table)
              })
              .catch()
}


function clearContactsTable() {
    let trs = document.querySelectorAll('#contacts_table tr');
    
    trs.forEach((tr) => {
        if (tr.id !== CONSTANTS.contactTableHeaderId)
            tr.remove();
    });
}

function makeEditButton(contact: Contact) {
    const button = document.createElement('button')
    button.innerText = 'EDIT'
    button.className = CONSTANTS.editButtonClassName
    button.id = CONSTANTS.editButtonId(contact.contact_id)
    button.onclick = () => showEditContactDialog(contact)
    return button;
}

function showDeletePopup(contact: Contact) {
    document.getElementById('delete-true').onclick = () => deleteContact(contact.contact_id)
    document.getElementById('deletecontact-popover').showPopover()
}

function makeDeleteButton(contact: Contact) {
    const button = document.createElement('button')
    button.innerText = 'DELETE'
    button.className = CONSTANTS.deleteButtonClassName
    button.id = CONSTANTS.deleteButtonId(contact.contact_id)
    button.onclick = () => showDeletePopup(contact)
    return button;
}

function addContact() {
    const form = document.forms.namedItem('addcontact-form');
    if (!form)
        throw 'No form found for addcontact-form'
    
    const data = new FormData(form);
    
    Networking.postToLAMPAPI(ContactAddPacket.fromFormData(data), 'AddContact')
              .then(res => res.ok ? res.json() : Promise.reject(res))
              .then(PacketFunctions.rejectIfError)
              .then(() => {
                  clearForm(form)
                  document.getElementById('addcontact-popover').hidePopover()
                  doSearch()
              })
              .catch((err) => document.getElementById('addcontact-errormessage').innerText = JSON.stringify(err))
}

function showEditContactDialog(contact: Contact) {
    const form = document.forms.namedItem('editcontact-form');
    (<HTMLInputElement>form.elements.namedItem('name')).value = contact.name;
    (<HTMLInputElement>form.elements.namedItem('email_address')).value = contact.email_address;
    (<HTMLInputElement>form.elements.namedItem('phone_number')).value = contact.phone_number;
    
    (<HTMLInputElement>form.elements.namedItem('name')).placeholder = contact.name;
    (<HTMLInputElement>form.elements.namedItem('email_address')).placeholder = contact.email_address;
    (<HTMLInputElement>form.elements.namedItem('phone_number')).placeholder = contact.phone_number;
    
    (<HTMLButtonElement>form.elements.namedItem('submit')).onclick = () => doEditContact(form, contact.contact_id)
    document.getElementById('editcontact-popover').showPopover()
}

function doEditContact(form: HTMLFormElement, id: number) {
    const data = new FormData(form);
    Networking.postToLAMPAPI(new Contact(
                  <string>data.get('name'),
                  <PhoneNumberE016>data.get('phone_number'),
                  <EmailAddress>data.get('email_address'),
                  id,
                  getUserIdCookie()
              ), 'Update')
              .then(response => response.ok ? response.json() : Promise.reject(response))
              .then(PacketFunctions.rejectIfError)
              .then(() => {
                  clearForm(document.forms.namedItem('editcontact-form'))
                  document.getElementById('editcontact-popover').hidePopover()
                  doSearch()
              })
              .catch(err => {
                  document.getElementById('editcontact_errormessage').innerText = JSON.stringify(err)
              })
}

function clearForm(form: HTMLFormElement) {
    for (let key in form) {
        const el = form[key]
        if (el instanceof HTMLInputElement) {
            el.value = "";
            el.placeholder = "";
            el.innerText = '';
        }
    }
}

function deleteContact(contact_id: number) {
    Networking.postToLAMPAPI(new ContactDeletePacket(contact_id, getUserIdCookie()), 'DeleteContact')
              .then(res => res.ok ? res.json() : Promise.reject(res))
              .then(PacketFunctions.rejectIfError)
              .then(() => {
                  document.getElementById('deletecontact-popover').hidePopover()
                  doSearch()
              })
              .catch()
}

function contactToRow(contact: Contact, table: HTMLTableElement) {
    const row = table.insertRow();
    for (let property of (['name', 'phone_number', 'email_address'] as (keyof Contact)[])) {
        const cell = row.insertCell();
        cell.className = `contact-${property}`;
        cell.id = `contact-${property}-${contact.contact_id}`
        cell.innerText = <string>contact[property as keyof Contact]
    }
    const buttonscell = row.insertCell();
    buttonscell.appendChild(makeEditButton(contact));
    buttonscell.appendChild(makeDeleteButton(contact))
}

document.getElementById("send_search").onclick = doSearch;
document.getElementById("logout-true").onclick = () => JSCookieLib.remove('user_id');
(document.getElementById('addcontact-submit') as HTMLFormElement).onclick = addContact