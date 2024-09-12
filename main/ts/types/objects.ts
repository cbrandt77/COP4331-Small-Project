type CountryCode = number
type PhoneNumber = number // 1234567890 for (123) 456-7890

export type PhoneNumberE016 = `+${CountryCode}${PhoneNumber}`
export type EmailAddress = `${string}@${string}.${string}` // e.g. me@example.com

export class Contact {
    name: string
    phone_number: PhoneNumberE016 | ""
    email_address: EmailAddress | ""
    contact_id: number
    user_id: number
    
    constructor(name: string, phone_number: PhoneNumberE016 | "", email_address: EmailAddress, contact_id: number, user_id: number) {
        this.name = name;
        this.phone_number = phone_number;
        this.email_address = email_address;
        this.contact_id = contact_id;
        this.user_id = user_id;
    }
}