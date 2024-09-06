import {Networking, Packets} from "./networkhandling";

namespace Forms {
    import LoginPacket = Packets.LoginPacket;
    import LoginResponsePacket = Packets.LoginResponsePacket;
    import ErrorPacket = Packets.ErrorPacket;
    
    function sendLoginForm() {
        const loginForm = document.forms.namedItem("login");
        const data = new FormData(loginForm)
        
        LoginPacket.fromFormData(data)
                   .then((packet: LoginPacket) => Networking.postToLAMPAPI(packet, 'Login'))
                   .then((response: Response) => response.ok ? response.json() : Promise.reject(response.status))
                   .then((json: LoginResponsePacket | ErrorPacket) => (Packets.instanceOfError(json)) ? Promise.reject(json['error']) : json)
                   .then(onLoginSuccess)
                   .catch(onLoginError);
    }
    
    function onLoginError(reason: string) {
        setResponseArea(`An unexpected error occurred: ${reason}`)
    }
    
    function onLoginSuccess(packet: LoginResponsePacket) {
        const userId = packet.id;
        
    }
    
    function setResponseArea(text: string) {
        document.getElementById('responsearea').innerText = text
    }
}