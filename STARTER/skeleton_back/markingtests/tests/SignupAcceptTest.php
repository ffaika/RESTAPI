<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\WriteTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SignupAcceptTest extends WriteTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new ApiClient();
    }

    /**
     * @medium
     */
    public function testSignupAcceptInvalidRequest()
    {
        $res = $this->client->put('api/signup/0/accept');
        $this->assertResponseCode($res, 404);
        $this->assertJsonResponseEquals($res, ['message' => 'La demande d\'inscription n\'existe pas']);
    }

    /**
     * @medium
     */
    public function testSignupAcceptSuccess()
    {
        $res = $this->client->put('api/signup/1/accept');
        $this->assertResponseCode($res, 200);
        $this->assertJsonResponseEquals($res, ['message' => 'Demande d\'inscription acceptée avec succès']);

        $res = $this->client->get('api/signup');
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['signup']), 1);

    }
}
