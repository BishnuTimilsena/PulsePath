<?php
require 'vendor/autoload.php';

use Infobip\Api\SmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;



$BASE_URL = "https://rgq8n1.api.infobip.com";
$API_KEY = "f69df43b9e545f807e18f31dccd140f9-945950d7-bf16-4363-bf76-e70a9d1a40d6";

$SENDER = "InfoSMS";
$RECIPIENT = "9779808939158";
$MESSAGE_TEXT = "track location at : https/localhost/track?id=5";

$configuration = new Configuration(host: $BASE_URL, apiKey: $API_KEY);

$sendSmsApi = new SmsApi(config: $configuration);

$destination = new SmsDestination(
    to: $RECIPIENT
);

$message = new SmsTextualMessage(destinations: [$destination], from: $SENDER, text: $MESSAGE_TEXT);

$request = new SmsAdvancedTextualRequest(messages: [$message]);

try {
    $smsResponse = $sendSmsApi->sendSmsMessage($request);

    echo $smsResponse->getBulkId() . PHP_EOL;

    foreach ($smsResponse->getMessages() ?? [] as $message) {
        echo sprintf('Message ID: %s, status: %s', $message->getMessageId(), $message->getStatus()?->getName()) . PHP_EOL;
    }
} catch (Throwable $apiException) {
    echo ("HTTP Code: " . $apiException->getCode() . "\n");
}
header("location:content/map/map.php");
die();
