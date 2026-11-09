@extends('layouts.admin.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.minicolors.css') }}">
@endpush

@section('content')
    <form action="{{ Route('admin.admin-settings.update', '0') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-2 d-flex justify-content-between">
                        <h6 class="h6 mb-0 py-5px">Update Admin data</h6>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="title" class="form-label"><b>Title</b></label>
                                <input type="text" id="title" name="title" placeholder="Ttitle"
                                    class="form-control" value="{{ @$data->title }}" required>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="invest_value" class="form-label"><b>Invest Value</b></label>
                                <input type="number" id="invest_value" name="invest_value" placeholder="Invest Value"
                                    class="form-control" value="{{ @$data->invest_value }}" required>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="accounting" class="form-label"><b>Accounting</b></label>
                                <select class="form-select" name="accounting" id="accounting">
                                    <option value="0" {{ $data->accounting == 0 ? 'selected' : '' }}>Deactive
                                    </option>
                                    <option value="1" {{ $data->accounting == 1 ? 'selected' : '' }}>Active
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="store_id" class="form-label"><b>POS Store <span
                                            class="text-danger">*</span></b></label>
                                <select class="form-select select" name="store_id" id="store_id"
                                    data-placeholder="Select Store" required>
                                    <option value=""></option>
                                    @foreach ($stores as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data->store_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="logo" class="form-label"><b>Logo</b></label>
                                <input type="file" id="logo" name="logo" class="form-control" accept="image/*"
                                    {{ file_exists(@$data->logo) ? '' : 'required' }}>
                                @if (file_exists(@$data->logo))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->logo) }}" height="50" alt="Logo">
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="favicon" class="form-label"><b>Favicon</b></label>
                                <input type="file" id="favicon" name="favicon" class="form-control" accept="image/*"
                                    {{ file_exists(@$data->favicon) ? '' : 'required' }}>
                                @if (file_exists(@$data->favicon))
                                    <div class="pt-2">
                                        <img src="{{ asset($data->favicon) }}" height="50" alt="Favicon">
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="facebook" class="form-label"><b>Facebook</b></label>
                                <input type="text" id="facebook" name="facebook" placeholder="Facebook"
                                    class="form-control" value="{{ @$data->facebook }}">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="twitter" class="form-label"><b>Twitter</b></label>
                                <input type="text" id="twitter" name="twitter" placeholder="Twitter"
                                    class="form-control" value="{{ @$data->twitter }}">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="linkedin" class="form-label"><b>Linkedin</b></label>
                                <input type="text" id="linkedin" name="linkedin" placeholder="Linkedin"
                                    class="form-control" value="{{ @$data->linkedin }}">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label for="whatsapp" class="form-label"><b>Whatsapp</b></label>
                                <input type="text" id="whatsapp" name="whatsapp" placeholder="Whatsapp"
                                    class="form-control" value="{{ @$data->whatsapp }}">
                            </div>
                            <div class="col-12">
                                <label for="footer_text" class="form-label"><b>Footer Text</b></label>
                                <input type="text" id="footer_text" name="footer_text" placeholder="Footer Text"
                                    class="form-control" value="{{ @$data->footer_text }}" required>
                            </div>
                        <style>
                        .theme-template {
                            border: 2px solid #e5e7eb;
                            border-radius: 12px;
                            overflow: hidden;
                            cursor: pointer;
                            background: #fff;
                            transition: .25s ease;
                            position: relative;
                        }

                        .theme-template:hover {
                            transform: translateY(-4px);
                            box-shadow: 0 8px 25px rgba(0,0,0,.10);
                        }

                        .theme-template.active {
                            border-color: #0d6efd;
                            box-shadow: 0 0 0 3px rgba(13,110,253,.12);
                        }


                        /* Preview */

                        .theme-preview {
                            height: 130px;
                            padding: 10px;
                        }

                        .preview-header {
                            height: 20px;
                            border-radius: 4px;
                            margin-bottom: 8px;
                        }

                        .preview-body {
                            display: flex;
                            height: 82px;
                            gap: 8px;
                        }

                        .preview-sidebar {
                            width: 25%;
                            border-radius: 4px;
                        }

                        .preview-content {
                            flex: 1;
                            background: #f8fafc;
                            padding: 8px;
                            border-radius: 4px;
                        }

                        .preview-content span {
                            display: block;
                            height: 10px;
                            margin-bottom: 8px;
                            border-radius: 3px;
                        }


                        /* =========================
                        BLUE
                        ========================= */

                        .theme-blue {
                            background: #f1f5f9;
                        }

                        .theme-blue .preview-header {
                            background: #2563eb;
                        }

                        .theme-blue .preview-sidebar {
                            background: #1e293b;
                        }

                        .theme-blue .preview-content span {
                            background: #2563eb;
                        }


                        /* =========================
                        GREEN
                        ========================= */

                        .theme-green {
                            background: #f0fdf4;
                        }

                        .theme-green .preview-header {
                            background: #059669;
                        }

                        .theme-green .preview-sidebar {
                            background: #111827;
                        }

                        .theme-green .preview-content span {
                            background: #10b981;
                        }


                        /* =========================
                        PURPLE
                        ========================= */

                        .theme-purple {
                            background: #faf5ff;
                        }

                        .theme-purple .preview-header {
                            background: #7c3aed;
                        }

                        .theme-purple .preview-sidebar {
                            background: #312e81;
                        }

                        .theme-purple .preview-content span {
                            background: #8b5cf6;
                        }


                        /* =========================
                        TEMPLATE INFO
                        ========================= */

                        .template-info {

                            padding: 12px 14px;

                            display: flex;

                            justify-content: space-between;

                            align-items: center;
                        }

                        .template-info strong {

                            display: block;

                            font-size: 14px;

                            color: #1f2937;
                        }

                        .template-info small {

                            color: #6b7280;

                            font-size: 11px;
                        }


                        /* Check */

                        .template-check {

                            width: 26px;
                            height: 26px;

                            border-radius: 50%;

                            display: flex;

                            align-items: center;
                            justify-content: center;

                            background: #e5e7eb;

                            color: #fff;

                            font-size: 12px;
                        }

                        .theme-template.active .template-check {

                            background: #0d6efd;

                        }

                        </style>
                        <style>

                        .theme-template {

                            position: relative;

                            background: #fff;

                            border: 2px solid #e5e7eb;

                            border-radius: 16px;

                            overflow: hidden;

                            cursor: pointer;

                            transition: all .25s ease;

                        }


                        .theme-template:hover {

                            transform: translateY(-4px);

                            border-color: #94a3b8;

                            box-shadow: 0 10px 30px rgba(0,0,0,.10);

                        }


                        /* Selected */

                        .theme-template.active {

                            border-color: #2563eb;

                            box-shadow:
                                0 0 0 3px rgba(37,99,235,.15),
                                0 10px 30px rgba(37,99,235,.12);

                        }


                        /* Image Area */

                        .theme-preview {

                            width: 100%;

                            background: #f8fafc;

                            overflow: hidden;

                        }


                        .template-image {

                            width: 100%;

                            display: block;

                            transition: transform .3s ease;

                        }


                        .theme-template:hover .template-image {

                            transform: scale(1.03);

                        }


                        /* Information */

                        .template-info {

                            display: flex;

                            justify-content: space-between;

                            align-items: center;

                            padding: 15px 17px;

                            background: #fff;

                        }


                        .template-info strong {

                            display: block;

                            font-size: 15px;

                            font-weight: 600;

                            color: #1e293b;

                        }


                        .template-info small {

                            display: block;

                            margin-top: 3px;

                            font-size: 12px;

                            color: #64748b;

                        }


                        /* Check Icon */

                        .template-check {

                            width: 32px;

                            height: 32px;

                            border-radius: 50%;

                            display: flex;

                            align-items: center;

                            justify-content: center;

                            background: #e5e7eb;

                            color: transparent;

                            transition: all .25s ease;

                        }


                        .theme-template.active .template-check {

                            background: #2563eb;

                            color: #fff;

                            transform: scale(1.05);

                        }


                        /* Hide Radio */

                        .template-radio {

                            position: absolute;

                            opacity: 0;

                            pointer-events: none;

                        }

                        </style>

                         <hr>

                        <h6 class="h6 mb-0 py-2">
                            <i class="fas fa-palette text-primary me-1"></i>
                            Choose Template
                        </h6>

                        <hr>

                       <div class="row g-3 mb-4">

                        {{-- ================= TEMPLATE 1 ================= --}}
                        <div class="col-lg-3 col-md-6">

                            <label class="w-100 mb-0">

                                <input type="radio"
                                    name="template_status"
                                    value="template1"
                                    class="template-radio"
                                    {{ @$data->template_status == 'template1' ? 'checked' : '' }}>

                                <div class="theme-template
                                    {{ @$data->template_status == 'template1' ? 'active' : '' }}"
                                    data-template="template1">

                                    <div class="theme-preview">

                                        {{-- Template Image --}}
                                        <img src="{{ asset('backend/images/darkness.png') }}"
                                            class="template-image"
                                            alt="Darkness Blue">

                                    </div>

                                    <div class="template-info">

                                        <div>
                                            <strong>Darkness Blue</strong>
                                            <small>Night View</small>
                                        </div>

                                        <span class="template-check">
                                            <i class="fas fa-check"></i>
                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>


                        {{-- ================= TEMPLATE 2 ================= --}}
                        <div class="col-lg-3 col-md-6">

                            <label class="w-100 mb-0">

                                <input type="radio"
                                    name="template_status"
                                    value="template2"
                                    class="template-radio"
                                    {{ @$data->template_status == 'template2' ? 'checked' : '' }}>

                                <div class="theme-template
                                    {{ @$data->template_status == 'template2' ? 'active' : '' }}"
                                    data-template="template2">

                                    <div class="theme-preview">

                                        <img src="{{ asset('backend/images/lightness.png') }}"
                                            class="template-image"
                                            alt="Lightness Standard">

                                    </div>

                                    <div class="template-info">

                                        <div>
                                            <strong>Lightness Standard</strong>
                                            <small>Day View</small>
                                        </div>

                                        <span class="template-check">
                                            <i class="fas fa-check"></i>
                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>


                        {{-- ================= TEMPLATE 3 ================= --}}
                        <div class="col-lg-3 col-md-6">

                            <label class="w-100 mb-0">

                                <input type="radio"
                                    name="template_status"
                                    value="template3"
                                    class="template-radio"
                                    {{ @$data->template_status == 'template3' ? 'checked' : '' }}>

                                <div class="theme-template
                                    {{ @$data->template_status == 'template3' ? 'active' : '' }}"
                                    data-template="template3">

                                    <div class="theme-preview">

                                        <img src="{{ asset('backend/images/colorful.png') }}"
                                            class="template-image"
                                            alt="Colorful Theme">

                                    </div>

                                    <div class="template-info">

                                        <div>
                                            <strong>Colorful Theme</strong>
                                            <small>Color View</small>
                                        </div>

                                        <span class="template-check">
                                            <i class="fas fa-check"></i>
                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>

                         {{-- ================= Custom 4 ================= --}}
                        <div class="col-lg-3 col-md-6">

                            <label class="w-100 mb-0">

                                <input type="radio"
                                    name="template_status"
                                    value="custom"
                                    class="template-radio"
                                    {{ @$data->template_status == 'custom' ? 'checked' : '' }}>

                                <div class="theme-template
                                    {{ @$data->template_status == 'custom' ? 'active' : '' }}"
                                    data-template="custom">

                                    <div class="theme-preview">

                                        <img src="{{ asset('backend/images/custom.png') }}"
                                            class="template-image"
                                            alt="Custom View">

                                    </div>

                                    <div class="template-info">

                                        <div>
                                            <strong>Custom View</strong>
                                            <small>Change color you choice</small>
                                        </div>

                                        <span class="template-check">
                                            <i class="fas fa-check"></i>
                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                        <hr>

                        <h6 class="h6 mb-0 py-2">
                            <i class="fas fa-sliders-h text-primary me-1"></i>
                            Custom Change Color
                        </h6>

                        <hr>


                        <div class="row g-3">

                            {{-- Body Background --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label class="form-label">
                                    <b>Body Background</b>
                                </label>

                                <input type="text"
                                    id="body_bg"
                                    name="body_bg"
                                    class="form-control color"
                                    value="{{ @$data->body_bg }}">
                            </div>


                            {{-- Card Background --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label class="form-label">
                                    <b>Card Background</b>
                                </label>

                                <input type="text"
                                    id="card_bg"
                                    name="card_bg"
                                    class="form-control color"
                                    value="{{ @$data->card_bg }}">
                            </div>


                            {{-- Title Background --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <label class="form-label">
                                    <b>Title Background</b>
                                </label>

                                <input type="text"
                                    id="title_bg"
                                    name="title_bg"
                                    class="form-control color"
                                    value="{{ @$data->title_bg }}">
                            </div>


                            {{-- Primary Color --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Primary Color</b>
                                </label>

                                <input type="text"
                                    id="primary_color"
                                    name="primary_color"
                                    placeholder="Primary Color"
                                    class="form-control color"
                                    value="{{ @$data->primary_color }}">

                            </div>


                            {{-- Secondary Color --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Secondary Color</b>
                                </label>

                                <input type="text"
                                    id="secondary_color"
                                    name="secondary_color"
                                    placeholder="Secondary Color"
                                    class="form-control color"
                                    value="{{ @$data->secondary_color }}">

                            </div>


                            {{-- Primary BG --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Primary Background</b>
                                </label>

                                <input type="text"
                                    id="primary_bg"
                                    name="primary_bg"
                                    class="form-control color"
                                    value="{{ @$data->primary_bg }}">

                            </div>


                            {{-- Secondary BG --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Secondary Background</b>
                                </label>

                                <input type="text"
                                    id="secondary_bg"
                                    name="secondary_bg"
                                    class="form-control color"
                                    value="{{ @$data->secondary_bg }}">

                            </div>


                            {{-- Text 1 --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Text Color 1</b>
                                </label>

                                <input type="text"
                                    id="text1_color"
                                    name="text1_color"
                                    class="form-control color"
                                    value="{{ @$data->text1_color }}">

                            </div>


                            {{-- Text 2 --}}
                            <div class="col-lg-3 col-md-4 col-sm-6">

                                <label class="form-label">
                                    <b>Text Color 2</b>
                                </label>

                                <input type="text"
                                    id="text2_color"
                                    name="text2_color"
                                    class="form-control color"
                                    value="{{ @$data->text2_color }}">

                            </div>

                        </div>




                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('backend/js/jquery.minicolors.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('.color').length) {
                $(".color").each(function() {
                    $(this).minicolors();
                });
            }
        });
    </script>
    <script>

    $(document).ready(function () {

        $('.theme-template').on('click', function () {

            let template = $(this).data('template');

            // Remove selected
            $('.theme-template').removeClass('active');

            // Add selected
            $(this).addClass('active');

            // Select corresponding radio
            $('input[name="template_status"][value="' + template + '"]')
                .prop('checked', true);

        });

    });

    </script>
@endpush
