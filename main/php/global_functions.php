<?php

enum ErrorCodes: int {
    case VALID_BUT_NONE_FOUND = 0;
    case MYSQL_CANT_CONNECT = 1;
    case MYSQL_NO_RESULT = 4;
}


function returnWithError(ErrorCodes $code, $reason) {
    returnJsonHttpResponse(200, new ErrorPacket($code, $reason));
}

/**
 * returnJsonHttpResponse, source: https://stackoverflow.com/a/62834046
 */
function returnJsonHttpResponse(int $httpCode, mixed $data): void
{
    // remove any string that could create an invalid JSON
    // such as PHP Notice, Warning, logs...
    ob_start();
    ob_clean();

    // this will clean up any previously added headers, to start clean
    header_remove();

    // Set the content type to JSON and charset
    // (charset can be set to something else)
    // add any other header you may need, gzip, auth...
    header("Content-type: application/json; charset=utf-8");

    // Set your HTTP response code, refer to HTTP documentation
    http_response_code($httpCode);


    // encode your PHP Object or Array into a JSON string.
    // stdClass or array
    echo json_encode($data);

    exit();
}

function getSqlConnOrThrow(): mysqli {
    $ret = new mysqli("127.0.0.1", "TheBest", "WeLoveCOP4331", "COP4331");
    if ($ret->connect_error) {
        returnJsonHttpResponse(500, new ErrorPacket(ErrorCodes::MYSQL_CANT_CONNECT, "Unable to connect to MySQL database: " . $ret->connect_error));
    }
    return $ret;
}

function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}

/**
 * (The below just tells the IDE that this function returns the same type it was given)
 * @template Type
 * @param mixed<Type> $holder
 * @return Type
 */
function expectPacketType(mixed $holder) {
    $request = getRequestInfo();
    foreach ($request as $key => $value) $holder->{$key} = $value;
    return $holder;
}

function setCORSHeaders() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type,*");
}

/**
 * To close the SQL statements even when the `returnJsonHttpResponse` function exits PHP early
 */
function runStatementAndSendPacket(mysqli_stmt $stmt, callable $onSuccess, callable $onFail) {

}