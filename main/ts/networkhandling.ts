
import "bcrypt"
import {hash} from "bcrypt";

const BASE_URL = "https://cop4331team21.site"

namespace Packets {
    class LoginPacket {
        username: string;
        password: string;
        
        constructor(username: string, password: string) {
            this.username = username;
            this.password = password;
        }
        
        static async fromPlaintext(username: string, plaintextPassword: string): Promise<LoginPacket> {
            const hashed = await encryptPassword(plaintextPassword);
            return new LoginPacket(username, hashed);
        }
    }
    
    async function encryptPassword(unhashed: string): Promise<string> {
        return new Promise((resolve, reject) =>
            hash(unhashed, 10, function (err, hash) {
                if (err)
                    reject(err);
                else
                    resolve(hash);
            })
        )
    }
}

namespace Networking {
    function postToServer(payload: any, subdir: string) {
        if (!subdir.startsWith('/'))
            subdir = '/' + subdir;
        
        return fetch(BASE_URL + subdir, {
            method: "POST"
        })
    }
    
    function postToLAMPAPI(payload: any, endpoint: string) {
        return postToServer(payload, `/LAMPAPI/${endpoint}.php`)
    }
}