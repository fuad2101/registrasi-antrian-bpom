<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendWhatsAppMessageRequest;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class externalApiHandler extends Controller
{
    public function catFact()
    {
        $response = Http::get('https://catfact.ninja/fact');

        return response()->json($response->json());
    }

    public function sendNotification(SendWhatsAppMessageRequest $request): JsonResponse
    {
        $providerToken = 'uDycZEfdEXya3K54E3wx';

        // if (! is_string($providerToken) || $providerToken === '') {
        //     Log::error('FonNte credentials are not configured.');

        //     return response()->json(['message' => 'WhatsApp sending is not configured.'], 503);
        // }

        $fields = ['target' => '082151831538','message' => 'test message',];
        // $file = $request->file('file');
        // unset($fields['file']);

        $pendingRequest = Http::withHeaders([
            'Authorization' => $providerToken,
        ])->connectTimeout(5)->timeout(20);

        // if ($file !== null) {
        //     $pendingRequest->attach(
        //         'file',
        //         $file->getContent(),
        //         $file->getClientOriginalName()
        //     );
        // } else {
        //     $pendingRequest->asForm();
        // }

        try {
            $response = $pendingRequest->get($providerToken, $fields);
        } catch (ConnectionException $exception) {
            Log::error('Could not connect to FonNte.', [
                'exception' => $exception::class,
            ]);

            return response()->json(['message' => 'Could not connect to the WhatsApp provider.'], 502);
        }

        if (! $response->successful()) {
            Log::warning('FonNte rejected a WhatsApp message request.', [
                'status' => $response->status(),
            ]);

            return response()->json([
                'message' => 'The WhatsApp provider could not send the message.',
                'provider_status' => $response->status(),
            ], 502);
        }

        return response()->json($response->json(), $response->status());
    }

    public function sendNotificationNew(Request $request): JsonResponse
    {
        $apiUrl = env('FONNTE_SEND_URL', 'https://api.fonnte.com/send');
        $providerToken = env('FONNTE_TOKEN');
        $message = 'Hai SOBAT BPOM Mamuju terimakasih telah melakukan registrasi nomor antrian. Silahkan datang ke loket untuk mengambil nomor antrian.';
        $fields = ['target' => $request->input('target'),'message' => $message,];

        Http::withHeaders([
            'Authorization' => $providerToken,
        ])->connectTimeout(5)->timeout(20)->post($apiUrl, $fields);

        return response()->json(['message' => 'Request sent to WhatsApp provider.']);

    }
}
