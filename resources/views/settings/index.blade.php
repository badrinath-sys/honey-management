@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <!-- Company Details -->

                <div class="col-lg-6">

                    <div class="card shadow mb-4">

                        <div class="card-header bg-primary text-white">

                            <h5 class="mb-0">

                                <i class="bi bi-building"></i>

                                Company Information

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label>Company Name</label>

                                <input type="text" name="company_name" class="form-control"
                                    value="{{ old('company_name', $setting->company_name ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Owner Name</label>

                                <input type="text" name="owner_name" class="form-control"
                                    value="{{ old('owner_name', $setting->owner_name ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Phone</label>

                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $setting->phone ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Email</label>

                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $setting->email ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Website</label>

                                <input type="text" name="website" class="form-control"
                                    value="{{ old('website', $setting->website ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>GST Number</label>

                                <input type="text" name="gst" class="form-control"
                                    value="{{ old('gst', $setting->gst ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>PAN Number</label>

                                <input type="text" name="pan_number" class="form-control"
                                    value="{{ old('pan_number', $setting->pan_number ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Address</label>

                                <textarea class="form-control" rows="3" name="address">{{ old('address', $setting->address ?? '') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Bank Details -->

                <div class="col-lg-6">

                    <div class="card shadow mb-4">

                        <div class="card-header bg-success text-white">

                            <h5 class="mb-0">

                                <i class="bi bi-bank"></i>

                                Bank Details

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label>Bank Name</label>

                                <input type="text" name="bank_name" class="form-control"
                                    value="{{ old('bank_name', $setting->bank_name ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Account Holder</label>

                                <input type="text" name="account_name" class="form-control"
                                    value="{{ old('account_name', $setting->account_name ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Account Number</label>

                                <input type="text" name="account_number" class="form-control"
                                    value="{{ old('account_number', $setting->account_number ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>IFSC</label>

                                <input type="text" name="ifsc" class="form-control"
                                    value="{{ old('ifsc', $setting->ifsc ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>Branch</label>

                                <input type="text" name="branch" class="form-control"
                                    value="{{ old('branch', $setting->branch ?? '') }}">

                            </div>

                            <div class="mb-3">

                                <label>UPI ID</label>

                                <input type="text" name="upi_id" class="form-control"
                                    value="{{ old('upi_id', $setting->upi_id ?? '') }}">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Uploads -->

            <div class="card shadow mb-4">

                <div class="card-header bg-warning">

                    <h5 class="mb-0">

                        Upload Files

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <label>Company Logo</label>

                            <input type="file" class="form-control" name="logo">

                        </div>

                        <div class="col-md-4">

                            <label>UPI QR Code</label>

                            <input type="file" class="form-control" name="upi_qr">

                        </div>

                        <div class="col-md-4">

                            <label>Authorized Signature</label>

                            <input type="file" class="form-control" name="signature">

                        </div>

                    </div>

                </div>

            </div>

            <!-- Terms -->

            <div class="card shadow mb-4">

                <div class="card-header bg-info text-white">

                    <h5 class="mb-0">

                        Invoice Terms & Conditions

                    </h5>

                </div>

                <div class="card-body">

                    <textarea name="terms" rows="5" class="form-control">{{ old('terms', $setting->terms ?? '') }}</textarea>

                </div>

            </div>

            <button class="btn btn-success btn-lg">

                <i class="bi bi-check-circle"></i>

                Save Settings

            </button>

        </form>

    </div>
@endsection
