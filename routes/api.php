<?php

use App\Http\Controllers\externalApiHandler;
use App\Http\Middleware\AuthenticateWhatsAppApi;
use Illuminate\Support\Facades\Route;

Route::get('catfact', [externalApiHandler::class, 'catFact']);
// Route::get('send-notification', [externalApiHandler::class, 'sendNotification'])
//     ->middleware([AuthenticateWhatsAppApi::class, 'throttle:10,1']);
Route::get('send-notification', [externalApiHandler::class, 'sendNotification']);

Route::post('send-notification-new', [externalApiHandler::class, 'sendNotificationNew']);
