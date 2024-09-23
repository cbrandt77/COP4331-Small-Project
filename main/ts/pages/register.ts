import {Networking} from "util/networkhandling";
import {PacketFunctions, RegistrationPacket} from "types/packets";
import {onLoginSuccess} from "util/cookies";

function doRegister() {
    const formdata = new FormData(document.forms.item(0))
    const packet = RegistrationPacket.fromFormData(formdata)
    console.log(packet.toString())
    Networking.postToLAMPAPI(packet, "Register")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then(PacketFunctions.rejectIfError)
              .then(onLoginSuccess)
              .catch(onLoginFailure)
}

function onLoginFailure(error: any) {
    document.getElementById("errormessage").innerText = JSON.stringify(error)
}


document.getElementById("submit_register").onclick = doRegister