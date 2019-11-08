<?php

require __DIR__ . "/../autoload.php";

use PayMaya\PayMayaSDK;
use PayMaya\API\Webhook;

PayMayaSDK::getInstance()->initCheckout("pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA", 
										"sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC", 
										"SANDBOX");

$successWebhook = new Webhook();
$successWebhook->name = Webhook::CHECKOUT_SUCCESS;
$successWebhook->callbackUrl = "http://shop.someserver.com/success";
$successWebhook->register();

$failureWebhook = new Webhook();
$failureWebhook->name = Webhook::CHECKOUT_FAILURE;
$failureWebhook->callbackUrl = "http://shop.someserver.com/failure";
$failureWebhook->register();

$webhooks = Webhook::retrieve();
print_r($webhooks);

$webhook = $webhooks[0];
$webhook->callbackUrl .= "Updated";
$webhook->update();
print_r(Webhook::retrieve());

$webhookCopy = clone $webhook;
echo $webhook->delete();

print_r(Webhook::retrieve());

$webhookCopy->register();

print_r(Webhook::retrieve());