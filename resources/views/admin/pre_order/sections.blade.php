@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header pe-2 py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="h6 mb-0 text-uppercase py-5px">{{ @$title ?? 'Please Set Title' }}</h6>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ Route('admin.pre-order.index') }}" class="btn btn-primary btn-sm">Go Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-xl-4">
                    <table class="table align-middle" style="width:100%">
                        <thead class="bg-primary text-white">
                            <tr class="text-nowrap">
                                <th width="3"></th>
                                <th>Title</th>
                                <th>Type</th>
                                <th width="110" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->sections as $row)
                                <tr id="row_{{ $row->id }}">
                                    <td class="text-center" width="30">{{ $loop->iteration }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->type }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ Route('admin.pre-order-section.edit', $row->id) }}"
                                                class="btn btn-sm btn-warning border-0 px-10px tt link-edit"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Edit" aria-label="Edit"><i
                                                    class="far fa-pencil-alt"></i></a>
                                            <button type="button"
                                                class="btn btn-sm border-0 px-10px btn-danger tt delete_btn"
                                                data-id="{{ $row->id }}"
                                                data-url="{{ Route('admin.pre-order-section.destroy', $row->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Delete" aria-label="Delete"><i
                                                    class="far fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-8">
                    <form action="{{ Route('admin.pre-order-section.store-update', $data->id) }}" method="POST"
                        id="section_form" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="POST">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="h6 mb-0 text-uppercase">Add Section</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="type" class="form-label"><b>Type</b></label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="image_list">List & Image</option>
                                            <option value="list">List Only</option>
                                            <option value="video">Video</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="title" class="form-label"><b>Title</b></label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Title">
                                    </div>
                                    <div class="col-12" id="list_area">
                                        <label for="list" class="form-label"><b>List</b></label>
                                        <input type="text" class="form-control" id="list" name="list[]"
                                            value="{{ old('list') }}" placeholder="List">
                                    </div>
                                    <div class="col-12" id="image_area">
                                        <label for="image" class="form-label"><b>Image</b></label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            accept="image/*">
                                    </div>
                                    <div class="col-12" id="video_area" style="display: none;">
                                        <label for="video_link" class="form-label"><b>Video ID</b></label>
                                        <input type="text" name="video_link" id="video_link" class="form-control"
                                            placeholder="Video ID (Youtube)">
                                    </div>
                                    <div class="col-12">
                                        <label for="description" class="form-label"><b>Description</b></label>
                                        <textarea name="description" id="description" class="form-control description" cols="30" rows="5"
                                            placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="button" class="btn btn-primary btn-sm btn-danger" id="cancel_btn"
                                    style="display: none;">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        var input = document.querySelector('#list');
        var tagify = new Tagify(input, {
            delimiters: "`",
        });

        $(document).ready(function() {
            $(document).on('change', '#type', function(e) {
                change();
            });

            $(document).on('click', '#cancel_btn', function(e) {
                $(this).hide();
                $('#section_form')[0].reset();
                $('input[name="_method"]').val('POST');
                $('input[name="id"]').val('');
                $('#title').val('');
                $('#list').val('');
                $('#video_link').val('');
                $('#description').val('');
                $('button[type="submit"]').text('Save');
                $('#description').summernote('destroy');

                // Reinitialize Summernote
                $('#description').summernote({
                    placeholder: 'Write here..',
                    height: 300,
                    styleTags: [
                        'p',
                        {
                            title: 'Blockquote',
                            tag: 'blockquote',
                            className: 'blockquote',
                            value: 'blockquote'
                        },
                        'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                    ],
                    prettifyHtml: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline',
                            'add-text-tags', 'highlight', 'clear'
                        ]],
                        ['font', ['strikethrough', 'superscript',
                            'subscript'
                        ]],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture',
                            'videoAttributes'
                        ]],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                    imageAttributes: {
                        icon: '<i class="note-icon-pencil"/>',
                        figureClass: 'figureClass',
                        figcaptionClass: 'captionClass',
                        captionText: 'Caption Goes Here.',
                        manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
                    },
                    lang: 'en-US',
                    popover: {
                        image: [
                            ['imagesize', ['imageSize100',
                                'imageSize50', 'imageSize25'
                            ]],
                            ['float', ['floatLeft', 'floatRight',
                                'floatNone'
                            ]],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageAttributes']],
                        ],
                    },
                });
            });

            $(document).on('click', '.link-edit', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    data: {
                        _method: 'GET',
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $('#cancel_btn').show();
                            $('input[name="_method"]').val('PUT');
                            $('input[name="id"]').val(response.data.id);
                            $('#type').val(response.data.type);
                            $('#title').val(response.data.title);
                            $('#list').val(response.list);
                            $('#video_link').val(response.data.video_link);
                            $('#description').val(response.data.description);
                            $('#description').summernote('destroy');
                            $('button[type="submit"]').text('Update');

                            // Reinitialize Summernote
                            $('#description').summernote({
                                placeholder: 'Write here..',
                                height: 300,
                                styleTags: [
                                    'p',
                                    {
                                        title: 'Blockquote',
                                        tag: 'blockquote',
                                        className: 'blockquote',
                                        value: 'blockquote'
                                    },
                                    'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                                ],
                                prettifyHtml: true,
                                toolbar: [
                                    ['style', ['style']],
                                    ['font', ['bold', 'italic', 'underline',
                                        'add-text-tags', 'highlight', 'clear'
                                    ]],
                                    ['font', ['strikethrough', 'superscript',
                                        'subscript'
                                    ]],
                                    ['fontsize', ['fontsize']],
                                    ['color', ['color']],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['table', ['table']],
                                    ['insert', ['link', 'picture',
                                        'videoAttributes'
                                    ]],
                                    ['view', ['fullscreen', 'codeview', 'help']],
                                ],
                                imageAttributes: {
                                    icon: '<i class="note-icon-pencil"/>',
                                    figureClass: 'figureClass',
                                    figcaptionClass: 'captionClass',
                                    captionText: 'Caption Goes Here.',
                                    manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
                                },
                                lang: 'en-US',
                                popover: {
                                    image: [
                                        ['imagesize', ['imageSize100',
                                            'imageSize50', 'imageSize25'
                                        ]],
                                        ['float', ['floatLeft', 'floatRight',
                                            'floatNone'
                                        ]],
                                        ['remove', ['removeMedia']],
                                        ['custom', ['imageAttributes']],
                                    ],
                                },
                            });
                            change();
                        }
                    }
                });
            });

            $(document).on('click', '.delete_btn', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    $('#row_' + id).remove();
                                }
                            }
                        });
                    } else(
                        result.dismiss === Swal.DismissReason.cancel
                    )
                });
            });
        });

        function change() {
            var type = $('#type').val();
            if (type == 'image_list') {
                $('#video_area').hide();
                // $('#video_link').val('');
                $('#image_area').show();
                $('#list_area').show();
            }
            if (type == 'list') {
                $('#video_area').hide();
                $('#image_area').hide();
                $('#list_area').show();
                // $('#image').val('');
            }
            if (type == 'video') {
                $('#video_area').show();
                $('#image_area').hide();
                $('#list_area').hide();
                // $('#list').val('');
                // $('#image').val('');
            }
        }
    </script>
@endpush
