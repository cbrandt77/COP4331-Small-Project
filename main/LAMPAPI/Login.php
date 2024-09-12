<?php
include '../php/global_functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type,*");

$inData = getRequestInfo();

# how to connect to sql server
$conn = null;
try {
    $conn = getSqlConn();
} catch (Exception $ex) {
    returnWithError(json_encode($ex), 0xB4D);
    exit();
}

if ($conn->connect_error) {
    returnWithError("unable to connect to sql database", 110);
    # do error stuff
} else {
    $statement = $conn->prepare("SELECT ID, FirstName, LastName FROM COP4331.Users WHERE Login=? AND Password=?");
    $statement->bind_param("ss", $inData['username'], $inData['password']);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        returnWithInfo($row['FirstName'], $row['LastName'], $row['ID']);
    } else {
        returnWithError("Username or password incorrect.", 0);
    }
}


function returnWithInfo($x, $y, $z)
{
    returnJsonHttpResponse(200, [
        'first_name' => $x,
        'last_name' => $y,
        'id' => $z
    ]);
}

function returnWithError($error, int $code) {
    if (!is_string($error)) {
        $error = json_encode($error);
    }
    returnJsonHttpResponse(200, ['error_code'=>$code, 'reason'=>$error]);
}
