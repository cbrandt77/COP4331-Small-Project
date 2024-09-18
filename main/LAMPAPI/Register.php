<?php
include '../php/global_functions.php';
include '../php/packets.php';

setCORSHeaders();

$inData = expectPacketType(new RegistrationPacket());

$conn = getSqlConnOrThrow();


$stmt = $conn->prepare("Insert Into Users (FirstName, LastName, Login, Password) VALUE (?, ?, ?, ?);");
$stmt->bind_param("ssss", $inData->first_name, $inData->last_name, $inData->username, $inData->password);
$stmt->execute();
$stmt->close();

$stmt2 = $conn->prepare("SELECT ID, FirstName, LastName FROM Users WHERE Login=? AND Password=?");
$stmt2->bind_param("ss", $inData->username, $inData->password);
$stmt2->execute();

/** @var SqlUser $res */
$res = $stmt2->get_result()->fetch_assoc();

$stmt2->close();
$conn->close();
returnJsonHttpResponse(200, new LoginConfirmedPacket($res->ID, $res->FirstName, $res->LastName));


