import {LoginConfirmedPacket} from "types/packets";
import JSCookieLib from "js-cookie";

export function onLoginSuccess(packet: LoginConfirmedPacket) {
    const userId = packet.id;
    JSCookieLib.set('user_id', userId.toString())
    document.location.href = "contacts.html"
}