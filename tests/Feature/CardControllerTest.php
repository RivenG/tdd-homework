<?php

namespace Tests\Feature;

use Homework\Card;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $customersBaseUri = '/api/customers';
    protected $accountBaseUri = '/api/accounts';
    protected $cardBaseUri = '/api/cards';

    public function testStore_Success()
    {
        $response = $this->postJson($this->cardBaseUri, [
            'account_id' => 1,
            'customer_id' => 2
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testStore_Error()
    {
        $response = $this->postJson($this->cardBaseUri, [
            'name' => 'Elek',
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('error', $response->json()['status']);
    }

    public function testIndex_SuccessEmpty()
    {
        $response = $this->get($this->cardBaseUri);

        $response->assertStatus(200);
        $this->assertEquals([], $response->json());
    }

    public function testIndex_Success()
    {
        $this->storeTestCardsForTesting();

        $response = $this->get($this->cardBaseUri);

        $response->assertStatus(200);
        $response->assertJsonCount(2, 0);
    }

    public function testShow_Success()
    {
        $this->storeTestCardsForTesting();

        $response = $this->get($this->cardBaseUri . '/1');

        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response->json());
    }

    public function testShow_Error()
    {
        $this->storeTestCardsForTesting();

        $response = $this->get($this->cardBaseUri . '/12');
        $response->assertStatus(404);
    }

    public function testUpdate_Success()
    {
        $this->storeTestCardsForTesting();

        $response = $this->put($this->cardBaseUri . '/1', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testUpdate_Error()
    {
        $this->storeTestCardsForTesting();

        $response = $this->put($this->cardBaseUri . '/3', [
            'firstname' => 'Elek',
            'lastname' => 'Nem Test'
        ]);

        $response->assertStatus(404);
    }

    public function testDestroy_Success()
    {
        $this->storeTestCardsForTesting();

        $response = $this->delete($this->cardBaseUri . '/1');
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('success', $response->json()['status']);
    }

    public function testDestroy_Error()
    {
        $this->storeTestCardsForTesting();

        $response = $this->delete($this->cardBaseUri . '/3');
        $response->assertStatus(404);
    }

    protected function storeTestCardsForTesting()
    {
        $this->storeTestCustomersForTesting();
        $this->storeTestAccountsForTesting();

        $this->postJson($this->cardBaseUri, [
            'account_id' => 1,
            'customer_id' => 1
        ]);

        $a = $this->postJson($this->cardBaseUri, [
            'account_id' => 2,
            'customer_id' => 2
        ]);
    }

    protected function storeTestAccountsForTesting()
    {
        $a = $this->postJson($this->accountBaseUri, [
            'customer_id' => 1
        ]);

        $this->postJson($this->accountBaseUri, [
            'customer_id' => 2
        ]);
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
}
