<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\InstallmentPayment;
use App\Models\Loan;
use App\Models\LoanApproval;
use App\Models\Student;
use App\Models\StudentParent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

/**
 * Class LoanController
 * @package App\Http\Controllers
 */
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->hasRole('orang_tua')) {
            $getId          = Auth::user()->id;
            $getParentId    = StudentParent::where('user_id', $getId)->first();

            $loans = Loan::where('parent_id', $getParentId->id)->latest()->get();
        } else {
            $loans = Loan::latest()->get();
        }

        $loans->each(function ($loan) {
            if ($loan->isPay == 1) {
                $loan->percentage = $loan->installmentPayment;
            }
        });

        return view('loan.index', compact('loans'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id             = Auth::user()->id;
        $parents        = StudentParent::where('user_id', $id)->first();
        $classRooms     = ClassRoom::pluck('id', 'name');
        return view('loan.create', compact('parents', 'classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //request()->validate(Loan::$rules);
        $parent_id                  = $request->parent_id;
        $loan_date                  = $request->loan_date;
        $loan_purpose               = $request->loan_purpose;
        $loan_amount                = $request->loan_amount;
        $long_installment           = $request->long_installment;
        $installment_amount         = $request->installment_amount;
        $account_number             = $request->account_number;
        $attachment_kk              = $request->file('attachment_kk');
        $attachment_ktp_orang_tua   = $request->file('attachment_ktp_orang_tua');
        $attachment_ktp_mahasiswa   = $request->file('attachment_ktp_mahasiswa');

        $file_kk            = time() . "_" . $attachment_kk->getClientOriginalName();
        $file_ktp_ortu      = time() . "_" . $attachment_ktp_orang_tua->getClientOriginalName();
        $file_ktp_mahasiswa  = time() . "_" . $attachment_ktp_mahasiswa->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $dir_file_kk        = 'data_kk';
        $dir_ktp_ortu       = 'data_ktp_ortu';
        $dir_ktp_mahasiswa  = 'data_ktp_mahasiswa';

        $attachment_kk->move($dir_file_kk, $file_kk);
        $attachment_ktp_orang_tua->move($dir_ktp_ortu, $file_ktp_ortu);
        $attachment_ktp_mahasiswa->move($dir_ktp_mahasiswa, $file_ktp_mahasiswa);


        $loan                           = Loan::create([
            'parent_id'                 => $parent_id,
            'loan_date'                 => $loan_date,
            'loan_purpose'              => $loan_purpose,
            'loan_amount'               => $loan_amount,
            'long_installment'          => $long_installment,
            'installment_amount'        => $installment_amount,
            'account_number'            => $account_number,
            'attachment_kk'             => $file_kk,
            'attachment_ktp_orang_tua'  => $file_ktp_ortu,
            'attachment_ktp_mahasiswa'  => $file_ktp_mahasiswa,
            'created_at'                => now()
        ]);

        $data = array(
            array(
                'loan_id'       => $loan->id,
                'parent_id'     => $loan->parent_id,
                'name'          => 'Bendahara',
                'approved'      => 2,
                'level'         => 1,
                'created_at'    => now()
            ),
            array(
                'loan_id'       => $loan->id,
                'parent_id'     => $loan->parent_id,
                'name'          => 'Ketua',
                'approved'      => 2,
                'level'         => 2,
                'created_at'    => now(),
            )
        );
        LoanApproval::insert($data);

        $dataPembayaran = array();

        for ($i = 1; $i <= $long_installment; $i++) {
            $dataPembayaran[] = array(
                'loan_id' => $loan->id,
                'parent_id' => $loan->parent_id,
                'installment' => $i,
                'isPay' => 0,
                'created_at' => now()
            );
        }

        InstallmentPayment::insert($dataPembayaran);

        return redirect()->route('admin.loans.index')
            ->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan               = Loan::find($id);
        $levelBendahara     = 1;
        $levelKetua         = 2;
        $bendaharaApproved  = LoanApproval::select('approved')->where('loan_id', $id)->where('level', $levelBendahara)->first();
        $ketuaApproved      = LoanApproval::select('approved')->where('loan_id', $id)->where('level', $levelKetua)->first();

        return view('loan.show', compact('loan', 'bendaharaApproved', 'ketuaApproved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::find($id);

        return view('loan.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //request()->validate(Loan::$rules);

        $loan->update($request->all());

        return redirect()->route('admin.loans.index')
            ->with('success', 'Loan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $file_kk            = Loan::select('attachment_kk')->where('id', $id)->first();
        $file_ktp_ortu      = Loan::select('attachment_ktp_orang_tua')->where('id', $id)->first();
        $file_ktp_mahasiswa = Loan::select('attachment_ktp_mahasiswa')->where('id', $id)->first();

        $dir_kk             = public_path('data_kk/' . $file_kk->attachment_kk);
        $dir_ktp_ortu       = public_path('data_ktp_ortu/' . $file_ktp_ortu->attachment_ktp_orang_tua);
        $dir_ktp_mahasiswa  = public_path('data_ktp_mahasiswa/' . $file_ktp_mahasiswa->attachment_ktp_mahasiswa);

        $del_file_kk            = File::delete($dir_kk);
        $del_file_ktp_ortu      = File::delete($dir_ktp_ortu);
        $del_file_ktp_mahasiswa = File::delete($dir_ktp_mahasiswa);

        $loan = Loan::find($id)->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully');
    }

    public function approve(Request $request, $id)
    {
        $approved       = $request->approved;
        $level          = $request->level;
        $date_approved  = now();
        $loan_id        = $id;

        $loanApproval                   = LoanApproval::where('loan_id', $loan_id)->where('level', $level)->first();

        $loanApproval->approved         = $approved;
        $loanApproval->date_approved    = $date_approved;
        $loanApproval->updated_at       = now();
        $loanApproval->update();

        return redirect()->route('admin.loans.index')
            ->with('success', 'Berhasil menyetujui pinjaman');
    }
    public function reject(Request $request, $id)
    {
        $approved       = $request->approved;
        $level          = $request->level;
        $date_approved  = now();
        $loan_id        = $id;

        $loanApproval                   = LoanApproval::where('loan_id', $loan_id)->where('level', $level)->first();

        $loanApproval->approved         = $approved;
        $loanApproval->date_approved    = $date_approved;
        $loanApproval->updated_at       = now();
        $loanApproval->update();

        return redirect()->route('admin.loans.index')
            ->with('success', 'Berhasil menyetujui pinjaman');
    }

    public function search(Request $request)
    {
        $search     = $request->search;

        $user       = User::select('id')->where('name', 'like', "%{$search}%")->first();

        return $user;
    }

    public function paymentApprove($id)
    {
        $installmentPayment                 = InstallmentPayment::find($id);
        $installmentPayment->payment_date   = now();
        $installmentPayment->isPay          = 1;
        $installmentPayment->update();

        return redirect()->back()->with('success', 'Berhasil verifikasi pembayaran');
    }
    public function paymentReject($id)
    {
        $installmentPayment                 = InstallmentPayment::find($id);
        $installmentPayment->isPay          = 0;
        $installmentPayment->update();

        return redirect()->back()->with('warning', 'Berhasil batalkan pembayaran');
    }

    public function paymentProcess(Request $request)
    {
        $id                                 = $request->loan_id;
        $attachment_payment                 = $request->file('attachment_payment');
        $file_payment                       = time() . "_" . $attachment_payment->getClientOriginalName();
         // isi dengan nama folder tempat kemana file diupload
        $dir_file_payment        = 'data_payment';
        
        $attachment_payment->move($dir_file_payment, $file_payment);

        $installmentPayment                 = InstallmentPayment::find($id);
        $installmentPayment->payment_date   = now();
        $installmentPayment->isPay          = 2;
        $installmentPayment->attachment     = $file_payment;
        $installmentPayment->update();

        return redirect()->route('admin.loans.index')->with('success', 'Berhasil Melakukan Pembayaran Cicilan');
    }

    public function paymentPage($id)
    {
        $installmentPayment = InstallmentPayment::find($id);

        return view('loan.payment.index', compact('installmentPayment'));
    }

    public function showPayment(){
        $getId          = Auth::user()->id;
        $getParentId    = StudentParent::where('user_id', $getId)->first();

        $loans = Loan::where('parent_id', $getParentId->id)->whereHas('loanApproval', function ($query) {
            $query->where('approved', 1)->where('level', 1);
        })->whereHas('loanApproval', function ($query) {
            $query->where('approved', 1)->where('level', 2);
        })->orderBy('created_at', 'DESC')->paginate();

        return view('loan.mypayment', compact('loans'))
        ->with('i');
    }

    public function outflows(){
        $parents        = StudentParent::select('id','user_id')->get();
        $students       = Student::select('name','parent_id')->get();
        $loans  = Loan::latest('updated_at')->paginate();
        return view('loan.report.outflows',compact('loans','parents','students'))->with('i');
    }
    public function inflows(){

        $parents        = StudentParent::select('id','user_id')->get();
        $students       = Student::select('name','parent_id')->get();
        $installment_payments  = InstallmentPayment::where('isPay',1)->latest('updated_at')->paginate();
        return view('loan.report.inflows',compact('installment_payments','parents','students'))->with('i');
    }
    public function outflowsSearch(Request $request){
        $filter_parent_name     = $request->parent_name;
        $filter_nim             = $request->nim;
        $filter_student_name    = $request->student_name;
        $days                   = $request->days;

        $parents        = StudentParent::select('user_id','id')->get();
        $students       = Student::select('name','parent_id')->get();

        if($days == 'today'){
            $startDate  = Carbon::today();
            $loans      = Loan::whereHas('installmentPayment', function ($query) use ($filter_parent_name, $filter_student_name) {
                $query->where('parent_id', $filter_parent_name)
                ->orWhere('parent_id',$filter_student_name);
            })->whereDate('updated_at', '>=', $startDate)->latest('updated_at')->paginate();
        }elseif($days == '7'){
            $startDate  = Carbon::now()->subDays(7);
            $loans      = Loan::whereHas('installmentPayment', function ($query) use ($filter_parent_name, $filter_student_name) {
                $query->where('parent_id', $filter_parent_name)
                ->orWhere('parent_id',$filter_student_name);
            })->whereDate('updated_at', '>=', $startDate)->latest('updated_at')->paginate();
        }elseif($days == '30'){
            $startDate  = Carbon::now()->subDays(30);
            $loans      = Loan::whereHas('installmentPayment', function ($query) use ($filter_parent_name, $filter_student_name) {
                $query->where('parent_id', $filter_parent_name)
                ->orWhere('parent_id',$filter_student_name);
            })->whereDate('updated_at', '>=', $startDate)->latest('updated_at')->paginate();
        }elseif($days == '60'){
            $startDate  = Carbon::now()->subDays(60);
            $loans      = Loan::whereHas('installmentPayment', function ($query) use ($filter_parent_name, $filter_student_name) {
                $query->where('parent_id', $filter_parent_name)
                ->orWhere('parent_id',$filter_student_name);
            })->whereDate('updated_at', '>=', $startDate)->latest('updated_at')->paginate();
        }else{
            $loans = Loan::latest('updated_at')->paginate();
        }
            return view('loan.report.outflows',compact('loans','parents','students'))->with('i');
    }
    public function inflowsSearch(Request $request){
        $filter_parent_name     = $request->parent_name;
        $filter_nim             = $request->nim;
        $filter_student_name    = $request->student_name;
        $days   = $request->days;
        $parents        = StudentParent::select('user_id','id')->get();
        $students       = Student::select('name','parent_id')->get();   

        if($days == 'today'){  
            $startDate  = Carbon::today();     
            $installment_payments  = InstallmentPayment::whereDate('updated_at', $startDate)
            ->where('parent_id',$filter_parent_name)
            ->orWhere('parent_id',$filter_student_name)
            ->where('isPay',1)
            ->latest('updated_at')
            ->paginate();

        }elseif($days == '7'){        
            $startDate  = Carbon::now()->subDays(7);
            $installment_payments  = InstallmentPayment::whereDate('updated_at', '>=', $startDate)
            ->where('parent_id',$filter_parent_name)
            ->orWhere('parent_id',$filter_student_name)
            ->where('isPay',1)
            ->latest('updated_at')->paginate();
        }elseif($days == '30'){
            $startDate  = Carbon::now()->subDays(30);
            $installment_payments  = InstallmentPayment::whereDate('updated_at', '>=', $startDate)
            ->where('parent_id',$filter_parent_name)
            ->orWhere('parent_id',$filter_student_name)
            ->where('isPay',1)
            ->latest('updated_at')->paginate();
        }elseif($days == '60'){
            $startDate  = Carbon::now()->subDays(60);
            $installment_payments  = InstallmentPayment::whereDate('updated_at', '>=', $startDate)
            ->where('parent_id',$filter_parent_name)
            ->orWhere('parent_id',$filter_student_name)
            ->where('isPay',1)
            ->latest('updated_at')->paginate();
        }else{
            $installment_payments  = InstallmentPayment::where('isPay',1)->latest('updated_at')->paginate();
        }
            return view('loan.report.inflows',compact('installment_payments','students','parents'))->with('i');
    }
    
}