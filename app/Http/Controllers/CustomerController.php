<?php

namespace Homework\Http\Controllers;

use Homework\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        try {
            $customer = new Customer($request->all());
            $customer->save();

            return [
                'id' => $customer->id,
                'status' => 'success'
            ];

        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => $exception->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Homework\Customer  $customer
     * @return \Homework\Customer  $customer
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Homework\Customer  $customer
     * @return array
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Homework\Customer  $customer
     * @return array
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }
}
