@extends('layouts.investor.app')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-information-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-information" type="button" role="tab"
                                aria-controls="pills-information" aria-selected="true">Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-bank-tab" data-bs-toggle="pill" data-bs-target="#pills-bank"
                                type="button" role="tab" aria-controls="pills-bank" aria-selected="false">Bank
                                Account</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-other-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-other" type="button" role="tab" aria-controls="pills-other"
                                aria-selected="false">Others
                                Account</button>
                        </li>
                    </ul>
                    <hr>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-information" role="tabpanel"
                                    aria-labelledby="pills-information-tab">
                                    <h4 class="h6 mb-4 text-uppercase">Update Information</h4>
                                    <form action="{{ Route('investor.settings') }}" method="post">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="name" class="col-lg-2 col-sm-4"><b>Investor
                                                            Name <span class="text-danger">*</span></b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="text" id="name" name="name"
                                                            class="form-control" value="{{ $data->name }}"
                                                            placeholder="Investor Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="email" class="col-lg-2 col-sm-4"><b>Email <span
                                                                class="text-danger">*</span></b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="email" id="email" name="email"
                                                            class="form-control" value="{{ $data->email }}"
                                                            placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="phone" class="col-lg-2 col-sm-4"><b>Phone No. <span
                                                                class="text-danger">*</span></b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="number" id="phone" name="phone"
                                                            class="form-control" value="{{ $data->phone }}"
                                                            placeholder="Phone No." required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="image" class="col-lg-2 col-sm-4"><b>Image</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="file" class="form-control" name="image"
                                                            id="image" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-bank" role="tabpanel"
                                    aria-labelledby="pills-bank-tab">
                                    <h4 class="h6 mb-4 text-uppercase">Bank Account</h4>
                                    <form action="{{ Route('investor.settings') }}" method="post">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="bank" class="col-lg-2 col-sm-4"><b>Bank
                                                            Name</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="text" name="bank" id="bank"
                                                            class="form-control" placeholder="Bank Name"
                                                            value="{{ $data->bank }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="branch" class="col-lg-2 col-sm-4"><b>Branch
                                                            Name</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="text" name="branch" id="branch"
                                                            class="form-control" placeholder="Branch Name"
                                                            value="{{ $data->branch }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="account_name" class="col-lg-2 col-sm-4"><b>Account
                                                            Name</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="text" name="account_name" id="account_name"
                                                            class="form-control" placeholder="Account Name"
                                                            value="{{ $data->account_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="account_no" class="col-lg-2 col-sm-4"><b>Account
                                                            Number</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="number" name="account_no" id="account_no"
                                                            class="form-control" placeholder="Account Number"
                                                            value="{{ $data->account_no }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-other" role="tabpanel"
                                    aria-labelledby="pills-other-tab">
                                    <h4 class="h6 mb-4 text-uppercase">Other Account</h4>
                                    <form action="{{ Route('investor.settings') }}" method="post">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="bkash" class="col-lg-2 col-sm-4"><b>Bkash
                                                            Account</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="number" name="bkash" id="bkash"
                                                            class="form-control" placeholder="Bkash Account"
                                                            value="{{ $data->bkash }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="rocket" class="col-lg-2 col-sm-4"><b>Rocket
                                                            Account</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="number" name="rocket" id="rocket"
                                                            class="form-control" placeholder="Rocket Account"
                                                            value="{{ $data->rocket }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-2 align-items-center">
                                                    <label for="nagad" class="col-lg-2 col-sm-4"><b>Nagad
                                                            Account</b></label>
                                                    <div class="col-lg-10 col-sm-8">
                                                        <input type="number" name="nagad" id="nagad"
                                                            class="form-control" placeholder="Nagad Account"
                                                            value="{{ $data->nagad }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
