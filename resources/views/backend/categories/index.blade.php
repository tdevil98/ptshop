@extends('backend.layouts.master')
@section('css')
    <style>
        span.error {
            color: red;
        }
    </style>
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('backdend.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Danh mục</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Thêm mới
            danh mục
        </button>
    </div>
    <br>
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div id="createModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tạo danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="javascript:;" role="form" method="post" id="createCategory">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên danh mục</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Điền tên danh mục ">
                                            <span class="name_error error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Đường dẫn</label>
                                            <input type="text" class="form-control" id="slug" name="slug"
                                                   placeholder="Điền đường dẫn danh mục">
                                            <span class="slug_error error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Danh mục cha</label>
                                            <select class="form-control select2" style="width: 100%;" name="parent_id"
                                                    id="parent_id">
                                                <option value="">--Chọn danh mục---</option>
                                                @foreach($categories as $category)
                                                    @if($category->parent_id == 0)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="parent_id_error error"></span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="" class="btn btn-default" data-dismiss="modal">Huỷ bỏ
                                        </button>
                                        <button type="submit" class="btn btn-outline-success">Tạo mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="editModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Chỉnh sửa danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="javascript:;" role="form" method="post" id="editCategory">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ID danh mục</label>
                                            <input type="text" readonly class="form-control" id="edit_id" name="id"
                                                   placeholder="Điền tên danh mục ">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên danh mục</label>
                                            <input type="text" class="form-control" id="edit_name" name="name"
                                                   placeholder="Điền tên danh mục ">
                                            <span class="edit_name_error error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Đường dẫn</label>
                                            <input type="text" class="form-control" id="edit_slug" name="slug"
                                                   placeholder="Điền đường dẫn danh mục">
                                            <span class="edit_slug_error error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Danh mục cha</label>
                                            <select class="form-control select2" style="width: 100%;" name="parent_id"
                                                    id="edit_parent_id">
                                                <option value="">--Chọn danh mục---</option>
                                                @foreach($categories as $category)
                                                    @if($category->parent_id == 0)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="edit_parent_id_error error"></span>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="" class="btn btn-default" data-dismiss="modal">Huỷ bỏ
                                        </button>
                                        <button type="submit" class="btn btn-outline-success">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-2">
                        <table id="categories_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Đường dẫn</th>
                                <th>Người tạo</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#edit_name').on('input', function () {
            let name = document.getElementById('edit_name').value;
            document.getElementById('edit_slug').value = string_to_slug(name);
        })
        $('#name').on('input', function () {
            let name = document.getElementById('name').value;
            document.getElementById('slug').value = string_to_slug(name);
        })
        $(function () {
            var t = $('#categories_table').DataTable({
                "language": {
                    processing: "Đang xử lý...",
                    search: "Tìm kiếm: &nbsp;:",
                    lengthMenu: "Xem _MENU_ mục",
                    info: "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    infoEmpty: "Đang xem 0 đến 0 trong tổng số 0 mục",
                    infoFiltered: "(được lọc từ _MAX_ mục)",
                    infoPostFix: "",
                    loadingRecords: "Đang tải...",
                    zeroRecords: "Không tìm thấy dòng nào phù hợp",
                    emptyTable: "Không có dữ liệu trong bảng",
                    paginate: {
                        first: "Đầu",
                        previous: "Trước",
                        next: "Tiếp",
                        last: "Cuối"
                    },
                    aria: {
                        sortAscending: ": Sắp xếp cột theo thứ tự tăng dần",
                        sortDescending: ": Sắp xếp cột theo thứ tự giảm dần"
                    }
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('backend.category.getdata')}}',
                    type: "POST",
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', searchable: false}
                ],
            });
        });
        $('#createCategory').on('submit', function () {
            let formData = new FormData($('#createCategory')[0]);
            $('.error').text('');
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                url: "{{route('backend.category.store')}}",
                success: function () {
                    $('#categories_table').DataTable().ajax.reload();
                    $('#createModal').modal('hide')
                    toastr.success('Thêm mới thành công!')
                    $('#content').summernote('reset');
                    $("#createCategory")[0].reset();
                },
                error: function (error) {
                    toastr.error('Có lỗi!')
                    $.each(error.responseJSON.errors, function (key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });
                }
            });
        });
        $(document).on('click', '.edit', function () {
            let id = $(this).attr('data-id');
            $.ajax({
                url: "/admin/categories/" + id + "/edit",
                dataType: "json",
                success: function (categories) {
                    console.log(categories.parent_id);
                    $('#edit_id').val(categories.id);
                    $('#edit_name').val(categories.name);
                    $('#edit_slug').val(categories.slug),
                        $("#edit_parent_id option[value=\'" + categories.parent_id + "\']").attr('selected', 'selected');
                }
            })
        });
        $(document).on('submit', '#editCategory', function () {
            let formData = new FormData($('#editCategory')[0]);
            let id = $('#edit_id').val();
            $('.error').text('');
            $.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                url: '/admin/categories/' + id,
                success: function () {
                    $('#categories_table').DataTable().ajax.reload();
                    $('#editModal').modal('hide');
                    $("#editCategory")[0].reset();
                    toastr.success('Sửa thành công!')
                },
                error: function (error) {
                    toastr.error('Có lỗi!')
                    $.each(error.responseJSON.errors, function (key, value) {
                        $('.edit_' + key + '_error').text(value[0]);
                    });
                }
            });
        });
        $(document).on('click', '#deleteCategory', function () {
            let id = $(this).data("id");
            let token = $("meta[name='csrf-token']").attr("content");
            Swal.fire({
                title: 'Bạn có chắc chắn không?',
                text: "Xóa sản phẩm này!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Chắc chắn!',
                cancelButtonText: 'Không'
            }).then((result) => {
                console.log(token);
                if (result.value) {
                    $.ajax({
                        type: 'PUT',
                        processData: false,
                        contentType: false,
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        url: '/admin/categories/' + id,
                        success: function () {
                            $('#categories_table').DataTable().ajax.reload();
                            toastr.success( 'Xóa thành công!')
                        },
                        error: function () {
                            toastr.error( 'Không thành công xin thử lại!')
                        }
                    });
                }
            })
        })
    </script>
@endsection
