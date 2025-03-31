<?php

namespace WSFR\Skill17\spotiskill\Tests;

use Skills17\PHPUnit\Database\WriteTest;
use WSFR\Skill17\spotiskill\Tests\Asserts\ResponseAsserts;
use WSFR\Skill17\spotiskill\Tests\Clients\ApiClient;

class AlbumCreateTest extends WriteTest
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
    public function testAlbumCreateInvalidRequest()
    {
        $res = $this->client->post('api/albums');
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testAlbumCreateInvalidRequestInvalidTitle()
    {
        $res = $this->client->post('api/albums', ["json" => ['title' => '', 'artist' => 'songAlbumTest', 'release_date' => '2023-07-30']]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testAlbumCreateInvalidRequestInvalidDate()
    {
        $res = $this->client->post('api/albums', ["json" => ['title' => '', 'artist' => 'songAlbumTest', 'release_date' => '20233-07-30']]);
        $this->assertResponseCode($res, 400);
        $this->assertJsonResponseEquals($res, ['message' => 'La requête est mal formulée']);
    }

    /**
     * @medium
     */
    public function testAlbumCreateSuccess()
    {
        $res = $this->client->post('api/albums', ["json" => ['title' => 'songTitleTest', 'artist' => 'songAlbumTest', 'release_date' => '2023-07-30']]);
        $this->assertResponseCode($res, 201);
        $this->assertJsonResponseEquals($res, ['message' => 'Album ajoutée avec succès']);

        $res = $this->client->get('api/albums');
        $this->assertResponseCode($res, 200);
        $body = $this->decodeJsonResponse($res);

        $this->assertEquals(count($body['albums']), 4);

    }
}
