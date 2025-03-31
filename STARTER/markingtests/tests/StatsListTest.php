<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\ReadTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class StatsListTest extends ReadTest
{
    use ResponseAsserts;

    protected ApiClient $client;

    protected array $expectedSuccessfulResponse = [
        'albums' => [
            [
                "time" => 3185,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin"
            ],
            [
                "time" => 1589,
                "title" => "A Night at the Opera",
                "artist" => "Queen"
            ],
            [
                "time" => 234,
                "title" => "Thriller",
                "artist" => "Michael Jackson"
            ]
        ],
        'albumsLastDay' => [
            [
                "time" => 3185,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin"
            ],
            [
                "time" => 567,
                "title" => "A Night at the Opera",
                "artist" => "Queen"
            ],
            [
                "time" => 234,
                "title" => "Thriller",
                "artist" => "Michael Jackson"
            ]
        ],
        'albumsUser' => [
            [
                "time" => 2730,
                "title" => "Led Zeppelin IV",
                "artist" => "Led Zeppelin"
            ]
        ],
        'songs' => [
            [
                "time" => 2275,
                "title" => "Black Dog",
                "artist" => "Led Zeppelin"
            ],
            [
                "time" => 1022,
                "title" => "Bohemian Rhapsody",
                "artist" => "Queen"
            ],
            [
                "time" => 567,
                "title" => "You're My Best Friend",
                "artist" => "Queen"
            ]
        ],
        'artists' => [
            [
                "time" => 3185,
                "artist" => "Led Zeppelin"
            ],
            [
                "time" => 1589,
                "artist" => "Queen"
            ],
            [
                "time" => 234,
                "artist" => "Michael Jackson"
            ]
        ],
        'artistsLastDay' => [
            [
                "time" => 3185,
                "artist" => "Led Zeppelin"
            ],
            [
                "time" => 567,
                "artist" => "Queen"
            ],
            [
                "time" => 234,
                "artist" => "Michael Jackson"
            ]
        ],
        'artistsUser' => [
            [
                "time" => 2730,
                "artist" => "Led Zeppelin"
            ]
        ],
        'playing' => 5008,
        'playingLastDay' => 3986,
        'playingUser' => 2730,
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->client = new ApiClient();
    }

    /**
     * @medium
     */
    public function testStatsListInvalid()
    {
        $res = $this->client->get('api/stats');
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testStatsListWrongType()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'invalid']]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testStatsLisGoodType()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'albums']]);
        $this->assertResponseCode($res, 200);
    }

    /**
     * @medium
     */
    public function testStatsListAlbums()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'albums']]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['albums'], $this->expectedSuccessfulResponse['albums']);
    }

    /**
     * @medium
     */
    public function testStatsListAlbumsFromToEmpty()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'albums', 'from' => date('Y-m-d', strtotime(' - 2 years')), 'to' => date('Y-m-d', strtotime(' - 1 years'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['albums'], []);
    }

    /**
     * @medium
     */
    public function testStatsListAlbumsFromToLastDay()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'albums', 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['albums'], $this->expectedSuccessfulResponse['albumsLastDay']);
    }

    /**
     * @medium
     */
    public function testStatsListAlbumsUser()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'albums', 'user_id' => 1, 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['albums'], $this->expectedSuccessfulResponse['albumsUser']);
    }

    /**
     * @medium
     */
    public function testStatsListArtists()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'artists']]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['artists'], $this->expectedSuccessfulResponse['artists']);
    }

    /**
     * @medium
     */
    public function testStatsListArtistsFromToEmpty()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'artists', 'from' => date('Y-m-d', strtotime(' - 2 years')), 'to' => date('Y-m-d', strtotime(' - 1 years'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['artists'], []);
    }

    /**
     * @medium
     */
    public function testStatsListArtistsFromToLastDay()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'artists', 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['artists'], $this->expectedSuccessfulResponse['artistsLastDay']);
    }

    /**
     * @medium
     */
    public function testStatsListArtistsUser()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'artists', 'user_id' => 1, 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['artists'], $this->expectedSuccessfulResponse['artistsUser']);
    }

    /**
     * @medium
     */
    public function testStatsListPlaying()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'playing_time']]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['playing'], $this->expectedSuccessfulResponse['playing']);
    }

    /**
     * @medium
     */
    public function testStatsListPlayingFromToEmpty()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'playing_time', 'from' => date('Y-m-d', strtotime(' - 2 years')), 'to' => date('Y-m-d', strtotime(' - 1 years'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['playing'], 0);
    }

    /**
     * @medium
     */
    public function testStatsListPlayingFromToLastDay()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'playing_time', 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['playing'], $this->expectedSuccessfulResponse['playingLastDay']);
    }

    /**
     * @medium
     */
    public function testStatsListPlayingUser()
    {
        $res = $this->client->get('api/stats', ['json' => ['type' => 'playing_time', 'user_id' => 1, 'from' => date('Y-m-d', strtotime(' - 2 days')), 'to' => date('Y-m-d', strtotime(' + 1 days'))]]);
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertJsonEquals($body['stats']['playing'], $this->expectedSuccessfulResponse['playingUser']);
    }
}
