@extends('app')
@section('title', 'ข้อมูลลูกค้า')
@section('content')
@push('style')
<style>
    .img-wrapper {
        position: relative;
        display: inline-block;
    }
    .btn-tool {
        position: absolute;
        top: 5px;
        right: 5px;
        color: red;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        padding: 5px;
    }
    .btn-tool:hover {
        color: darkred;
    }
    .img-fluid {
        display: block;
        max-width: 100%;
        height: auto;
    }
</style>
@endpush

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
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>วันที่ ลูกค้าเข้า</th>
                                        <th>วันที่ นัดเข้าหน้างาน</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>สถานะ</th>
                                        <th>ลักษณะงาน</th>
                                        <th>สถานที่</th>
                                        <th>งบประมาณ</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Customers as $Customer)
                                        <tr class="text-center">
                                            <td width="5%">{{ $loop->index + 1 }}</td>
                                            <td>{{ $Customer->cus_no }}</td>
                                            <td></td>
                                            <td>{{ $Customer->onsite_date }}</td>
                                            <td>{{ $Customer->cus_name }}</td>
                                            <td>{{ $Customer->status }}</td>
                                            <td>{{ optional($Customer->notify_ref)->name }}</td>
                                            <td>{{ $Customer->location }}</td>
                                            <td>{{ number_format($Customer->budget) }}</td>
                                            <td width="15%" class="text-center">
                                                <button class="btn bg-gradient-primary btn-sm" title="รายละเอียด">
                                                    <i class="fa fa-circle-info">
                                                    </i>

                                                </button>
                                                <a href="{{ $Customer->maps }}" target="_blank"
                                                    class="btn bg-gradient-success btn-sm" title="โลเคชั่น">
                                                    <i class="fa fa-location-dot">
                                                    </i>

                                                </a>

                                                <button class="btn bg-gradient-info btn-sm edit-item"
                                                    data-id="{{ $Customer->id }}" title="แก้ไข">
                                                    <i class="fa fa-pen-to-square">
                                                    </i>

                                                </button>
                                                <button class="btn bg-gradient-danger btn-sm delete-item"
                                                    data-id="{{ $Customer->id }}" title="ลบ">
                                                    <i class="fa fa-trash">
                                                    </i>
                                                </button>

                                            </td>
                                        </tr>
                                        {{-- @empty
                                        <tr class="text-center">
                                            <td colspan="9" class="text-center">ไม่พบข้อมูล</td>
                                        </tr>
                                    @endforelse --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal เพิ่มข้อมูล-->
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
                                                    name="budget" placeholder="" autocomplete="off"
                                                    onkeyup="this.value = Commas(this.value)">
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

                                                <p class="text-danger mt-1">สามารถเลือกได้หลายรูป</p>
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
                                                <p class="text-danger mt-1">สามารถเลือกได้หลายไฟล์</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่ลูกค้าเข้า</label>

                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="cus_date" name="cus_date" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_date_err"></p>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่นัดเข้างาน</label>
                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="onsite_date" name="onsite_date" placeholder=""
                                                    autocomplete="off">
                                                <p class="text-danger mt-1 onsite_date_err"></p>
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

            <!-- modal แก้ไขข้อมูล-->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <font color="red">แก้ไขข้อมูล</font> ลูกค้า
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editForm" name="editForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_edit" id="id_edit">
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">ชื่อ-สกุล</label>
                                                <input type="text" class="col-md-12 form-control" id="cus_name_edit"
                                                    name="cus_name_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_name_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="col-md-12 form-control" id="tel_edit"
                                                    name="tel_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 tel_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">เลือกลักษณะงาน</label>
                                                <select class="col-md-12 form-control" name="notify_id_edit"
                                                    id="notify_id_edit">
                                                    <option value="">เลือก</option>
                                                    @foreach ($Notify as $Notifys)
                                                        <option value="{{ $Notifys->id }}">{{ $Notifys->name }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger mt-1 notify_edit_err"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">งบประมาณ</label>
                                                <input type="text" class="col-md-12 form-control" id="budget_edit"
                                                    name="budget_edit" placeholder="" autocomplete="off"
                                                    onkeyup="this.value = Commas(this.value)">
                                                <p class="text-danger mt-1 budget_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">สถานที่</label>
                                                <input type="text" class="col-md-12 form-control" id="location_edit"
                                                    name="location_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 location_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label">ลิงค์ Location</label>
                                                <input type="text" class="col-md-12 form-control" id="maps_edit"
                                                    name="maps_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 maps_edit_err"></p>

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

                                                <p class="text-danger mt-1">สามารถเลือกได้หลายรูป</p>
                                                <div class="row" id="image-container">

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
                                                <p class="text-danger mt-1">สามารถเลือกได้หลายไฟล์</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่ลูกค้าเข้า</label>

                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="cus_date_edit" name="cus_date_edit" placeholder=""
                                                    autocomplete="off">
                                                <p class="text-danger mt-1 cus_date_edit_err"></p>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่นัดเข้างาน</label>
                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="onsite_date_edit" name="onsite_date_edit" placeholder=""
                                                    autocomplete="off">
                                                <p class="text-danger mt-1 onsite_date_edit_err"></p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="inputEmail3" class="col-form-label">รายละเอียด</label>
                                                <textarea id="detail_edit" name="detail_edit" class="col-md-12 form-control">
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="inputEmail3" class="col-form-label">หมายเหตุ</label>
                                                <input type="text" class="col-md-12 form-control" id="remark_edit"
                                                    name="remark_edit" placeholder="" autocomplete="off">

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

            <!-- modal info -->
            <div class="modal fade" id="modal-info">
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
                                                    name="budget" placeholder="" autocomplete="off"
                                                    onkeyup="this.value = Commas(this.value)">
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

                                                <p class="text-danger mt-1">สามารถเลือกได้หลายรูป</p>
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
                                                <p class="text-danger mt-1">สามารถเลือกได้หลายไฟล์</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่ลูกค้าเข้า</label>

                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="cus_date" name="cus_date" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_date_err"></p>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">วันที่นัดเข้างาน</label>
                                                <input type="text" class="col-md-12 form-control datepicker"
                                                    id="onsite_date" name="onsite_date" placeholder=""
                                                    autocomplete="off">
                                                <p class="text-danger mt-1 onsite_date_err"></p>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            bsCustomFileInput.init();
            $('.select2').select2();
            $('#summernote').summernote();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // รูปแบบวันที่
                autoclose: true,
            });

            $('#table').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
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
                // const _token = $("input[name='_token']").val();
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


            //Edit
            $('body').on('click', '.edit-item', function() {

                const id = $(this).data('id');
                //console.log(id);
                $('#modal-edit').modal('show');
                $.get('customers/' + id, function(data) {
                    console.log(data.img_ref);
                    $('#id_edit').val(data.id);
                    $('#cus_name_edit').val(data.cus_name);
                    $('#tel_edit').val(data.tel);
                    $('#budget_edit').val(Commas(data.budget));
                    $('#maps_edit').val(data.maps);
                    $('#cus_date_edit').val(data.cus_date);
                    $('#onsite_date_edit').val(data.onsite_date);
                    $('#location_edit').val(data.location);
                    $('#detail_edit').summernote('code', data.detail);
                    $('#remark_edit').val(data.remark);

                    // $('#imgshow-1').attr('src', data.img_ref.url);

                    var imgRefs = data.img_ref;
                    var container = $('#image-container');
                    container.empty();

                    imgRefs.forEach((img, index) => {
                        var imgWrapper = $('<div>', {
                            class: 'col-md-3',
                            id: `img-wrapper-${index + 1}`
                        });
                        var imgElement = $('<img>', {
                            class: 'img-fluid mb-1',
                            id: `imgshow-${index + 1}`,
                            // src: 'images/'+img.url,
                            src:`{{ asset('storage/images') }}/${img.url}`,
                            name: `imgshow-${index + 1}`
                        });
                        var deleteButton = $('<a>', {
                            href: '#',
                            class: 'float-right btn-tool',
                            html: '<i class="fas fa-times"></i>',
                            click: function(event) {
                                event.preventDefault();
                                $(`#img-wrapper-${index + 1}`).remove();
                            }
                        });

                        imgWrapper.append(imgElement).append(deleteButton);
                        container.append(imgWrapper);
                    });

                    if (data.notify_id == null || data.notify_id === "") {
                        $('#notify_id_edit option[value=""]').prop('selected', true);
                    } else {
                        $('#notify_id_edit option[value="' + data.notify_id + '"]').prop('selected',
                            true);
                    }
                });


            });


            //Delete
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
                        // const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: "DELETE",
                            url: '/customers/' + id,
                            // headers: {
                            //     'X-CSRF-TOKEN': csrfToken // ส่งค่า CSRF token ใน HTTP headers
                            // },
                            success: function(data) {
                                //tableUser.draw();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                });

                                setTimeout(
                                    "location.href = '{{ route('customers') }}';",
                                    1500);

                            },

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
