import {Networking} from "util/networkhandling";
import {LoginPacket, LoginConfirmedPacket, ErrorPacket, PacketFunctions} from 'types/packets'
import JSCookieLib from 'js-cookie'

namespace Forms {
    export function sendLoginForm(form: HTMLFormElement) {
        const data = new FormData(form)
        
        LoginPacket.fromFormData(data)
                   .then((packet: LoginPacket) => Networking.postToLAMPAPI(packet, 'Login'))
                   .then((response: Response) => response.ok ? response.json() : Promise.reject(response.status))
                   .then((json: LoginConfirmedPacket | ErrorPacket) => (PacketFunctions.instanceOfError(json)) ? Promise.reject(json['reason']) : json)
                   .then(onLoginSuccess)
                   .catch(onLoginError);
    }
    
    function onLoginError(reason: string) {
        setResponseArea(`An unexpected error occurred: ${reason}`)
    }
    
    function onLoginSuccess(packet: LoginConfirmedPacket) {
        const userId = packet.id;
        JSCookieLib.set('user_id', userId.toString())
        document.location.href = "contacts.html"
    }
    
    function setResponseArea(text: string) {
        const area = document.getElementById('loginResult')
        if (area)
            area.innerText = text;
    }
}

const submitButton = document.forms
                        .namedItem("login")
                        ?.elements
                        .namedItem("button");
if (submitButton instanceof HTMLButtonElement)
    submitButton?.addEventListener("click", () => Forms.sendLoginForm(this))