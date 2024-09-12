import Cokie_uwu from 'js-cookie';
export var Constants;
(function (Constants) {
    Constants.COOKIE_USERID = "user_id";
})(Constants || (Constants = {}));
export function getUserIdCookie() {
    return Cokie_uwu.get(Constants.COOKIE_USERID);
}
