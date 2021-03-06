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
                <h1 class="m-0 text-dark">Sản phẩm theo size</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Thêm mới</button>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-2">
                        <table id="product_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>Thời gian</th>
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
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form role="form" action="javascript:;" method="post" id="createProduct"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input hidden type="text" class="form-control" id="product_id" name="product_id"
                                           value="{{$parent_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kích cỡ</label>
                                    <input type="text" class="form-control" id="size" name="size"
                                           placeholder="Nhập kích cỡ sản phẩm">
                                    <span class="size_error error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity"
                                           placeholder="Nhập số lượng sản phẩm">
                                    <span class="quantity_error error"></span>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button id="close-modal" class="btn btn-default " data-dismiss="modal">Huỷ bỏ
                                    </button>
                                    <button type="submit" class="btn btn-outline-success">Tạo mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form role="form" action="javascript:;" method="post" id="editProduct"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <input hidden type="text" class="form-control" id="edit_id" name="id">
                                </div>
                                <div class="form-group">
                                    <input hidden type="text" class="form-control" id="edit_parent_id" name="parent_id">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kích cỡ</label>
                                    <input type="text" class="form-control" id="edit_size" name="size"
                                           placeholder="Nhập kích cỡ sản phẩm">
                                    <span class="size_error error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" class="form-control" id="edit_quantity" name="quantity"
                                           placeholder="Nhập số lượng sản phẩm">
                                    <span class="quantity_error error"></span>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button id="close-modal" class="btn btn-default " data-dismiss="modal">Huỷ bỏ
                                    </button>
                                    <button type="submit" class="btn btn-outline-success">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var parent_id = {{$parent_id}}
        $('#lfm').filemanager('image');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $("#createProduct").submit(function () {
                let formData = new FormData($('#createProduct')[0]);
                $('.error').text('');
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: "{{route('backend.product.store.quantity', $parent_id)}}",
                    success: function () {
                        $('#product_table').DataTable().ajax.reload();
                        $('#createModal').modal('hide')
                        toastr.success('Thêm mới thành công!')
                        $("#createProduct")[0].reset();
                    },
                    error: function (error) {
                        toastr.error('Có lỗi!')
                        $.each(error.responseJSON.errors, function (key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });
                    }
                });
            });
            $(function () {
                let id = window.location.href;
                var t = $('#product_table').DataTable({
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
                    columnDefs: [ {
                        targets: [ 0, 1, 2, 3 ],
                        render: function ( data, type, row ) {
                            return type === 'display' && data.length > 10 ?
                                data.substr( 0, 10 ) +'…' :
                                data;
                        }
                    } ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{route('backend.products.getquantity', $parent_id)}}',
                        type: "POST",
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'product_id', name: 'product_id'},
                        {data: 'size', name: 'size'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', searchable: false},
                    ],
                });
            });
            $(document).on('click', '#edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "/admin/products/" + id + "/edit-quantity",
                    dataType: "json",
                    success: function (product) {
                        $('#edit_id').val(product.id);
                        $('#edit_parent_id').val(product.parent_id);
                        $('#edit_size').val(product.size);
                        $('#edit_quantity').val(product.quantity);
                    }
                })
            })
            $(document).on('submit', '#editProduct', function () {
                let formData = new FormData($('#editProduct')[0]);
                let id = $('#edit_id').val();
                $('.error').text('');
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: '/admin/products/' + id + "/update-quantity",
                    success: function () {
                        $('#product_table').DataTable().ajax.reload();
                        $('#editModal').modal('hide');
                        $("#editProduct")[0].reset();
                        $('#edit_content').summernote('reset');
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
            $(document).on('click', '#deleteProduct', function () {
                let id = $(this).data("id");
                let token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    title: 'Bạn có chắc chắn không?',
                    text: "Di chuyển vào thùng rác!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chắc chắn!',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'delete',
                            processData: false,
                            contentType: false,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            url: '/admin/products/' + id + "/destroy-quantity",
                            success: function () {
                                $('#product_table').DataTable().ajax.reload();
                                toastr.success('Thành công!')
                            },
                            error: function () {
                                toastr.error('Không thành công xin thử lại!')
                            }
                        });
                    }
                })
            })
        });
    </script>
@endsection
