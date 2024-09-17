import {Networking} from "util/networkhandling";
import {ErrorPacket, LoginConfirmedPacket, PacketFunctions, RegistrationPacket} from "types/packets";
import instanceOfError = PacketFunctions.instanceOfError;
import {onLoginSuccess} from "util/cookies";

function doRegister() {
    const formdata = new FormData(document.forms.item(0))
    const packet = RegistrationPacket.fromFormData(formdata)
    console.log(packet.toString())
    Networking.postToLAMPAPI(packet, "Register")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then(PacketFunctions.filterErrors)
              .then(onLoginSuccess)
              .catch(onLoginFailure)
}

function onLoginFailure(error: any) {
    document.getElementById("errormessage").innerText = error
}


document.getElementById("submit_register").onclick = doRegister