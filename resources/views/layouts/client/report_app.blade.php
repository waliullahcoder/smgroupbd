<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $admin_setting ? $admin_setting->title : '' }}</title>
    <link rel="shortcut icon"
        href="{{ $admin_setting && file_exists($admin_setting->favicon) ? asset($admin_setting->favicon) : asset('backend/images/logo/favicon.png') }}"
        type="image/x-icon">
    @include('layouts.admin.partial.styles')
    @include('layouts.admin.partial.alert')
    <style>
        :root {
            --bs-primary: {{ $admin_setting && $admin_setting->primary_color ? $admin_setting->primary_color : '#3753e9' }};
            --bs-secondary: {{ $admin_setting && $admin_setting->secondary_color ? $admin_setting->secondary_color : '#415FFF' }};
        }
    </style>
</head>

<body class="bg-light">
    <div class="overflow-hidden site-wrapper @if (Session::has('sidebar-collapse')) session-sidebar @endif">
        @include('layouts.admin.partial.sidebar')

        <div class="content-wrapper">
            @include('layouts.admin.partial.header')
            <div class="content">
                <div class="p-sm-4 p-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <form action="{{ isset($filter_link) ? $filter_link : '#' }}"
                                id="{{ isset($filter_link) ? '' : 'filter_form' }}" method="GET">
                                <div class="card">
                                    <div class="card-body">
                                        @yield('form')
                                    </div>
                                    <div class="card-footer p-2 gap-2 d-flex justify-content-end align-items-center">
                                        @if (isset($buttons))
                                            {!! $buttons !!}
                                        @else
                                            <button type="submit" class="btn btn-sm btn-primary text-uppercase"
                                                id="filter_btn">Search</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pe-2 py-2">
                                    <h6 class="h6 mb-0 text-uppercase py-1">{{ isset($title) ? $title : 'Please Set Title' }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.admin.partial.footer')
        </div>
    </div>
    <!-- End Site Wrapper -->

    @include('sweetalert::alert')
    @include('layouts.admin.partial.scripts')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(document).on('submit', '#filter_form', function(e) {
                e.preventDefault();
                $('.dataTable').DataTable().ajax.reload();
            });
        });
    </script>
    @stack('js')
</body>

</html>
