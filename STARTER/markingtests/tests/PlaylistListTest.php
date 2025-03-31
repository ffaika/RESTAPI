<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class PlaylistListTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse = [
        [
            "id" => 1,
            "title" => "Rock Classics",
            "author" => "John Doe",
            "songs" => [
                [
                    "id" => 3,
                    "title" => "Love of My Life",
                    "artist" => "Queen"
                ],
                [
                    "id" => 4,
                    "title" => "Black Dog",
                    "artist" => "Led Zeppelin"
                ],
                [
                    "id" => 6,
                    "title" => "Stairway to Heaven",
                    "artist" => "Led Zeppelin"
                ]
            ]
        ],
        [
            "id" => 2,
            "title" => "80s Pop",
            "author" => "John Doe",
            "songs" => [
                [
                    "id" => 2,
                    "title" => "You're My Best Friend",
                    "artist" => "Queen"
                ],
                [
                    "id" => 3,
                    "title" => "Love of My Life",
                    "artist" => "Queen"
                ],
                [
                    "id" => 9,
                    "title" => "Billie Jean",
                    "artist" => "Michael Jackson"
                ]
            ]
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
    public function testPlaylistListResponseCode()
    {
        $res = $this->client->get('api/playlists');
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testPlaylistList()
    {
        $res = $this->client->get('api/playlists');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['playlists']), 2);
        $this->assertJsonEqualsIgnoringOrder($body['playlists'], $this->expectedSuccessfulResponse);
    }
}
