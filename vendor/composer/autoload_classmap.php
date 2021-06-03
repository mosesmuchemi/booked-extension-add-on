<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'BulkGate\\Exception' => $vendorDir . '/bulkgate/utils/src/Utils/exceptions.php',
    'BulkGate\\Message\\Bridges\\MessageDI\\MessageExtension' => $vendorDir . '/bulkgate/message/src/Bridges/MessageDI/MessageExtension.php',
    'BulkGate\\Message\\Bridges\\MessageTracy\\MessagePanel' => $vendorDir . '/bulkgate/message/src/Bridges/MessageTracy/MessagePanel.php',
    'BulkGate\\Message\\Connection' => $vendorDir . '/bulkgate/message/src/Message/Connection.php',
    'BulkGate\\Message\\ConnectionException' => $vendorDir . '/bulkgate/message/src/Message/exceptions.php',
    'BulkGate\\Message\\HttpHeaders' => $vendorDir . '/bulkgate/message/src/Message/HttpHeaders.php',
    'BulkGate\\Message\\IConnection' => $vendorDir . '/bulkgate/message/src/Message/IConnection.php',
    'BulkGate\\Message\\IMessage' => $vendorDir . '/bulkgate/message/src/Message/IMessage.php',
    'BulkGate\\Message\\InvalidContentTypeException' => $vendorDir . '/bulkgate/message/src/Message/exceptions.php',
    'BulkGate\\Message\\InvalidRequestException' => $vendorDir . '/bulkgate/message/src/Message/exceptions.php',
    'BulkGate\\Message\\InvalidStateException' => $vendorDir . '/bulkgate/message/src/Message/exceptions.php',
    'BulkGate\\Message\\MalformedJsonException' => $vendorDir . '/bulkgate/message/src/Message/exceptions.php',
    'BulkGate\\Message\\Request' => $vendorDir . '/bulkgate/message/src/Message/Request.php',
    'BulkGate\\Message\\Response' => $vendorDir . '/bulkgate/message/src/Message/Response.php',
    'BulkGate\\Message\\Scheduler' => $vendorDir . '/bulkgate/message/src/Message/Scheduler.php',
    'BulkGate\\Sms\\BulkMessage' => $vendorDir . '/bulkgate/sms/src/Sms/BulkMessage.php',
    'BulkGate\\Sms\\Country' => $vendorDir . '/bulkgate/sms/src/Sms/Country.php',
    'BulkGate\\Sms\\ISender' => $vendorDir . '/bulkgate/sms/src/Sms/ISender.php',
    'BulkGate\\Sms\\InvalidIsoCodeException' => $vendorDir . '/bulkgate/sms/src/Sms/exceptions.php',
    'BulkGate\\Sms\\InvalidMessageException' => $vendorDir . '/bulkgate/sms/src/Sms/exceptions.php',
    'BulkGate\\Sms\\InvalidPhoneNumbersException' => $vendorDir . '/bulkgate/sms/src/Sms/exceptions.php',
    'BulkGate\\Sms\\Message' => $vendorDir . '/bulkgate/sms/src/Sms/Message.php',
    'BulkGate\\Sms\\Message\\InvalidPhoneNumberException' => $vendorDir . '/bulkgate/sms/src/Sms/Message/exceptions.php',
    'BulkGate\\Sms\\Message\\PhoneNumber' => $vendorDir . '/bulkgate/sms/src/Sms/Message/PhoneNumber.php',
    'BulkGate\\Sms\\Message\\Text' => $vendorDir . '/bulkgate/sms/src/Sms/Message/Text.php',
    'BulkGate\\Sms\\Sender' => $vendorDir . '/bulkgate/sms/src/Sms/Sender.php',
    'BulkGate\\Sms\\SenderSettings\\CountrySenderID' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/CountrySenderID.php',
    'BulkGate\\Sms\\SenderSettings\\CountrySenderSettings' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/CountrySenderSettings.php',
    'BulkGate\\Sms\\SenderSettings\\Gate' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/Gate.php',
    'BulkGate\\Sms\\SenderSettings\\ISenderSettings' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/ISenderSettings.php',
    'BulkGate\\Sms\\SenderSettings\\InvalidGateException' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/exceptions.php',
    'BulkGate\\Sms\\SenderSettings\\InvalidSenderException' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/exceptions.php',
    'BulkGate\\Sms\\SenderSettings\\StaticSenderSettings' => $vendorDir . '/bulkgate/sms/src/Sms/SenderSettings/StaticSenderSettings.php',
    'BulkGate\\Sms\\SmsException' => $vendorDir . '/bulkgate/sms/src/Sms/exceptions.php',
    'BulkGate\\Strict' => $vendorDir . '/bulkgate/utils/src/Utils/Strict.php',
    'BulkGate\\StrictException' => $vendorDir . '/bulkgate/utils/src/Utils/exceptions.php',
    'BulkGate\\Utils\\Compress' => $vendorDir . '/bulkgate/utils/src/Utils/Compress.php',
    'BulkGate\\Utils\\ExtensionException' => $vendorDir . '/bulkgate/utils/src/Utils/exceptions.php',
    'BulkGate\\Utils\\Iterator' => $vendorDir . '/bulkgate/utils/src/Utils/Iterator.php',
    'BulkGate\\Utils\\Json' => $vendorDir . '/bulkgate/utils/src/Utils/Json.php',
    'BulkGate\\Utils\\JsonException' => $vendorDir . '/bulkgate/utils/src/Utils/exceptions.php',
    'BulkGate\\Utils\\Locale' => $vendorDir . '/bulkgate/utils/src/Utils/Locale.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
);