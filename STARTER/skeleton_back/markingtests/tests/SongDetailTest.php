<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SongDetailTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse = [
        "id" => 1,
        "title" => "Bohemian Rhapsody",
        "artist" => "Queen",
        "album" => [
            "id" => 1,
            "title" => "A Night at the Opera",
            "artist" => "Queen",
            "release_date" => "1975-07-16"
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
    public function testSongDetailResponseCode()
    {
        $res = $this->client->get('api/songs/1');
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testSongDetail()
    {
        $res = $this->client->get('api/songs/1');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['song']), 4);
        $this->assertJsonEquals($body['song'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testSongDetailError()
    {
        $res = $this->client->get('api/songs/9999');

        $this->assertResponseCode($res, 404);
        $this->assertJsonResponseEquals($res, ['message' => 'La chanson n\'existe pas']);
    }
}
