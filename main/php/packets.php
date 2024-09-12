<?php

class LoginPacket
{
    public string $username;
    public string $password;
}

class LoginConfirmedPacket
{
    public int $id;
    public string $first_name;
    public string $last_name;

    public function __construct(int $id, string $first_name, string $last_name)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
}

class ErrorPacket
{
    public int $error_code;
    public string $reason;

    public function __construct(int $error_code, string $reason)
    {
        $this->error_code = $error_code;
        $this->reason = $reason;
    }
}

class RegistrationPacket
{
    public string $username;
    public string $password;
    public string $first_name;
    public string $last_name;
}

class ContactsSearchQueryPacket
{
    public int $user_id;
    public string $search_term;
}

class ContactSearchResponsePacket
{
    public array $contacts;

    public function __construct(array $contacts)
    {
        $this->contacts = $contacts;
    }
}

class ContactAddPacket
{
    public string $name;
    public string $phone_number;
    public string $email_address;
    public int $user_id;
}

class ContactEditPacket extends ContactAddPacket
{
    public int $contact_id;
}

class ContactDeletePacket
{
    public int $contact_id;
    public int $user_id;
}

class SqlUser {
    public int $ID;
    public string $FirstName;
    public string $LastName;
    public string $Login;
    public string $Password;
}

class SqlContact {
    public int $ID;
    public string $Name;
    public string $Phone;
    public string $Email;
    public string $UserID;
}

class OutgoingContactObject
{
    public string $name;
    public string $phone_number;
    public string $email_address;
    public int $contact_id;
    public int $user_id;

    public function __construct(string $name, string $phone_number, string $email_address, int $contact_id, int $user_id)
    {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->email_address = $email_address;
        $this->contact_id = $contact_id;
        $this->user_id = $user_id;
    }

    public static function fromSqlContact(SqlContact $contact): OutgoingContactObject {
        return new OutgoingContactObject($contact->Name, $contact->Phone, $contact->Email, $contact->ID, $contact->UserID);
    }
}
