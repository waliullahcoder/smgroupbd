@extends('layouts.admin.app')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-edit text-warning"></i>
            Edit Document
        </h5>

        <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

    <form action="{{ route('admin.documents.update',$document->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Employee <span class="text-danger">*</span>
                    </label>

                    <select name="employee_id" class="form-select select" required>
                        @foreach($employees as $employee)

                            <option value="{{ $employee->id }}"
                                {{ $document->employee_id == $employee->id ? 'selected' : '' }}>

                                {{ $employee->id }} - {{ $employee->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Document Type <span class="text-danger">*</span>
                    </label>

                    <select name="document_type" class="form-select" required>
                            <option value="ALL"
                                {{ old('document_type', $document->document_type) == 'ALL' ? 'selected' : '' }}>
                                ALL
                            </option>
                            <option value="NID"
                                {{ old('document_type', $document->document_type) == 'NID' ? 'selected' : '' }}>
                                NID
                            </option>

                            <option value="Passport"
                                {{ old('document_type', $document->document_type) == 'Passport' ? 'selected' : '' }}>
                                Passport
                            </option>

                            <option value="Birth Certificate"
                                {{ old('document_type', $document->document_type) == 'Birth Certificate' ? 'selected' : '' }}>
                                Birth Certificate
                            </option>

                            <option value="Driving License"
                                {{ old('document_type', $document->document_type) == 'Driving License' ? 'selected' : '' }}>
                                Driving License
                            </option>

                            <option value="Educational Certificate"
                                {{ old('document_type', $document->document_type) == 'Educational Certificate' ? 'selected' : '' }}>
                                Educational Certificate
                            </option>

                            <option value="Experience Certificate"
                                {{ old('document_type', $document->document_type) == 'Experience Certificate' ? 'selected' : '' }}>
                                Experience Certificate
                            </option>

                            <option value="Joining Letter"
                                {{ old('document_type', $document->document_type) == 'Joining Letter' ? 'selected' : '' }}>
                                Joining Letter
                            </option>

                            <option value="Appointment Letter"
                                {{ old('document_type', $document->document_type) == 'Appointment Letter' ? 'selected' : '' }}>
                                Appointment Letter
                            </option>

                            <option value="TIN Certificate"
                                {{ old('document_type', $document->document_type) == 'TIN Certificate' ? 'selected' : '' }}>
                                TIN Certificate
                            </option>

                            <option value="Bank Account Document"
                                {{ old('document_type', $document->document_type) == 'Bank Account Document' ? 'selected' : '' }}>
                                Bank Account Document
                            </option>

                            <option value="Photo"
                                {{ old('document_type', $document->document_type) == 'Photo' ? 'selected' : '' }}>
                                Photo
                            </option>

                            <option value="Other"
                                {{ old('document_type', $document->document_type) == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>
                        </select>

                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Name <span class="text-danger">*</span></label>

                    <input type="text"
                           name="document_name"
                           class="form-control"
                           value="{{ $document->document_name }}"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Document Link <span class="text-danger">*</span></label>

                    <input type="text"
                           name="document_link"
                           class="form-control"
                           value="{{ $document->document_link }}"
                           required>
                </div>
                


                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Submit Date <span class="text-danger">*</span>
                    </label>

                    <input type="date"
                           name="submit_date"
                           class="form-control"
                           value="{{ $document->submit_date }}"
                           required>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="Pending"
                            {{ $document->status=='Pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="Submitted"
                            {{ $document->status=='Submitted'?'selected':'' }}>
                            Submitted
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Remarks</label>

                    <textarea name="remarks"
                              rows="1"
                              class="form-control">{{ $document->remarks }}</textarea>

                </div>

            </div>

        </div>

        <div class="card-footer text-end">

            <button type="submit" class="btn btn-warning">

                <i class="fas fa-save"></i> Update loan

            </button>

        </div>

    </form>

</div>

@endsection