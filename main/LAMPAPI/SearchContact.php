<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new ContactsSearchQueryPacket());

$conn = getSqlConnOrThrow();

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
    returnJsonHttpResponse(200, new ErrorPacket(ErrorCodes::MYSQL_NO_RESULT, "No contacts found."));
} else {
    returnJsonHttpResponse(200, new ContactSearchResponsePacket($arr));
}

