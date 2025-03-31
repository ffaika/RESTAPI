<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class AlbumListTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse = [
        [
            "id" => 3,
            "title" => "Thriller",
            "artist" => "Michael Jackson",
            "release_date" => "1984-07-11",
            "songs" => [
                [
                    "id" => 8,
                    "title" => "Beat It",
                    "artist" => "Michael Jackson"
                ],
                [
                    "id" => 9,
                    "title" => "Billie Jean",
                    "artist" => "Michael Jackson"
                ],
                [
                    "id" => 7,
                    "title" => "Thriller",
                    "artist" => "Michael Jackson"
                ]
            ]
        ],
        [
            "id" => 2,
            "title" => "Led Zeppelin IV",
            "artist" => "Led Zeppelin",
            "release_date" => "1982-07-14",
            "songs" => [
                [
                    "id" => 4,
                    "title" => "Black Dog",
                    "artist" => "Led Zeppelin"
                ],
                [
                    "id" => 5,
                    "title" => "Rock and Roll",
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
            "id" => 1,
            "title" => "A Night at the Opera",
            "artist" => "Queen",
            "release_date" => "1975-07-16",
            "songs" => [
                [
                    "id" => 1,
                    "title" => "Bohemian Rhapsody",
                    "artist" => "Queen"
                ],
                [
                    "id" => 3,
                    "title" => "Love of My Life",
                    "artist" => "Queen"
                ],
                [
                    "id" => 2,
                    "title" => "You're My Best Friend",
                    "artist" => "Queen"
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
    public function testAlbumListResponseCode()
    {
        $res = $this->client->get('api/albums');
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testAlbumList()
    {
        $res = $this->client->get('api/albums');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['albums']), 3);
        $this->assertJsonEqualsIgnoringOrder($body['albums'], $this->expectedSuccessfulResponse);
    }

    /**
     * @medium
     */
    public function testAlbumListOrdering()
    {
        $res = $this->client->get('api/albums');
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['albums']), 3);
        $this->assertJsonEquals($body['albums'], $this->expectedSuccessfulResponse);
    }
}
