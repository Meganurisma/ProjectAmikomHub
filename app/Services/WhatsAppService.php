<?php

namespace App\Services;

class WhatsAppService
{
    protected $provider;

    public function __construct()
    {
        $this->provider = env('WHATSAPP_PROVIDER', 'twilio');
    }

    /**
     * Send a WhatsApp message. This method accepts a raw recipient phone (no 'whatsapp:' prefix)
     * and a plain text message. The implementation adapts to the configured provider.
     *
     * Returns detail array: [status => bool, provider => string, payload => array, response => array|null, error => string|null]
     */
    public function send(string $to, string $message): array
    {
        try {
            if ($this->provider === 'twilio') {
                return $this->sendViaTwilio($to, $message);
            }

            // Generic HTTP POST to an external provider endpoint (expects JSON {to, message})
            $apiUrl = env('WHATSAPP_API_URL');
            $apiKey = env('WHATSAPP_API_KEY');
            if (! $apiUrl) {
                $error = 'WhatsApp generic provider: WHATSAPP_API_URL not configured';
                logger()->warning($error);
                return [
                    'status' => false,
                    'provider' => 'generic',
                    'payload' => ['to' => $to, 'message' => $message],
                    'response' => null,
                    'error' => $error,
                ];
            }

            $client = new \GuzzleHttp\Client();
            $headers = ['Accept' => 'application/json'];
            if ($apiKey) {
                $headers['Authorization'] = 'Bearer ' . $apiKey;
            }

            $payload = ['to' => $to, 'message' => $message];
            $resp = $client->post($apiUrl, [
                'headers' => $headers,
                'json' => $payload,
                'timeout' => 10,
            ]);

            $responseBody = json_decode((string) $resp->getBody(), true);
            $success = $resp->getStatusCode() >= 200 && $resp->getStatusCode() < 300;

            return [
                'status' => $success,
                'provider' => 'generic',
                'payload' => $payload,
                'response' => $responseBody,
                'error' => $success ? null : 'HTTP ' . $resp->getStatusCode(),
            ];
        } catch (\Exception $e) {
            logger()->error('WhatsApp send failed: ' . $e->getMessage());
            return [
                'status' => false,
                'provider' => $this->provider,
                'payload' => ['to' => $to, 'message' => $message],
                'response' => null,
                'error' => $e->getMessage(),
            ];
        }
    }

    protected function sendViaTwilio(string $to, string $message): array
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM'); // e.g. whatsapp:+1415xxxxxxx

        if (! $accountSid || ! $authToken || ! $from) {
            $error = 'Twilio WhatsApp not configured (TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_WHATSAPP_FROM)';
            logger()->warning($error);
            return [
                'status' => false,
                'provider' => 'twilio',
                'payload' => ['To' => 'whatsapp:' . $to, 'From' => $from, 'Body' => $message],
                'response' => null,
                'error' => $error,
            ];
        }

        // Twilio REST API endpoint for sending messages
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";

        // Twilio expects 'To' and 'From' in 'whatsapp:+62...' format
        $toFormatted = preg_match('/^whatsapp:/', $to) ? $to : 'whatsapp:' . $to;

        try {
            $client = new \GuzzleHttp\Client();
            $resp = $client->post($url, [
                'auth' => [$accountSid, $authToken],
                'form_params' => [
                    'To' => $toFormatted,
                    'From' => $from,
                    'Body' => $message,
                ],
                'timeout' => 10,
            ]);

            $responseBody = json_decode((string) $resp->getBody(), true);
            $success = $resp->getStatusCode() >= 200 && $resp->getStatusCode() < 300;

            return [
                'status' => $success,
                'provider' => 'twilio',
                'payload' => ['To' => $toFormatted, 'From' => $from, 'Body' => $message],
                'response' => $responseBody,
                'error' => $success ? null : 'HTTP ' . $resp->getStatusCode(),
            ];
        } catch (\Exception $e) {
            logger()->error('Twilio WhatsApp send failed: ' . $e->getMessage());
            return [
                'status' => false,
                'provider' => 'twilio',
                'payload' => ['To' => $toFormatted, 'From' => $from, 'Body' => $message],
                'response' => null,
                'error' => $e->getMessage(),
            ];
        }
    }
}
