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
                <h1 class="m-0 text-dark">Danh sách sản phẩm</h1>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-2">
                        <table id="product_deleted_table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá gốc</th>
                                <th>Giá khuyến mãi</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
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
        $(document).ready(function () {
            $('#name').on('input', function () {
                let name = document.getElementById('name').value;
                document.getElementById('slug').value = string_to_slug(name);
            });
            $('#edit_name').on('input', function () {
                let name = document.getElementById('edit_name').value;
                document.getElementById('edit_slug').value = string_to_slug(name);
            });
            $("#image").on('change', function () {
                let image = $("#image").val();
                $("#upload").text(image);
            });

            $("#createProduct").submit(function () {
                let formData = new FormData($('#createProduct')[0]);
                $('.error').text('');
                $.ajax({
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    url: "/admin/products/store",
                    success: function () {
                        $('#product_table').DataTable().ajax.reload();
                        $('#createModal').modal('hide')
                        toastr.success( 'Thêm mới thành công!')
                        $('#content').summernote('reset');
                        $("#createProduct")[0].reset();
                    },
                    error: function (error) {
                        toastr.error( 'Có lỗi!')
                        $.each(error.responseJSON.errors, function (key, value) {
                            $('.' + key + '_error').text(value[0]);
                        });
                    }
                });
            });
            $(function () {
                var t = $('#product_deleted_table').DataTable({
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
                        url: '/admin/products/get-product-deleted',
                        type: "POST",
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'category_id', name: 'category_id'},
                        {data: 'origin_price', name: 'origin_price'},
                        {data: 'sale_price', name: 'sale_price'},
                        {data: 'deleted_at', name: 'deleted_at'},
                        {data: 'status', name: 'status', searchable: false},
                        {data: 'action', name: 'action', searchable: false},
                    ],
                });
            });
            $(document).on('click', '.edit', function () {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: "/admin/products/" + id + "/edit",
                    dataType: "json",
                    success: function (product) {
                        $('#edit_id').val(product.id);
                        $('#edit_name').val(product.name);
                        $('#edit_slug').val(product.slug),
                            $("#edit_category_id option[value=\'" + product.category_id + "\']").attr('selected', 'selected');
                        $('#edit_sale_price').val(product.sale_price);
                        $('#edit_origin_price').val(product.origin_price);
                        $("#edit_content").summernote('code', product.content);
                        $("#edit_status option[value=\'" + product.status + "\']").attr('selected', 'selected');
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
                    url: '/admin/products/' + id,
                    success: function () {
                        $('#product_table').DataTable().ajax.reload();
                        $('#editModal').modal('hide');
                        $("#editProduct")[0].reset();
                        $('#edit_content').summernote('reset');
                        toastr.success( 'Sửa thành công!')
                    },
                    error: function (error) {
                        toastr.error( 'Có lỗi!')
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
                    text: "Xóa sản phẩm này!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chắc chắn!',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'PUT',
                            processData: false,
                            contentType: false,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            url: '/admin/products/' + id,
                            success: function () {
                                $('#product_table').DataTable().ajax.reload();
                                toastr.success( 'Xóa thành công!')
                            },
                            error: function () {
                                toastr.error( 'Không thành công xin thử lại!')
                            }
                        });
                    }
                })
            })
        });
    </script>
@endsection
