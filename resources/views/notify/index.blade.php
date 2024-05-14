@extends('app')
@section('title', 'แจ้งเตือน')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แจ้งเตือน

                    </h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-lightblue">
                        <div class="card-header">

                            <h3 class="card-title">ลักษณะงาน</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm bg-gradient-success" id="Create">
                                    <i class="fas fa-plus"></i> เพิ่มข้อมูล
                                </button>

                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">#</th>
                                        <th>ลักษณะงาน</th>
                                        <th width="20%">SLA (วัน)</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($Notify as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sla }}</td>
                                            <td>
                                                <button class="btn bg-gradient-info btn-sm edit-item"
                                                    data-id="{{ $item->id }}" title="แก้ไข">
                                                    <i class="fa fa-pencil-square"></i>
                                                </button>
                                                <button class="btn bg-gradient-danger btn-sm delete-item"
                                                    data-id="{{ $item->id }}" title="ลบ">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">ไม่พบข้อมูล</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-lightblue">
                        <div class="card-header">

                            <h3 class="card-title">ระบุอีเมล์ที่ต้องการแจ้งเตือน</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm bg-gradient-success" id="Create2">
                                    <i class="fas fa-plus"></i> เพิ่มข้อมูล
                                </button>

                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr class="text-center">
                                        <th  width="20%">#</th>
                                        <th>อีเมล์</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($Emails as $email)
                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $email->email }}</td>
                                            <td>
                                                <input type="checkbox" name="my-checkbox" data-id="{{ $email->id }}"
                                                    @if ($email->active) checked @endif data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success">
                                            </td>
                                            <td>
                                                <button class="btn bg-gradient-info btn-sm edit-email-item"
                                                    data-id="{{ $email->id }}" title="แก้ไข">
                                                    <i class="fa fa-pencil-square"></i>
                                                </button>
                                                <button class="btn bg-gradient-danger btn-sm delete-email-item"
                                                    data-id="{{ $email->id }}" title="ลบ">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




            <!-- modal เพิ่มข้อมูล-->
            <div class="modal fade" id="modal-create">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เพิ่มข้อมูล ลักษณะงาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="createForm" name="createForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $dataLoginUser->id }}"> --}}
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="inputEmail3" class="col-form-label">ลักษณะงาน</label>
                                            <input type="text" class="col-md-12 form-control" id="name"
                                                name="name" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 name_err"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="type" class="col-form-label">ระบุ SLA (วัน) </label>
                                            <input type="text" class="col-md-12 form-control" id="sla"
                                                name="sla" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 sla_err"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> ยกเลิก</button>
                                <button type="button" class="btn bg-gradient-success" id="savedata" value="create"><i
                                        class="fa fa-save"></i> บันทึก</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- modal Email -->
            <div class="modal fade" id="modal-email">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เพิ่มข้อมูล อีเมล์</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="createEmail" name="createEmail" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $dataLoginUser->id }}"> --}}
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="inputEmail3" class="col-form-label">ระบุอีเมล์</label>
                                            <input type="email" class="col-md-12 form-control" id="email"
                                                name="email" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 email_err"></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> ยกเลิก</button>
                                <button type="button" class="btn bg-gradient-success" id="savedata2" value="create2"><i
                                        class="fa fa-save"></i> บันทึก</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>



            <!-- modal Edit SLA -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <font color="red">แก้ไขข้อมูล</font> ลักษณะงาน
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editForm" name="editForm" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="id_edit" id="id_edit">
                            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $dataLoginUser->id }}"> --}}
                            @csrf
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="inputEmail3" class="col-form-label">ลักษณะงาน</label>
                                            <input type="text" class="col-md-12 form-control" id="name_edit"
                                                name="name_edit" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 name_edit_err"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="type" class="col-form-label">ระบุ SLA (วัน) </label>
                                            <input type="text" class="col-md-12 form-control" id="sla_edit"
                                                name="sla_edit" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 sla_edit_err"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> ยกเลิก</button>
                                <button type="button" class="btn bg-gradient-success" id="updatedata" value="update"><i
                                        class="fa fa-save"></i> อัพเดท</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


            <!-- modal Edit Email -->
            <div class="modal fade" id="modal-edit-email">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <font color="red">แก้ไขข้อมูล</font> อีเมล์
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editEmail" name="editEmail" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ $dataLoginUser->id }}"> --}}
                            <input type="hidden" name="id_email_edit" id="id_email_edit">
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="inputEmail3" class="col-form-label">ระบุอีเมล์</label>
                                            <input type="email" class="col-md-12 form-control" id="email_edit"
                                                name="email_edit" placeholder="" autocomplete="off">
                                            <p class="text-danger mt-1 email_edit_err"></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> ยกเลิก</button>
                                <button type="button" class="btn bg-gradient-success" id="updatedata2"
                                    value="update2"><i class="fa fa-save"></i> อัพเดท</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>




        </div><!-- /.container-fluid -->
    </section>



@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {

            $('#Create').click(function() {
                $('#savedata').val("create");
                $('#createForm').trigger("reset");
                $('#modal-create').modal('show');
            });

            $('#Create2').click(function() {
                $('#savedata2').val("create2");
                $('#createEmail').trigger("reset");
                $('#modal-email').modal('show');
            });



            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            //update on/off Email Active

            $('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
                var emailId = $(this).data('id');
                var activeStatus = state ? 1 : 0;

                $.ajax({
                    url: "{{ route('notify.updateStatusEmail') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: emailId,
                        active: activeStatus
                    },
                    success: function(data) {
                        //console.log(data);
                        if (data.success = true) {

                            if ($.isEmptyObject(data.error)) {
                                Swal.fire({

                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });

                                setTimeout("location.href = '{{ route('notify') }}';",
                                    1500);
                            } else {



                            }

                        }
                    },
                    error: function() {
                        console.log('AJAX error');
                    }
                });
            });


            //Delete SLA
            $('body').on('click', '.delete-item', function() {

                const id = $(this).data("id");
                //console.log(id);

                Swal.fire({
                    title: 'คุณแน่ใจไหม? ',
                    text: "หากต้องการลบข้อมูลนี้ โปรดยืนยัน การลบข้อมูล",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonText: 'ยืนยัน'
                }).then((result) => {

                    if (result.isConfirmed) {
                        const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: "DELETE",
                            url: '/notify/' + id,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // ส่งค่า CSRF token ใน HTTP headers
                            },
                            success: function(data) {
                                //tableUser.draw();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });

                                setTimeout(
                                    "location.href = '{{ route('notify') }}';",
                                    1500);

                            },
                            statusCode: {
                                400: function() {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'error',
                                        title: 'ไม่สามารถลบได้ ต้อง Disable เท่านั้น',
                                        showConfirmButton: true,
                                        timer: 2500
                                    });
                                }
                            }

                        });

                    }
                });

            });

            //savedata SLA
            $('#savedata').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');
                const _token = $("input[name='_token']").val();
                const formData = new FormData($('#createForm')[0]);

                $.ajax({

                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('notify.store') }}",
                    type: "POST",
                    dataType: "json",

                    success: function(data) {

                        if (data.success = true) {
                            if ($.isEmptyObject(data.error)) {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                $('#createForm')[0].reset();
                                $('#modal-create').modal('hide');
                                // table.draw();
                                setTimeout("location.href = '{{ route('notify') }}';",
                                    1500);

                            } else {

                                printErrorMsg(data.error);
                                //console.log(data.error);
                                $('#savedata').html('ลองอีกครั้ง');
                                // $('#createForm').trigger("reset");
                                $('.name_err').text(data.error.name);
                                $('.sla_err').text(data.error.sla);
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'warning',
                                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                                    html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                            }

                        }
                    },

                    statusCode: {
                        500: function(xhr) {
                            const response = xhr.responseJSON;
                            //console.log(response.error.code);
                            $('#savedata').html('ลองอีกครั้ง');
                            $('.name_err').text(response.message);
                            $('.sla_err').text('');
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                html: response.message,
                                showConfirmButton: true,
                                timer: 2000
                            });

                            printErrorMsg(response.message);
                        }
                    }
                });
            });

            //showedit SLA
            $('body').on('click', '.edit-item', function() {

                const id = $(this).data('id');
                //console.log(id);
                $('#modal-edit').modal('show');
                $.get('notify/' + id, function(data) {
                    //console.log(data);
                    $('#id_edit').val(data.id);
                    $('#name_edit').val(data.name);
                    $('#sla_edit').val(data.sla);

                });


            });

            //update SLA
            $('#updatedata').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');
                const _token = $("input[name='_token']").val();
                const formData = new FormData($('#editForm')[0]);

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "/notify/update",
                    type: "POST",
                    dataType: 'json',

                    success: function(data) {
                        //console.log(data);
                        if (data.success = true) {

                            if ($.isEmptyObject(data.error)) {
                                Swal.fire({

                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                //$('#modal-edit').trigger("reset");
                                $('#editForm')[0].reset();
                                $('#modal-edit').modal('hide');
                                //tableUser.draw();
                                setTimeout("location.href = '{{ route('notify') }}';",
                                    1500);
                            } else {
                                printErrorMsg(data.error);
                                $('#update').html('ลองอีกครั้ง');
                                $('#editForm').trigger("reset");
                                $('.name_edit_err').text(data.error.name);
                                $('.sla_edit_err').text(data.error.sla);

                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'warning',
                                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                                    html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                            }

                        }
                    },

                    statusCode: {
                        400: function(xhr) {
                            const response = xhr.responseJSON;
                            //console.log(response.error.code);
                            $('#savedata').html('ลองอีกครั้ง');
                            $('.name_edit_err').text(response.message);
                            $('.sla_edit_err').text('');
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                html: response.message,
                                showConfirmButton: true,
                                timer: 2000
                            });

                            printErrorMsg(response.message);
                        }
                    }

                });
            });

            //savedata2 Email
            $('#savedata2').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');
                const _token = $("input[name='_token']").val();
                const formData = new FormData($('#createEmail')[0]);

                $.ajax({

                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('notify.storeEmail') }}",
                    type: "POST",
                    dataType: "json",

                    success: function(data) {

                        if (data.success = true) {
                            if ($.isEmptyObject(data.error)) {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                $('#createEmail')[0].reset();
                                $('#modal-email').modal('hide');
                                // table.draw();
                                setTimeout("location.href = '{{ route('notify') }}';",
                                    1500);

                            } else {

                                printErrorMsg(data.error);
                                //console.log(data.error);
                                $('#savedata2').html('ลองอีกครั้ง');
                                // $('#createForm').trigger("reset");
                                $('.email_err').text(data.error.email);
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'warning',
                                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                                    html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                            }

                        }
                    },

                    statusCode: {
                        500: function(xhr) {
                            const response = xhr.responseJSON;
                            //console.log(response.error.code);
                            $('#savedata2').html('ลองอีกครั้ง');
                            $('.email_err').text(response.message);
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                html: response.message,
                                showConfirmButton: true,
                                timer: 2000
                            });

                            printErrorMsg(response.message);
                        }
                    }
                });
            });

            //showedit Email
            $('body').on('click', '.edit-email-item', function() {

                const id = $(this).data('id');
                //console.log(id);
                $('#modal-edit-email').modal('show');
                $.get('notify/email/' + id, function(data) {
                    //console.log(data);
                    $('#id_email_edit').val(data.id);
                    $('#email_edit').val(data.email);
                });


            });


            //update Email
            $('#updatedata2').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');
                const _token = $("input[name='_token']").val();
                const formData = new FormData($('#editEmail')[0]);

                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('notify.updateEmail') }}",
                    type: "POST",
                    dataType: 'json',

                    success: function(data) {
                        //console.log(data);
                        if (data.success = true) {

                            if ($.isEmptyObject(data.error)) {
                                Swal.fire({

                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });
                                //$('#modal-edit').trigger("reset");
                                $('#editEmail')[0].reset();
                                $('#modal-edit-email').modal('hide');
                                //tableUser.draw();
                                setTimeout("location.href = '{{ route('notify') }}';",
                                    1500);
                            } else {
                                printErrorMsg(data.error);
                                $('#update').html('ลองอีกครั้ง');
                                $('#editEmail').trigger("reset");
                                $('.email_edit_err').text(data.error.email);

                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'warning',
                                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                                    html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                    showConfirmButton: true,
                                    timer: 2000
                                });
                            }

                        }
                    },

                    statusCode: {
                        400: function(xhr) {
                            const response = xhr.responseJSON;
                            //console.log(response.error.code);
                            $('#updatedata2').html('ลองอีกครั้ง');
                            $('.email_edit_err').text(response.message);
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                html: response.message,
                                showConfirmButton: true,
                                timer: 2000
                            });

                            printErrorMsg(response.message);
                        }
                    }

                });
            });

            //Delete Email
            $('body').on('click', '.delete-email-item', function() {

                const id = $(this).data("id");
                //console.log(id);

                Swal.fire({
                    title: 'คุณแน่ใจไหม? ',
                    text: "หากต้องการลบข้อมูลนี้ โปรดยืนยัน การลบข้อมูล",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonText: 'ยืนยัน'
                }).then((result) => {

                    if (result.isConfirmed) {
                        const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: "DELETE",
                            url: '/notify/email/' + id,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // ส่งค่า CSRF token ใน HTTP headers
                            },
                            success: function(data) {
                                //tableUser.draw();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });

                                setTimeout(
                                    "location.href = '{{ route('notify') }}';",
                                    1500);

                            },
                            statusCode: {
                                400: function() {
                                    // Swal.fire({
                                    //     position: 'top-center',
                                    //     icon: 'error',
                                    //     title: '',
                                    //     showConfirmButton: true,
                                    //     timer: 2500
                                    // });
                                }
                            }

                        });

                    }
                });

            });



            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    //console.log(key);
                    $('.' + key + '_err').text(value);
                });
            }



        });
    </script>
@endpush
