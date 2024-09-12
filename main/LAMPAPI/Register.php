<?php
include '../php/global_functions.php';
header("Access-Control-Allow-Origin: *");

$inData = getRequestInfo();

$conn = getSqlConn();

if ($conn->connect_error) {
    returnJsonHttpResponse(200, ['error_code'=>2, 'reason'=>$conn->connect_error]);
} else {
    $stmt = $conn->prepare("Insert Into Users (FirstName, LastName, Login, Password) VALUE (?, ?, ?, ?);");
    $stmt->bind_param("ssss", $inData["first_name"], $inData["last_name"], $inData["username"], $inData["password"]);
    $stmt->execute();
    $stmt->close();

    $stmt2 = $conn->prepare("SELECT ID, FirstName, LastName FROM Users WHERE Login=? AND Password=?");
    $stmt2->bind_param("ss", $inData["username"], $inData["password"]);
    $stmt2->execute();
    $res = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    $conn->close();

    returnJsonHttpResponse(200, [
        "id"=>$res,
        "first_name"=>$res["FirstName"],
        "last_name"=>$res["LastName"]
    ]);
}

