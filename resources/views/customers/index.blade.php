@extends('app')
@section('title', 'ข้อมูลลูกค้า')
@section('content')



    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ข้อมูลลูกค้า
                        <button type="button" class="btn bg-gradient-primary" id="Create">
                            <i class="fa fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-outline card-info">
                            <h3 class="card-title">ค้นหา ข้อมูล</h3>

                        </div>
                        <form action="=" method="post" id="searchForm">
                            @csrf
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>ชื่อลูกค้า</label>
                                            <input class="form-control" name="name_customer" type="text" value=""
                                                placeholder="ชื่อลูกค้า">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input class="form-control" name="phone_customer" type="text" value=""
                                                placeholder="เบอร์โทรศัพท์">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>สถานะ</label>
                                            <select id="status" name="status" class="select2" multiple="multiple"
                                                data-placeholder="เลือกสถานะ" style="width: 100%;">
                                                <option value="">ทั้งหมด</option>
                                                <option value="อยู่ระหว่างประสานงาน">อยู่ระหว่างประสานงาน</option>
                                                <option value="อยู่ระหว่างทำแบบ Draft">อยู่ระหว่างทำแบบ Draft</option>
                                                <option value="อยู่ระหว่างเสนอราคา">อยู่ระหว่างเสนอราคา</option>
                                                <option value="พัฒนาแบบ">พัฒนาแบบ</option>
                                                <option value="เสนอแบบ">เสนอแบบ</option>
                                                <option value="เซ็นสัญญาแล้ว">เซ็นสัญญาแล้ว</option>
                                                <option value="ยกเลิก">ยกเลิก</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>เลือกลักษณะงาน</label>
                                            <select name="notify_id" id="notify_id" class="select2" multiple="multiple"
                                                data-placeholder="เลือกลักษณะงาน" style="width: 100%;">
                                                <option value="ทั้งหมด">ทั้งหมด</option>
                                                @foreach ($Notify as $Notifys)
                                                    <option value="{{ $Notifys->id }}">{{ $Notifys->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>เลือกประเภท วันที่</label>
                                            <select name="date_select" id="date_select" class="form-control">
                                                <option value="">ทั้งหมด</option>
                                                <option value="bid_date">วันที่ลูกค้าเข้า</option>
                                                <option value="status_date">วันที่อัพเดทสถานะ</option>
                                                <option value="onsite_date">วันที่เข้าหน้างาน</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>วันที่เริ่มต้น</label>
                                            <input class="form-control datepicker" name="startdate" id="startdate"
                                                type="text" value="" placeholder="วันที่เริ่มต้น">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="ถึงช่วงราคา-group">
                                            <label>ถึงวันที่</label>
                                            <input class="form-control datepicker" name="enddate" id="enddate"
                                                type="text" value="" placeholder="ถึงวันที่">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn bg-gradient-success"><i
                                                    class="fa fa-search"></i>
                                                ค้นหา</button>
                                            <a href="" type="button" class="btn bg-gradient-danger"><i
                                                    class="fa fa-refresh"></i> เคลียร์</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

            <!--Table-->
            <div class="row">
                <div class="col-12">
                    <div class="card card-lightblue">
                        <div class="card-header">
                            <h3 class="card-title">ตารางข้อมูล</h3>

                        </div>

                        <div class="card-body table-responsive">
                            <table id="table" class="table table-hover table-striped text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>วันที่ ลูกค้าเข้า</th>
                                        <th>วันที่ นัดเข้าหน้างาน</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>สถานะ</th>
                                        <th>ลักษณะงาน</th>
                                        <th>สถานที่</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($Customers as $Customer)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="9" class="text-center">ไม่พบข้อมูล</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal เพิ่มข้อมูลพนักงาน-->
            <div class="modal fade" id="modal-create">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เพิ่มข้อมูล ลูกค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="createForm" name="createForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">ชื่อ-สกุล</label>
                                                <input type="text" class="col-md-12 form-control" id="cus_name"
                                                    name="cus_name" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_name_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="col-md-12 form-control" id="tel"
                                                    name="tel" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 tel_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">เลือกลักษณะงาน</label>
                                                <select class="col-md-12 form-control" name="notify_id" id="notify_id">
                                                    <option value="">เลือก</option>
                                                    @foreach ($Notify as $Notifys)
                                                        <option value="{{ $Notifys->id }}">{{ $Notifys->name }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger mt-1 notify_err"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">งบประมาณ</label>
                                                <input type="text" class="col-md-12 form-control" id="budget"
                                                    name="budget" placeholder="" autocomplete="off" onkeyup="this.value = Commas(this.value)">
                                                <p class="text-danger mt-1 budget_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">สถานที่</label>
                                                <input type="text" class="col-md-12 form-control" id="location"
                                                    name="location" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 location_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">ลิงค์ Location</label>
                                                <input type="text" class="col-md-12 form-control" id="maps"
                                                    name="maps" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 maps_err"></p>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">รูปภาพ</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="images"
                                                            name="images" accept=".jpg, .jpeg, .png" multiple>
                                                        <label class="custom-file-label" for="images">Choose
                                                            JPG, PNG</label>
                                                    </div>

                                                </div>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">เอกสารแนบ</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="files"
                                                            name="files" accept=".pdf" multiple>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            PDF</label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="inputEmail3" class="col-form-label">รายละเอียด</label>
                                                <textarea id="summernote" name="detail" class="col-md-12 form-control">
                                                  </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="inputEmail3" class="col-form-label">หมายเหตุ</label>
                                                <input type="text" class="col-md-12 form-control" id="remark"
                                                    name="remark" placeholder="" autocomplete="off">

                                            </div>
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
            <!-- /.modal -->



        </div><!-- /.container-fluid -->
    </section>



@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const telInput = document.getElementById('tel');
            telInput.addEventListener('input', function(e) {
                const value = this.value;
                this.value = value.replace(/[^0-9,]/g, '');
            });
        });

        function Commas(str) {
            // เปลี่ยนทุกคำว่า "," เป็น ""
            str = str.replace(/,/g, "");

            var parts = str.split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
    </script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('#summernote').summernote()

            $('#table').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                "responsive": true
            });


            $('#Create').click(function() {
                $('#savedata').val("create");
                $('#createForm').trigger("reset");
                $('#modal-create').modal('show');
            });

            //savedata
            $('#savedata').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');
                const _token = $("input[name='_token']").val();
                const formData = new FormData($('#createForm')[0]);
                 // รับไฟล์รูปภาพ
                const images = $('#images')[0].files;
                $.each(images, function(index, image) {
                    formData.append('images[]', image);
                });

                // รับไฟล์เอกสาร
                const files = $('#files')[0].files;
                $.each(files, function(index, file) {
                    formData.append('files[]', file);
                });

                $.ajax({

                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('customers.store') }}",
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
                                setTimeout("location.href = '{{ route('customers') }}';",
                                    1500);

                            } else {

                                printErrorMsg(data.error);
                                //console.log(data.error);
                                $('#savedata').html('ลองอีกครั้ง');
                                $('#createForm').trigger("reset");
                                $('.cus_name_err').text(data.error.cus_name);
                                $('.tel_err').text(data.error.tel);
                                $('.notify_err').text(data.error.notify_id);
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
                            $('.code_err').text(response.message);
                            $('.role_type_err').text('');
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

            function printErrorMsg(msg) {
                $.each(msg, function(key, value) {
                    //console.log(key);
                    $('.' + key + '_err').text(value);
                });
            }
        });
    </script>
@endpush
