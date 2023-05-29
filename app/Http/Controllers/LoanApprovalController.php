<?php

namespace App\Http\Controllers;

use App\Models\LoanApproval;
use Illuminate\Http\Request;

/**
 * Class LoanApprovalController
 * @package App\Http\Controllers
 */
class LoanApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanApprovals = LoanApproval::paginate();

        return view('loan-approval.index', compact('loanApprovals'))
            ->with('i', (request()->input('page', 1) - 1) * $loanApprovals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loanApproval = new LoanApproval();
        return view('loan-approval.create', compact('loanApproval'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(LoanApproval::$rules);

        $loanApproval = LoanApproval::create($request->all());

        return redirect()->route('loan-approvals.index')
            ->with('success', 'LoanApproval created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loanApproval = LoanApproval::find($id);

        return view('loan-approval.show', compact('loanApproval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loanApproval = LoanApproval::find($id);

        return view('loan-approval.edit', compact('loanApproval'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  LoanApproval $loanApproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanApproval $loanApproval)
    {
        request()->validate(LoanApproval::$rules);

        $loanApproval->update($request->all());

        return redirect()->route('loan-approvals.index')
            ->with('success', 'LoanApproval updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $loanApproval = LoanApproval::find($id)->delete();

        return redirect()->route('loan-approvals.index')
            ->with('success', 'LoanApproval deleted successfully');
    }
}
