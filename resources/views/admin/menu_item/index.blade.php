@extends('layouts.admin.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-5 order-lg-last">
            <form action="{{ Route('admin.menu-item.update', $menu->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <h6 class="h6 mb-0 py-1">Edit Menu Item</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @if ($menu->position != 'sidebar')
                                <div class="col-12">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6 class="h6 mb-0 py-1">Pages</h6>
                                            <button class="btn collapse-btn" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#pages_collapse2" aria-expanded="true"
                                                aria-controls="pages_collapse2">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-0 show" class="collapse" id="pages_collapse2">
                                            <div class="p-3">
                                                <ul class="page-list" id="page_list_old">
                                                    @foreach ($pages as $key => $page)
                                                        <li>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                    class="custom-control-input multi_page"
                                                                    id="edit_page{{ $page->id }}" name="page_id[]"
                                                                    value="{{ $page->id }}"
                                                                    {{ in_array($page->id, $page_id) ? 'checked' : '' }}>
                                                                <label for="edit_page{{ $page->id }}"
                                                                    class="custom-control-label ps-2">{{ $page->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="edit_selectAllPage"
                                                        {{ count($page_id) == count($pages) ? 'checked' : '' }}>
                                                    <label class="custom-control-label ps-2"
                                                        for="edit_selectAllPage"><b>Select
                                                            All</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h6 class="h6 mb-0 py-1">Categories</h6>
                                        <button class="btn collapse-btn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#categories_collapse2" aria-expanded="true"
                                            aria-controls="categories_collapse2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-0 show" class="collapse" id="categories_collapse2">
                                        <div class="p-3">
                                            <ul class="category-list" id="category_list_old">
                                                @foreach ($categories as $key => $category)
                                                    <li>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input multi_cat"
                                                                id="edit_cat{{ $category->id }}" name="category_id[]"
                                                                value="{{ $category->id }}"
                                                                {{ in_array($category->id, $categoryData) ? 'checked' : '' }}>
                                                            <label for="edit_cat{{ $category->id }}"
                                                                class="custom-control-label ps-2">{{ $category->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="edit_selectAllCat"
                                                    {{ count($categoryData) == count($categories) ? 'checked' : '' }}>
                                                <label class="custom-control-label ps-2" for="edit_selectAllCat"><b>Select
                                                        All</b></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end px-3 py-2">
                        <button type="submit" class="btn btn-primary btn-sm">Update Menu</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-7">
            <form action="{{ Route('admin.menu-item.serialize', $menu->id) }}" method="POST" id="serialize_form">
                <div class="card">
                    <div class="card-header pe-2 py-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="h6 mb-0">{{ $menu->name }}</h6>
                            <a href="{{ Route('admin.menu.index') }}" class="btn btn-primary btn-sm">Go
                                Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="menu-builder">
                            <div class="dd nestable" id="nestable">
                                <ol class="dd-list">
                                    @foreach ($menu->rootItems as $item)
                                        <li class="dd-item" data-id="{{ $item->id }}">
                                            <div class="dd-handle">{{ @$item->category->name . @$item->page->name }}</div>
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete"
                                                    data-url="{{ Route('admin.menu-item.destroy', $item->id) }}"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </div>
                                            @if (count($item->children) > 0)
                                                <ol class="dd-list">
                                                    @foreach ($item->children as $child)
                                                        <li class="dd-item" data-id="{{ $child->id }}">
                                                            <div class="dd-handle">
                                                                {{ @$child->category->name . @$child->page->name }}</div>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete"
                                                                    data-url="{{ Route('admin.menu-item.destroy', $child->id) }}"><i
                                                                        class="far fa-trash-alt"></i></button>
                                                            </div>
                                                            @if (count($child->children) > 0)
                                                                <ol class="dd-list">
                                                                    @foreach ($child->children as $child)
                                                                        <li class="dd-item"
                                                                            data-id="{{ $child->id }}">
                                                                            <div class="dd-handle">
                                                                                {{ @$child->category->name . @$child->page->name }}
                                                                            </div>
                                                                            <div class="btn-group">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete"
                                                                                    data-url="{{ Route('admin.menu-item.destroy', $child->id) }}"><i
                                                                                        class="far fa-trash-alt"></i></button>
                                                                            </div>
                                                                            @if (count($child->children) > 0)
                                                                                <ol class="dd-list">
                                                                                    @foreach ($child->children as $child)
                                                                                        <li class="dd-item"
                                                                                            data-id="{{ $child->id }}">
                                                                                            <div class="dd-handle">
                                                                                                {{ @$child->category->name . @$child->page->name }}
                                                                                            </div>
                                                                                            <div class="btn-group">
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete"
                                                                                                    data-url="{{ Route('admin.menu-item.destroy', $child->id) }}"><i
                                                                                                        class="far fa-trash-alt"></i></button>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ol>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-3 py-2 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Update Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('backend/js/nestable.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.nestable').nestable({
                maxDepth: {{ $menu->position == 'sidebar' ? 3 : '' }}{{ $menu->position == 'footer' ? 1 : '' }}{{ $menu->position == 'header' ? 4 : '' }}
            });

            $(document).on('submit', '#serialize_form', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let data = JSON.stringify($('.nestable').nestable('serialize'));
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        _method: 'GET',
                        data: data,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                width: "22rem",
                                title: "Success!",
                                text: 'Order Changed Successfull',
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });

            $("#edit_selectAllPage").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_page").prop("checked", true);
                } else {
                    $(".multi_page").prop("checked", false);
                }
            });

            $("#edit_selectAllCat").on("click", function(e) {
                if ($(this).is(":checked")) {
                    $(".multi_cat").prop("checked", true);
                } else {
                    $(".multi_cat").prop("checked", false);
                }
            });

            $(".multi_page").on("click", function(e) {
                $('.multi_page:checked').length == $('.multi_page').length ? $('#edit_selectAllPage')
                    .prop('checked', true) : $('#edit_selectAllPage').prop('checked', false)
            });

            $(".multi_cat").on("click", function(e) {
                $('.multi_cat:checked').length == $('.multi_cat').length ? $('#edit_selectAllCat')
                    .prop('checked', true) : $('#edit_selectAllCat').prop('checked', false)
            });
        });
    </script>
@endpush
