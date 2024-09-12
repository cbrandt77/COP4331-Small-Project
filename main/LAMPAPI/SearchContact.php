<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new ContactsSearchQueryPacket());

$conn = getSqlConn();
if ($conn->connect_error)
{
    returnJsonHttpResponse(500, new ErrorPacket(1, $conn->connect_error));
}
else {
    $stmt = $conn->prepare("select * from Contacts where Name like ? and UserID=?");
    $contactName = "%" . $inData->search_term . "%";
    $stmt->bind_param("ss", $contactName, $inData->user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    /** @var OutgoingContactObject[] $arr */
    $arr = [];


    while (($row = $result->fetch_object('\SqlContact'))) {
        $arr[] = OutgoingContactObject::fromSqlContact($row);
    }

    $stmt->close();
    $conn->close();

    if (count($arr) == 0) {
        returnJsonHttpResponse(200, new ErrorPacket(0, "No contacts found."));
    } else {
        returnJsonHttpResponse(200, new ContactSearchResponsePacket($arr));
    }

}
