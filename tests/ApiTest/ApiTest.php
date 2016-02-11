<?php

namespace ApiTest;

use TestCase;
use Goutte;

class ApiTest extends TestCase
{
    private $client;
    private $endpoint;

    public function setUp()
    {
        $this->client   = new Goutte\Client();
        $this->endpoint = 'http://localhost:8080';
    }
    public function testGetStatusesToHtml()
    {
        $this->client->setHeader('Accept', 'text/html');
        $crawler  = $this->client->request('GET', sprintf('%s/statuses', $this->endpoint));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals('text/html;charset=UTF-8', $response->getHeader('Content-Type'));
    }

    public function testGetStatusesToJson()
    {
        $this->client->setHeader('Accept', 'application/json');
        $crawler  = $this->client->request('GET', sprintf('%s/statuses', $this->endpoint));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatus());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
    }

    public function testPostStatusesToJson()
    {
        $this->client->setHeader('Accept', 'application/json');
        $this->client->setHeader('Content-Type', 'application/json');
        $this->client->request(
            'POST', sprintf('%s/statuses', $this->endpoint),
            [], [], [],
            json_encode(['message' => 'Test message']));
        $response = $this->client->getResponse();
        $this->assertEquals(201, $response->getStatus());
        $this->assertEquals('application/json', $response->getHeader('Content-Type'));
    }
}