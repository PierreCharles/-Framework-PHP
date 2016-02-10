<?php

namespace Http;

class JsonResponse extends Response
{
    public function __construct($content, $code = 200, array $headers = [])
    {
        parent::__construct(json_encode($content), $code, array_merge(['Content-Type' => 'application/json'], $headers));
    }
}
