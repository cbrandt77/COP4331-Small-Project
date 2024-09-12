import {Networking} from "util/networkhandling";
import {LoginPacket, LoginConfirmedPacket, ErrorPacket, PacketFunctions} from 'types/packets'
import JSCookieLib from 'js-cookie'

namespace Forms {
    import instanceOfError = PacketFunctions.instanceOfError;
    
    export function sendLoginForm(): void {
        setResponseArea("")
        
        const form = document.forms.namedItem("login")
        const data = new FormData(form)
        
        LoginPacket.fromFormData(data)
                   .then((packet: LoginPacket) => Networking.postToLAMPAPI(packet, 'Login'))
                   .then((response: Response) => response.ok ? response.json() : Promise.reject(response.status))
                   .then((json: LoginConfirmedPacket | ErrorPacket) => (PacketFunctions.instanceOfError(json)) ? Promise.reject(json) : json)
                   .then(onLoginSuccess)
                   .catch(onLoginError);
    }
    
    function onLoginError(error: ErrorPacket | any) {
        if (instanceOfError(error) && error.error_code == 0) {
            setResponseArea(error.reason)
        } else {
            setResponseArea(`An unexpected error occurred: ${JSON.stringify(error)}`)
        }
        
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

document.getElementById("loginButton").onclick = Forms.sendLoginForm