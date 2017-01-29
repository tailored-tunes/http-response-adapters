<?php
namespace TailoredTunes\HttpResponses;

class JsonResponse
{


    private $success;
    private $data;

    public function __construct($success, $data)
    {
        $this->success = $success;
        $this->data = $data;
    }

    public function response($code = 200, $headers = array())
    {
        $response = new Response();

        $body = json_encode(
            [
                'success' => $this->success,
                'data' => $this->data
            ]
        );

        $defaultOptions = [
            'Content-Type: application/json',
            'Content-Length: '.strlen($body)
        ];

        $finalHeaders = array_merge($defaultOptions, $headers);

        $response->setHeaders($finalHeaders);
        $response->setBody($body);
        $response->respondWith($code);

        return $response;
    }
}
