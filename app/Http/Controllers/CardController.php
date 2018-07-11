<?php

namespace Homework\Http\Controllers;

use Homework\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        try {
            $card = new Card($request->all());
            $card->number = app('cardNumberGenerator')->generateRandomCardNumber();
            $card->save();

            return [
                'id' => $card->id,
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
     * @param  \Homework\Card $card
     * @return \Homework\Card $card
     */
    public function show(Card $card)
    {
        return $card;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Homework\Card $card
     * @return array
     */
    public function update(Request $request, Card $card)
    {
        $card->update($request->all());

        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Homework\Card $card
     * @return array
     * @throws \Exception
     */
    public function destroy(Card $card)
    {
        try {
            $card->delete();
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            return [
                'status' => 'error',
                'message' => $exception->getMessage()
            ];
        }
    }
}
