<?php
include 'packets.php';

function returnWithError($code, $reason) {
    returnJsonHttpResponse(200, new ErrorPacket($code, $reason));
}

/*
 * returnJsonHttpResponse, source: https://stackoverflow.com/a/62834046
 * @param $success: Boolean
 * @param $data: Object or Array
 */
function returnJsonHttpResponse($httpCode, $data): void
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

    // making sure nothing is added
    exit();
}

function getSqlConn(): mysqli {
    return new mysqli("127.0.0.1", "TheBest", "WeLoveCOP4331", "COP4331");
}

function getRequestInfo()
{
    return json_decode(file_get_contents('php://input'), true);
}

/**
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