import {Networking} from "~util/networkhandling";
import {ErrorPacket, LoginConfirmedPacket, PacketFunctions, RegistrationPacket} from "~types/packets";
import {Forms} from "~pages/login";
import instanceOfError = PacketFunctions.instanceOfError;

function doRegister() {
    const formdata = new FormData(document.forms.item(0))
    Networking.postToLAMPAPI(RegistrationPacket.fromFormData(formdata), "Register")
              .then(response => response.ok ? response.json() : Promise.reject(response.status))
              .then((obj: LoginConfirmedPacket | ErrorPacket) => instanceOfError(obj) ? Promise.reject(obj.reason) : obj)
              .then(Forms.onLoginSuccess)
              .catch(onLoginFailure)
}

function onLoginFailure(error: any) {
    document.getElementById("errormessage").innerText = error
}


document.getElementById("submit_register").onclick = doRegister