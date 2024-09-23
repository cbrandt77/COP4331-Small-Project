import Cokie_uwu from 'js-cookie'


export namespace Constants {
    export const COOKIE_USERID = "user_id"
}

export function getUserIdCookie(): number {
    return parseInt(Cokie_uwu.get(Constants.COOKIE_USERID))
}
