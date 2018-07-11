<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $accountBaseUri = '/api/accounts';
    protected $customersBaseUri = '/api/costumers';

    public function testStore_Success()
    {
        $this->storeTestCustomersForTesting();

        $response = $this->postJson($this->accountBaseUri, [
            'customer_id' => '1'
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testStore_Error()
    {
        $response = $this->postJson($this->accountBaseUri, [
            'name' => 'Elek',
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('error', $response->json()['status']);
    }

    public function testIndex_SuccessEmpty()
    {
        $response = $this->get($this->accountBaseUri);

        $response->assertStatus(200);
        $this->assertEquals([], $response->json());
    }

    public function testIndex_Success()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->get($this->accountBaseUri);

        $response->assertStatus(200);
        $response->assertJsonCount(2, 0);
    }

    public function testShow_Success()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->get($this->accountBaseUri . '/1');

        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response->json());
    }

    public function testShow_Error()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->get($this->accountBaseUri . '/12');
        $response->assertStatus(404);
    }

    public function testUpdate_Success()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->put($this->accountBaseUri . '/1', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testUpdate_Error()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->put($this->accountBaseUri . '/3', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(404);
    }

    public function testDestroy_Success()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->delete($this->accountBaseUri . '/1');
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testDestroy_Error()
    {
        $this->storeTestAccountsForTesting();

        $response = $this->delete($this->accountBaseUri . '/3');
        $response->assertStatus(404);
    }

    protected function storeTestCustomersForTesting()
    {
        $this->postJson($this->customersBaseUri, [
            'firstname' => 'Elek',
            'lastname' => 'Test'
        ]);

        $this->postJson($this->customersBaseUri, [
            'firstname' => 'Huba',
            'lastname' => 'Dezső'
        ]);
    }

    protected function storeTestAccountsForTesting()
    {
        $this->storeTestCustomersForTesting();

        $this->postJson($this->accountBaseUri, [
            'customer_id' => 1
        ]);

        $this->postJson($this->accountBaseUri, [
            'customer_id' => 2
        ]);
    }
}
