@extends('layouts.dashboard')

@section('title')
    Pembayaran
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            Jumlah yang harus dibayar
                        </h3>
                        <h3>
                            <strong>
                                Rp .{{ number_format($installmentPayment->loan->loan_amount) }}
                            </strong>
                        </h3>
                        <button class="btn btn-outlined btn-primary w-100"
                            onclick="document.getElementById('getFile').click()">
                            <i class="fa fa-upload"aria-hidden="true"></i>
                            Saya sudah melunasi
                        </button>
                        <input type='file' id="getFile" name="attachment_payment" style="display:none">
                        <div class="container py-1 mt-3">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <div class="card rounded-3">
                                        <div class="card-body mx-1 my-2">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <i class="fab fa-cc-visa fa-4x text-black pe-3"></i>
                                                </div>
                                                <div>
                                                    <p class="d-flex flex-column ml-3 mb-0">
                                                        <b>Martina Thomas</b><span class="small text-muted">**** 8880</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
