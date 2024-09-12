import {Contact} from "./objects";

export class LoginPacket {
    username: string;
    password: string;
    
    constructor(username: string, password: string) {
        this.username = username;
        this.password = password;
    }
    
    static async fromPlaintext(username: string, plaintextPassword: string): Promise<LoginPacket> {
        const hashed = await PacketFunctions.encryptString(plaintextPassword);
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

export interface LoginConfirmedPacket {
    id: number,
    first_name: string,
    last_name: string
}

export interface ErrorPacket {
    error_code: number,
    reason: string
}

export class RegistrationPacket {
    username: string
    password: string
    first_name: string
    last_name: string
    
    constructor(username: string, password: string, first_name: string, last_name: string) {
        this.username = username;
        this.password = password;
        this.first_name = first_name;
        this.last_name = last_name;
    }
}

export class ContactsSearchQueryPacket {
    user_id: number
    search_term: string
    
    constructor(user_id: number, search_term: string) {
        this.user_id = user_id;
        this.search_term = search_term;
    }
}

export interface ContactSearchResponsePacket {
    contacts: Contact[]
}

export interface ContactPacket {
    name: string,
    phone_number: string | "",
    email_address: string | ""
    user_id: number
}

export class ContactEditPacket {
    contact_id: number
    user_id: number
}

export namespace PacketFunctions {
    export function instanceOfError(object: any): object is ErrorPacket {
        return 'error' in object;
    }
    
    export async function encryptString(unhashed: string): Promise<string> {
        return new Promise((resolve, reject) =>
            // hash(unhashed, 'salty', function (err: Error | undefined, hash: string) {
            //     if (err)
            //         reject(err);
            //     else
            //         resolve(hash);
            // })
            resolve(unhashed) // TODO find hashing library that doesn't brick the environment
        )
    }
}

