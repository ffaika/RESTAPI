<?php

namespace WSFR\Skill17\spotiskill\Tests\Clients;

use GuzzleHttp\Client;

class ApiClient extends Client
{
    public function __construct(array $config = [])
    {
        $baseUri = 'http://127.0.0.1/module-b';

        if (substr($baseUri, -1) !== '/') {
            $baseUri .= '/';
        }

        parent::__construct(array_merge([
            'base_uri' => $baseUri,
            'headers' => array_merge([
                'Accept' => 'application/json',
            ], $config['headers'] ?? []),
            'http_errors' => false,
        ], $config));
    }
}
