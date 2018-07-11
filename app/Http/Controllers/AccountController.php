<?php

namespace Homework\Http\Controllers;

use Homework\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return Account::all();
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
            $account = new Account($request->all());
            $account->number = app('accountNumberGenerator')->generateRandomAccountNumber();
            $account->save();

            return [
                'id' => $account->id,
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
     * @param  \Homework\Account  $account
     * @return \Homework\Account  $account
     */
    public function show(Account $account)
    {
        return $account;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Homework\Account  $account
     * @return array
     */
    public function update(Request $request, Account $account)
    {
        $account->update($request->all());

        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Homework\Account  $account
     * @return array
     */
    public function destroy(Account $account)
    {
        try {
            $account->delete();
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }
}
