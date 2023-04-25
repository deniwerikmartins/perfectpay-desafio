<?php

namespace Tests\Feature;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test **/
    public function user_can_create_a_customer()
    {
        $customer = Customer::factory()->make();

        $this->post('/api/customers', $customer->toArray());

        $this->assertEquals(2, Customer::count());
    }

    /** @test **/
    public function user_can_edit_an_existing_customer()
    {
        $customer = Customer::factory()->create();

        $this->put("/api/customers/$customer->id",['name' => 'Deni']);

        $this->assertEquals('Deni', Customer::find($customer->id)->name);
    }

    /** @test **/
    public function user_can_remove_a_customer()
    {
        $customer = Customer::factory()->create();

        $this->delete("/api/customers/$customer->id");

        $this->assertEquals(1, Customer::count());

    }

    /** @test **/
    public function user_can_get_a_list_of_customers()
    {
        $customers = Customer::factory()->count(20)->create();

        $response = $this->get('/api/customers');

        $this->assertEquals(21, count($response->json()));
    }

}
