<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SongListTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse =  [
        [
            "id" => 8,
            "title" => "Beat It",
            "artist" => "Michael Jackson",
            "album" => [
                "id" => 3,
                "title" => "Thriller",
                "artist" => "Michael Jackson",
                "release_date" => "1984-07-11"
            ]
        ],
        [
            "id" => 9,
            "title" => "Billie Jean",
            "artist" => "Michael Jackson",
            "album" => [
                "id" => 3,
                "title" => "Thriller",
                "artist" => "Michael Jackson",
                "release_date" => "1984-07-11"
            ]
        ],
        [
            "id" => 4,
            "title" => "Black Dog",
            "artist" => "Led Zeppelin",
            "album" => [
                "id" => 2,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin",
                "release_date" => "1982-07-14"
            ]
        ],
        [
            "id" => 1,
            "title" => "Bohemian Rhapsody",
            "artist" => "Queen",
            "album" => [
                "id" => 1,
                "title" => "A Night at the Opera",
                "artist" => "Queen",
                "release_date" => "1975-07-16"
            ]
        ],
        [
            "id" => 3,
            "title" => "Love of My Life",
            "artist" => "Queen",
            "album" => [
                "id" => 1,
                "title" => "A Night at the Opera",
                "artist" => "Queen",
                "release_date" => "1975-07-16"
            ]
        ],
        [
            "id" => 5,
            "title" => "Rock and Roll",
            "artist" => "Led Zeppelin",
            "album" => [
                "id" => 2,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin",
                "release_date" => "1982-07-14"
            ]
        ],
        [
            "id" => 6,
            "title" => "Stairway to Heaven",
            "artist" => "Led Zeppelin",
            "album" => [
                "id" => 2,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin",
                "release_date" => "1982-07-14"
            ]
        ],
        [
            "id" => 7,
            "title" => "Thriller",
            "artist" => "Michael Jackson",
            "album" => [
                "id" => 3,
                "title" => "Thriller",
                "artist" => "Michael Jackson",
                "release_date" => "1984-07-11"
            ]
        ],
        [
            "id" => 2,
            "title" => "You're My Best Friend",
            "artist" => "Queen",
            "album" => [
                "id" => 1,
                "title" => "A Night at the Opera",
                "artist" => "Queen",
                "release_date" => "1975-07-16"
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
    public function testSongListResponseCode()
    {
        $res = $this->client->get('api/songs');
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testSongList()
    {
        $res = $this->client->get('api/songs');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['songs']), 9);
        $this->assertJsonEqualsIgnoringOrder($body['songs'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testSongListOrdering()
    {
        $res = $this->client->get('api/songs');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['songs']), 9);
        $this->assertJsonEquals($body['songs'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testSongListExtact()
    {
        $res = $this->client->get('api/songs');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['songs']), 9);
        $this->assertJsonStrictEquals($body['songs'], $this->expectedSuccessfulResponse);
    }
}
