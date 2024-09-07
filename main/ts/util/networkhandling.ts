import {hash} from "bcrypt";

export namespace Packets {
    export class LoginPacket {
        username: string;
        password: string;
        
        constructor(username: string, password: string) {
            this.username = username;
            this.password = password;
        }
        
        static async fromPlaintext(username: string, plaintextPassword: string): Promise<LoginPacket> {
            const hashed = await encryptString(plaintextPassword);
            return new LoginPacket(username, hashed);
        }
        
        static async fromFormData(formData: FormData) {
            const username = formData.get('username');
            const password = formData.get('password');
            if (typeof username !== 'string' || typeof password !== 'string')
                return Promise.reject('Username and password must be of type String.');
            
            return this.fromPlaintext(username, password);
        }
    }
    
    export interface LoginResponsePacket {
        id: number,
        firstName: string,
        lastName: string
    }
    export interface ErrorPacket {
        error: string
    }
    export function instanceOfError(object: any): object is ErrorPacket {
        return 'error' in object;
    }
    
    export async function encryptString(unhashed: string): Promise<string> {
        return new Promise((resolve, reject) =>
            hash(unhashed, 'salty', function (err: Error | undefined, hash: string) {
                if (err)
                    reject(err);
                else
                    resolve(hash);
            })
        )
    }
}

export namespace Networking {
    const BASE_URL = "https://cop4331team21.site"
    
    export function postJsonToServer(payload: object | BodyInit, subdir: string,
                                     additionalHeaders?: { [key: string]: any }): Promise<Response> {
        if (!subdir.startsWith('/'))
            subdir = '/' + subdir;
        
        const headersObj = additionalHeaders || {};
        
        if (!headersObj['Content-Type']) {
            headersObj['Content-Type'] = 'application/json'
        }
        
        if (typeof payload === 'object')
            payload = JSON.stringify(payload)
        
        return fetch(BASE_URL + subdir, {
            method: "POST",
            body: payload,
            headers: headersObj
        })
    }
    
    export function postToLAMPAPI(payload: any, endpointName: string) {
        return postJsonToServer(payload, `/LAMPAPI/${endpointName}.php`)
    }
}

