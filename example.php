<?php
require "vendor/autoload.php";
use karpy47\PhpMqttClient\MQTTClient;

$client = new MQTTClient('shrimp.rmq.cloudamqp.com', 1883);
$client->setAuthentication('mnocnbfc:mnocnbfc','IwkU2OZnkfATO5en41ZnF8fItV-zO7Hr');
$client->setEncryption('cacerts.pem');
//	public function sendConnect($clientId, $cleanSession=false, $keepAlive=10, $timeout=5000) {

$success = $client->sendConnect(12345,false, 0, $timeout=500);  // set your client ID
if ($success) {
    echo "connected\n";
    echo "Subscribe to topic1\n";
    
        $client->sendPublish('topic2', 'Message to all subscribers of this topic');
        echo "Getting data:\n";
    while(1)
    {
        $client->sendSubscribe('#');
        $messages = $client->getPublishMessages();  // now read and acknowledge all messages waiting
        echo ".";
        foreach ($messages as $message) {
            echo "\n".$message['topic'] .': '. $message['message'] . PHP_EOL;
            // Other keys in $message array: retain (boolean), duplicate (boolean), qos (0-2), packetId (2-byte integer)
        }
        // sleep(0.1);
    }
    $client->sendDisconnect();    
}
$client->close();
?>