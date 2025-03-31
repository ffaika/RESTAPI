<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\WriteTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SignupCreateTest extends WriteTest
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
    public function testSignupCreateInvalidRequest()
    {
        $res = $this->client->post('api/signup');
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testSignupCreateInvalidRequestInvalidEmail()
    {
        $res = $this->client->post('api/signup', ["json" => ['email' => 'aa', 'password' => 'password', 'confirm_password' => 'password', 'first_name' => 'firstName', 'last_name' => 'lastName']]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testSignupCreateInvalidRequestPassword()
    {
        $res = $this->client->post('api/signup', ["json" => ['email' => 'email@email.com', 'password' => 'password', 'confirm_password' => 'invalidPassword', 'first_name' => 'firstName', 'last_name' => 'lastName']]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testSignupCreateSuccess()
    {
        $res = $this->client->post('api/signup', ["json" => ['email' => 'email@email.com', 'password' => 'password', 'confirm_password' => 'password', 'first_name' => 'firstName', 'last_name' => 'lastName']]);
        $this->assertResponseCode($res, 201);
        $this->assertJsonResponseEquals($res, ['message' => 'Demande d\'inscription ajoutée avec succès']);

        $res = $this->client->get('api/signup');
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['signup']), 3);

    }
}
