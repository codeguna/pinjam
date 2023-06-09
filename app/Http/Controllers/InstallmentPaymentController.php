<?php

namespace App\Http\Controllers;

use App\Models\InstallmentPayment;
use Illuminate\Http\Request;

/**
 * Class InstallmentPaymentController
 * @package App\Http\Controllers
 */
class InstallmentPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installmentPayments = InstallmentPayment::paginate();

        return view('installment-payment.index', compact('installmentPayments'))
            ->with('i', (request()->input('page', 1) - 1) * $installmentPayments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $installmentPayment = new InstallmentPayment();
        return view('installment-payment.create', compact('installmentPayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(InstallmentPayment::$rules);

        $installmentPayment = InstallmentPayment::create($request->all());

        return redirect()->route('installment-payments.index')
            ->with('success', 'InstallmentPayment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $installmentPayment = InstallmentPayment::find($id);

        return view('installment-payment.show', compact('installmentPayment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $installmentPayment = InstallmentPayment::find($id);

        return view('installment-payment.edit', compact('installmentPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InstallmentPayment $installmentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstallmentPayment $installmentPayment)
    {
        request()->validate(InstallmentPayment::$rules);

        $installmentPayment->update($request->all());

        return redirect()->route('installment-payments.index')
            ->with('success', 'InstallmentPayment updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $installmentPayment = InstallmentPayment::find($id)->delete();

        return redirect()->route('installment-payments.index')
            ->with('success', 'InstallmentPayment deleted successfully');
    }
}
