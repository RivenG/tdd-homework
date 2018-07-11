<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore_Success()
    {
        $response = $this->postJson('/api/customers', [
            'firstname' => 'Elek',
            'lastname' => 'Test'
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testStore_Error()
    {
        $response = $this->postJson('/api/customers', [
            'name' => 'Elek',
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('error', $response->json()['status']);
    }

    public function testIndex_SuccessEmpty()
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
        $this->assertEquals([], $response->json());
    }

    public function testIndex_Success()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->get('/api/customers');

        $response->assertStatus(200);
        $response->assertJsonCount(2, 0);
    }

    public function testShow_Success()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->get('/api/customers/1');

        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response->json());
    }

    public function testShow_Error()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->get('/api/customers/12');
        $response->assertStatus(404);
    }

    public function testUpdate_Success()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->put('/api/customers/1', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testUpdate_Error()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->put('/api/customers/3', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(404);
    }

    public function testDestroy_Success()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->delete('/api/customers/1');
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testDestroy_Error()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->delete('/api/customers/3');
        $response->assertStatus(404);
    }

    protected function storeTestCustomersForTesting()
    {
        $this->postJson('/api/customers', [
            'firstname' => 'Elek',
            'lastname' => 'Test'
        ]);

        $this->postJson('/api/customers', [
            'firstname' => 'Huba',
            'lastname' => 'Dezső'
        ]);
    }
}
