<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\IndexController;
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
    public function testAll(): void
    {
        /** @todo This test is incomplete. */
        $this->getJson('/all')
            ->assertStatus(200);
    }
}
