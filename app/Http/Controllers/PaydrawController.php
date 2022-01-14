<?php

namespace App\Http\Controllers;

use App\Models\Paydraw;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PaydrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $paydraws = Paydraw::where('user_id', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->transaction_id == 1) {
            $view = 'paydraws.draw';
        } else {
            $view = 'paydraws.pay';
        }

        return view($view, ['id' => $request->transaction_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $money = (substr($data->value, 0, -2));
        $money2 = str_replace(',', '.', $money);

        $user = User::find(Auth::user()->id);

        if ($data->id == '1') {
            $user->bank_balance = $user->bank_balance - floatval($money2);
        } else {
            $user->bank_balance = $user->bank_balance + floatval($money2);
        }

        $user->save();

        return redirect()->back()
            ->with('status', 'Transação Concluída!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paydraw  $paydraw
     * @return \Illuminate\Http\Response
     */
    public function show(Paydraw $paydraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paydraw  $paydraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Paydraw $paydraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paydraw  $paydraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paydraw $paydraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paydraw  $paydraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paydraw $paydraw)
    {
        //
    }
}
