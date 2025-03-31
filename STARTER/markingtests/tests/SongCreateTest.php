<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\WriteTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class SongCreateTest extends WriteTest
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
    public function testSongCreateInvalidRequest()
    {
        $res = $this->client->post('api/songs');
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testSongCreateInvalidRequestInvalidTitle()
    {
        $res = $this->client->post('api/songs', ["json" => ['title' => '', 'artist' => 'songAlbumTest', 'album_id' => 1]]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testSongCreateInvalidAlbum()
    {
        $res = $this->client->post('api/songs', ["json" => ['title' => 'songTitleTest', 'artist' => 'songAlbumTest', 'album_id' => 9999]]);
        $this->assertResponseCode($res, 404);
        $this->assertJsonResponseEquals($res, ['message' => 'L\'album n\'existe pas']);
    }

    /**
     * @medium
     */
    public function testSongCreateSuccess()
    {
        $res = $this->client->post('api/songs', ["json" => ['title' => 'songTitleTest', 'artist' => 'songAlbumTest', 'album_id' => 1]]);
        $this->assertResponseCode($res, 201);
        $this->assertJsonResponseEquals($res, ['message' => 'Chanson ajoutée avec succès']);

        $res = $this->client->get('api/songs/10');
        $body = $this->decodeJsonResponse($res);
        $this->assertEquals(count($body['song']), 4);
        $this->assertJsonEquals($body['song'], ['title' => 'songTitleTest', 'artist' => 'songAlbumTest', 'album' => ['id' => 1, 'title' => "A Night at the Opera", "artist" => "Queen", "release_date" => "1975-07-16"]]);
    }
}
