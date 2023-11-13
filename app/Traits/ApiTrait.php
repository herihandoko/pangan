<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\ClientErrorResponseException;

trait ApiTrait
{
    public function calculateEarningDay($period)
    {
        $response = Http::withHeaders([
            'Apikey' => env('MONETIZE_API_KEY'),
            'Authorization' => env('MONETIZE_API_AUTH'),
        ])->get(env('MONETIZE_API_URL') . 'earning-day', [
            'month' => date('m', strtotime($period)),
            'year' => date('Y', strtotime($period)),
        ]);
        return $response;
    }

    public function calculateEarningMonth($period)
    {
        $response = Http::withHeaders([
            'Apikey' => env('MONETIZE_API_KEY'),
            'Authorization' => env('MONETIZE_API_AUTH'),
        ])->get(env('MONETIZE_API_URL') . 'earning-month', [
            'month' => date('m', strtotime($period)),
            'year' => date('Y', strtotime($period)),
        ]);
        return $response;
    }

    public function calculateRevenueStakeholder($period)
    {
        $response = Http::withHeaders([
            'Apikey' => env('MONETIZE_API_KEY'),
            'Authorization' => env('MONETIZE_API_AUTH'),
        ])->get(env('MONETIZE_API_URL') . 'revenue', [
            'month' => date('m', strtotime($period)),
            'year' => date('Y', strtotime($period)),
        ]);
        return $response;
    }

    public function calculateRevenueHold($period)
    {
        $response = Http::withHeaders([
            'Apikey' => env('MONETIZE_API_KEY'),
            'Authorization' => env('MONETIZE_API_AUTH'),
        ])->get(env('MONETIZE_API_URL') . 'revenue-hold', [
            'month' => date('m', strtotime($period)),
            'year' => date('Y', strtotime($period)),
        ]);
        return $response;
    }

    public function sendNotif($data): Response
    {
        $response = Http::withHeaders([
            'X-CleverTap-Account-Id' => env('CLEVERTAP_ACCOUNT_ID'),
            'X-CleverTap-Passcode' => env('CLEVERTAP_PASSCODE')
        ])->bodyFormat('raw')->withBody(
            json_encode([
                'd' => [$data]
            ]),
            "application/json;charset=utf-8"
        )->send('post', env('CLEVERTAP_URL'));
        return $response;
    }

    public function aksesToken($param): Response
    {
        $response = Http::withHeaders([
            'X-CLIENT-KEY' => $param['client_key'],
            'X-TIMESTAMP' => $param['timestamp'],
            'X-SIGNATURE' => $param['signature'],
            'Origin' => 'alibinaliwisata.com'
        ])->bodyFormat('raw')->withBody(
            json_encode($param['body_request']),
            "application/json;charset=utf-8"
        )->send('post', 'https://devapi.btn.co.id/snap/v1/access-token/b2b');
        return $response;
    }

    public function createVA($param)
    {
        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => "Bearer " . $param['token'],
        //         'Content-Type' => 'application/json',
        //         'X-TIMESTAMP' => $param['timestamp'],
        //         'X-SIGNATURE' => $param['signature'],
        //         'X-PARTNER-ID' => $param['partner_id'],
        //         'X-EXTERNAL-ID' => $param['external_id'],
        //         'CHANNEL-ID' => $param['channel_id'],
        //         'Origin' => 'alibinaliwisata.com'
        //     ])->bodyFormat('raw')->withBody(
        //         json_encode($param['body_request']),
        //         "application/json;charset=utf-8"
        //     )->send('post', 'https://devapi.btn.co.id/snap/v1/transfer-va/create-va');
        //     // return $response;
        // } catch (\GuzzleHttp\Exception\RequestException $e) {
        //     $response = $e->getResponse();
        //     var_dump($response->getStatusCode()); // HTTP status code;
        //     var_dump($response->getReasonPhrase()); // Response message;
        //     var_dump((string) $response->getBody()); // Body, normally it is JSON;
        //     var_dump(json_decode((string) $response->getBody())); // Body as the decoded JSON;
        //     var_dump($response->getHeaders()); // Headers array;
        //     var_dump($response->hasHeader('Content-Type')); // Is the header presented?
        //     var_dump($response->getHeader('Content-Type')[0]); //
        // }
        // return $response;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://devapi.btn.co.id/snap/v1/transfer-va/create-va',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param['body_request']),
            CURLOPT_HTTPHEADER => array(
                'X-CLIENT-KEY: 87dae0ae-87f7-43f0-aa41-f2c482c89c3c',
                'X-TIMESTAMP: ' . $param['timestamp'],
                'X-SIGNATURE: ' . $param['signature'],
                'Origin: alibinaliwisata.com',
                'X-PARTNER-ID: 940dcd7e-85bf-430a-9712-aefd2b7da4a4',
                'X-EXTERNAL-ID: ' . $param['external_id'],
                'CHANNEL-ID: ' . $param['channel_id'],
                'Content-Type: application/json',
                'Authorization: Bearer ' . $param['token'],
                'Cookie: incap_ses_1113_2938089=jSKIAqdn7hRIvOMopixyDwDtI2UAAAAA0qn9HMBPO290HfzzjOZYfg==; visid_incap_2938089=0BD+q+k2T1mw+D0ZgAL6bO7LwmQAAAAAQUIPAAAAAAAiiuU7R66W/WY1eDgRX5D6'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }
}
