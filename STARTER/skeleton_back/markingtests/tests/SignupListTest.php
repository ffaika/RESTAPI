<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SignupListTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse = [
        [
            "id" => 2,
            "email" => "john.doe2@email.com",
            "first_name" => "John",
            "last_name" => "Doe",
        ],
        [
            "id" => 1,
            "email" => "john.doe@email.com",
            "first_name" => "John",
            "last_name" => "Doe",
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new ApiClient();
    }

    /**
     * @medium
     */
    public function testSignupListResponseCode()
    {
        $res = $this->client->get('api/signup');
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testSignupList()
    {
        $res = $this->client->get('api/signup');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['signup']), 2);
        $this->assertJsonEqualsIgnoringOrder($body['signup'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testSignupListOrdering()
    {
        $res = $this->client->get('api/signup');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['signup']), 2);
        $this->assertJsonEquals($body['signup'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testSignupListExtact()
    {
        $res = $this->client->get('api/signup');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['signup']), 2);
        $this->assertJsonStrictEquals($body['signup'], $this->expectedSuccessfulResponse);
    }
}
