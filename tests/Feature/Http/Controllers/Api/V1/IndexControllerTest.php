<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Resources\VersionResource;
use Tests\TestCase;

/**
 * Class IndexControllerTest.
 *
 * @covers \App\Http\Controllers\Api\V1\IndexController
 */
final class IndexControllerTest extends TestCase
{
    private IndexController $indexController;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->indexController = new IndexController();
        $this->app->instance(IndexController::class, $this->indexController);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->indexController);
    }

    /**
     * @return void
     */
    public function testIndex(): void
    {
        /** @todo This test is incomplete. */
        $this->getJson('/')
            ->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testIndexReturnsVersionResource()
    {
        $response = $this->get('/api/version');

        $response->assertResource(VersionResource::class);
    }

    /**
     * @return void
     */
    public function testIndexCachesResponse()
    {
        $response = $this->get('/api/version');

        $this->assertTrue($response->headers->hasCacheControlDirective('public'));
        $this->assertTrue($response->headers->hasCacheControlDirective('max-age'));
        $this->assertTrue($response->headers->hasCacheControlDirective('s-maxage'));
    }

    /**
     * @return void
     */
    public function testIndexReturnsLatestVersion()
    {
        $response = $this->get('/api/version');

        $response->assertJsonFragment([
            'version' => '1.0.0'
        ]);
    }

    /**
     * @return void
     */
    public function testIndexReturnsExpectedData()
    {
        $response = $this->get('/api/version');

        $response->assertJsonFragment([
            'version' => '1.0.0',
            'release_date' => '2018-01-01',
            'release_notes' => 'Initial release'
        ]);
    }

    /**
     * @return void
     */
    public function testAll(): void
    {
        $response = $this->json('GET', '/api/v1/users/all');

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]
            ]
        ]);
        $response->assertJsonValidationErrors([]);
    }
}
