<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new ContactAddPacket());

$conn = getSqlConnOrThrow();

$stmt = $conn->prepare("INSERT into Contacts (Name, Phone, Email, UserId) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $inData->name, $inData->phone_number, $inData->email_address, $inData->user_id);
$stmt->execute();
$stmt->close();

$conn->close();

http_response_code(200);
