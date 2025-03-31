<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\WriteTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class PlaylistCreateTest extends WriteTest
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
    public function testPlaylistCreateInvalidRequest()
    {
        $res = $this->client->post('api/playlists');
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testPlaylistCreateInvalidRequestInvalidTitle()
    {
        $res = $this->client->post('api/playlists', ["json" => ['title' => '', 'author' => 'songAlbumTest', 'songs' => [1]]]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testPlaylistCreateInvalidSong()
    {
        $res = $this->client->post('api/playlists', ["json" => ['title' => 'songTitleTest', 'author' => 'songAlbumTest', 'songs' => [999]]]);
        $this->assertResponseCode($res, 404);
        $this->assertJsonResponseEquals($res, ['message' => 'La chanson n\'existe pas']);
    }

    /**
     * @medium
     */
    public function testPlaylistCreateSuccess()
    {
        $res = $this->client->post('api/playlists', ["json" => ['title' => 'songTitleTest', 'author' => 'songAlbumTest', 'songs' => [1]]]);
        $this->assertResponseCode($res, 201);
        $this->assertJsonResponseEquals($res, ['message' => 'Playlist ajoutée avec succès']);

        $res = $this->client->get('api/playlists');
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['playlists']), 3);

    }
}
