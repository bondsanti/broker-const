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
                                            <input class="form-control" name="user_name" type="text" value=""
                                                placeholder="ชื่อลูกค้า">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input class="form-control" name="phone" type="text" value=""
                                                placeholder="เบอร์โทรศัพท์">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>สถานะ</label>
                                            <select class="select2" multiple="multiple" data-placeholder="เลือกสถานะ" style="width: 100%;">
                                                <option value="" selected>ทั้งหมด</option>
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
                                            <label>ลักษณะงาน</label>
                                            <select class="select2" multiple="multiple" data-placeholder="เลือกลักษณะงาน" style="width: 100%;">
                                                <option>Text only</option>
                                                <option>Images</option>
                                                <option>Video</option>
                                                <option value="" selected>ทั้งหมด</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>เลือกประเภท วันที่</label>
                                            <select name="dateselect" id="dateselect" class="form-control">
                                                <option value="bid_date">วันที่ลูกค้าเข้า</option>
                                                <option value="mortgaged_date">วันที่อัพเดทสถานะ</option>
                                                <option value="booking_date">วันที่เข้าหน้างาน</option>
                                                <option value="" selected>ทั้งหมด</option>

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
                                            <a href="" type="button"
                                                class="btn bg-gradient-danger"><i class="fa fa-refresh"></i> เคลียร์</a>
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
                    <div class="card">
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>





        </div><!-- /.container-fluid -->
    </section>



@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2()

            $('#table').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                "responsive": true
            });



        });
    </script>
@endpush
