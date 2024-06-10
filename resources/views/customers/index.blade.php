@extends('app')
@section('title', 'ข้อมูลลูกค้า')
@section('content')
    @push('style')
        <style>
            .img-wrapper {
                position: relative;
                display: inline-block;
            }
            .products {
                width: 100%;
                height: 90px;
                object-fit: cover;
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

            .btn-tool2 {

                color: red;
                background-color: rgba(255, 255, 255, 0.7);

            }

            .btn-tool:hover {
                color: darkred;
            }

            .img-fluid {
                display: block;
                max-width: 100%;
                height: auto;
            }

            .show-logs {
                cursor: pointer;
            }
            .click-img {
                cursor: pointer;
            }

            .image-preview {
                position: relative;
                display: inline-block;
                margin: 10px;
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
                        <form method="GET" action="{{ route('customers') }}" id="searchForm">
                            @csrf
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>ชื่อลูกค้า</label>
                                            <input class="form-control" name="name_customer" type="text"
                                                value="{{ old('name_customer', request()->get('name_customer', '')) }}"
                                                placeholder="ชื่อลูกค้า">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input class="form-control" name="phone_customer" type="text"
                                                value="{{ old('phone_customer', request()->get('phone_customer', '')) }}"
                                                placeholder="เบอร์โทรศัพท์">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>สถานะ</label>
                                            <select id="status" name="status[]" class="select2" multiple="multiple"
                                                data-placeholder="เลือกสถานะ" style="width: 100%;">
                                                <option value="อยู่ระหว่างประสานงาน"
                                                    {{ in_array('อยู่ระหว่างประสานงาน', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    อยู่ระหว่างประสานงาน</option>
                                                <option value="อยู่ระหว่างทำแบบ Draft"
                                                    {{ in_array('อยู่ระหว่างทำแบบ Draft', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    อยู่ระหว่างทำแบบ Draft</option>
                                                <option value="อยู่ระหว่างเสนอราคา"
                                                    {{ in_array('อยู่ระหว่างเสนอราคา', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    อยู่ระหว่างเสนอราคา</option>
                                                <option value="พัฒนาแบบ"
                                                    {{ in_array('พัฒนาแบบ', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    พัฒนาแบบ</option>
                                                <option value="เสนอแบบ"
                                                    {{ in_array('เสนอแบบ', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    เสนอแบบ</option>
                                                <option value="เซ็นสัญญาแล้ว"
                                                    {{ in_array('เซ็นสัญญาแล้ว', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    เซ็นสัญญาแล้ว</option>
                                                <option value="ยกเลิก"
                                                    {{ in_array('ยกเลิก', (array) old('status', request()->get('status', []))) ? 'selected' : '' }}>
                                                    ยกเลิก</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>เลือกลักษณะงาน</label>
                                            <select name="notify_id[]" id="notify_id" class="select2" multiple="multiple"
                                                data-placeholder="เลือกลักษณะงาน" style="width: 100%;">

                                                @foreach ($Notify as $Notifys)
                                                    <option value="{{ $Notifys->id }}"
                                                        {{ in_array($Notifys->id, (array) old('notify_id', request()->get('notify_id', []))) ? 'selected' : '' }}>
                                                        {{ $Notifys->name }}</option>
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
                                                <option value=""
                                                    {{ old('date_select', request()->get('date_select', '')) == '' ? 'selected' : '' }}>
                                                    ทั้งหมด</option>
                                                <option value="cus_date"
                                                    {{ old('date_select', request()->get('date_select', '')) == 'cus_date' ? 'selected' : '' }}>
                                                    วันที่ลูกค้าเข้า</option>
                                                <option value="status_date"
                                                    {{ old('date_select', request()->get('date_select', '')) == 'status_date' ? 'selected' : '' }}>
                                                    วันที่อัพเดทสถานะ</option>
                                                <option value="onsite_date"
                                                    {{ old('date_select', request()->get('date_select', '')) == 'onsite_date' ? 'selected' : '' }}>
                                                    วันที่เข้าหน้างาน</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>วันที่เริ่มต้น</label>
                                            <input class="form-control datepicker" name="startdate" id="startdate"
                                                type="text"
                                                value="{{ old('startdate', request()->get('startdate', '')) }}"
                                                placeholder="วันที่เริ่มต้น">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="ถึงช่วงราคา-group">
                                            <label>ถึงวันที่</label>
                                            <input class="form-control datepicker" name="enddate" id="enddate"
                                                type="text" value="{{ old('enddate', request()->get('enddate', '')) }}"
                                                placeholder="ถึงวันที่">
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn bg-gradient-success"><i
                                                    class="fa fa-search"></i>
                                                ค้นหา</button>
                                            <a href="{{ route('customers') }}" type="button"
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
                                        <th>วันที่ เพิ่มข้อมูล</th>
                                        <th>ผ่านมาแล้ว</th>
                                        <th>วันที่ อัพเดทสถานะ</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Customers as $Customer)
                                        <tr class="text-center">
                                            <td width="5%">{{ $loop->index + 1 }}</td>
                                            <td>{{ $Customer->cus_no }}</td>
                                            <td>{{ $Customer->cus_date ? $Customer->cus_date : '-' }}</td>
                                            <td>{{ $Customer->onsite_date ? $Customer->onsite_date : '-' }}</td>
                                            <td>{{ $Customer->cus_name }}</td>
                                            <td>{{ $Customer->status }}</td>
                                            <td>{{ optional($Customer->notify_ref)->name }}</td>
                                            <td>{{ $Customer->location }}</td>
                                            <td>{{ number_format($Customer->budget ?? 0) }}</td>
                                            <td>{{ $Customer->created_at ? $Customer->created_at->format('Y-m-d') : '-' }}
                                            </td>
                                            <td>{{ $Customer->created_at->diffInDays(now()) }} วัน</td>
                                            <td> <a data-id="{{ $Customer->id }}"
                                                    class="show-logs">{{ $Customer->status_date }}</a></td>
                                            <td width="15%" class="text-center">
                                                <button class="btn bg-gradient-success btn-sm show-item"
                                                    title="รายละเอียด" data-id="{{ $Customer->id }}">
                                                    <i class="fa fa-circle-info">
                                                    </i>

                                                </button>
                                                <a href="{{ $Customer->maps }}" target="_blank"
                                                    class="btn bg-gradient-indigo btn-sm" title="โลเคชั่น">
                                                    <i class="fa fa-location-dot">
                                                    </i>

                                                </a>
                                                <button class="btn bg-gradient-primary btn-sm status-item" title="สถานะ"
                                                    data-id="{{ $Customer->id }}" data-status="{{ $Customer->status }}">
                                                    <i class="fa fa-refresh">
                                                    </i>

                                                </button>

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
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>ชื่อ-สกุล</label>
                                                <input type="text" class="col-md-12 form-control" id="cus_name"
                                                    name="cus_name" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_name_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>เบอร์โทรศัพท์</label>
                                                <input type="text" class="col-md-12 form-control" id="tel"
                                                    name="tel" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 tel_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>เลือกลักษณะงาน</label>
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
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>งบประมาณ</label>
                                                <input type="text" class="col-md-12 form-control" id="budget"
                                                    name="budget" placeholder="" autocomplete="off"
                                                    onkeyup="this.value = Commas(this.value)">
                                                <p class="text-danger mt-1 budget_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>สถานที่</label>
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

                                                <div id="progress-container"></div>
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
                                                <label for="inputEmail3"
                                                    class="col-form-label">วันที่นัดเข้าหน้างาน</label>
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
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>ชื่อ-สกุล</label>
                                                <input type="text" class="col-md-12 form-control" id="cus_name_edit"
                                                    name="cus_name_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 cus_name_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>เบอร์โทรศัพท์</label>
                                                <input type="text" class="col-md-12 form-control" id="tel_edit"
                                                    name="tel_edit" placeholder="" autocomplete="off">
                                                <p class="text-danger mt-1 tel_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>เลือกลักษณะงาน</label>
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
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>งบประมาณ</label>
                                                <input type="text" class="col-md-12 form-control" id="budget_edit"
                                                    name="budget_edit" placeholder="" autocomplete="off"
                                                    onkeyup="this.value = Commas(this.value)">
                                                <p class="text-danger mt-1 budget_edit_err"></p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputEmail3" class="col-form-label"><font color="red">* </font>สถานที่</label>
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
                                                        <input type="file" class="custom-file-input" id="images_edit"
                                                            name="images_edit" accept=".jpg, .jpeg, .png" multiple>
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
                                                        <input type="file" class="custom-file-input" id="files_edit"
                                                            name="files_edit" accept=".pdf" multiple>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            PDF</label>
                                                    </div>

                                                </div>
                                                <p class="text-danger mt-1">สามารถเลือกได้หลายไฟล์</p>
                                                <div class="row mailbox-attachment-info" id="file-container">

                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-form-label">
                                                    วันที่นัดเข้าหน้างาน</label>

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
                                <button type="button" class="btn bg-gradient-success" id="updatedata"><i
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
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">รายละเอียด ลูกค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            <dl class="row">
                                <dt class="col-sm-4">สถานะงาน</dt>
                                <dd class="col-sm-8">
                                    <h6><span class="badge bg-yellow" id="status_s"></span></h6>
                                </dd>
                                <dt class="col-sm-4">รหัสลูกค้า</dt>
                                <dd class="col-sm-8">
                                    <h6><span class="badge bg-blue" id="cus_no_s"></span></h6>
                                </dd>
                                <dt class="col-sm-4">ชื่อ-สกุล</dt>
                                <dd class="col-sm-8">คุณ<span id="cus_name_s"></span></dd>
                                <dt class="col-sm-4">เบอร์โทร</dt>
                                <dd class="col-sm-8"><span id="tel_s"></span></dd>
                                <dt class="col-sm-4">งบประมาณ</dt>
                                <dd class="col-sm-8"><span id="budget_s"></span> บาท</dd>
                                <dt class="col-sm-4">งาน</dt>
                                <dd class="col-sm-8"><span id="job_s"></span></dd>
                                <dt class="col-sm-4">สถานที่/แผนที่</dt>
                                <dd class="col-sm-8"><a id="maps_s" href="" target="_blank"
                                        class="btn bg-gradient-danger btn-sm" title="โลเคชั่น">
                                        <i class="fa fa-location-dot">
                                        </i> <span id="location_s"></span>

                                    </a></dd>
                                <dt class="col-sm-4">วันที่เข้าหน้างาน</dt>
                                <dd class="col-sm-8"><span id="onsite_date_s"></span></dd>
                                <dt class="col-sm-4">วันที่ลูกค้าเข้า</dt>
                                <dd class="col-sm-8"><span id="cus_date_s"></span></dd>
                                <dt class="col-sm-4">รายละเอียด</dt>
                                <dd class="col-sm-8"><span id="detail_s"></span></dd>
                                <dt class="col-sm-4">ไฟล์แนบ</dt>
                                <dd class="col-sm-8">
                                    <div class="row mailbox-attachment-info" id="file-container-show">

                                    </div>
                                </dd>
                            </dl>
                            <div class="row mt-3">
                                {{--
                                <div class="col-md-12">
                                    <div class="row">
                                        @for ($i = 0; $i < 20; $i++)
                                            <div class="col-md-4">
                                                <img class="img-fluid"
                                                    src="https://cdn.pixabay.com/photo/2019/08/09/13/51/boat-4395122_1280.jpg"
                                                    alt="Image {{ $i + 1 }}">

                                            </div>
                                        @endfor
                                    </div>
                                </div> --}}

                            </div>
                            <div class="row mt-3">

                                <img src="" class="img-fluid product-image" alt="Product Image">

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">

                                    <div class="product-image-thumbs row" id="image-container-show">
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <button id="prev-page" class="btn btn-primary">Previous</button>
                                    <button id="next-page" class="btn btn-primary">Next</button>
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- modal LogStatus -->
            <div class="modal fade" id="modal-logs">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ประวัติการอัพเดทสถานะ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">


                            <div id="content-show">



                            </div>


                        </div>

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

        function Commas(number) {

            const str = number.toString().replace(/,/g, "");
            const parts = str.split(".");
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
                todayHighlight: true
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
                        },
                        413: function(xhr) {
                            // const response = xhr.responseJSON;
                            //console.log(response.error.code);
                            $('#savedata').html('ลองอีกครั้ง');
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'ไฟล์มีขนาดใหญ่เกิน',
                                html: 'กรุณาลดจำนวนไฟล์หรือขนาดไฟล์ลง',
                                showConfirmButton: true,
                                timer: 2000
                            });


                        }
                    }
                });
            });


            //ShowDetail
            $('body').on('click', '.show-item', function() {

                const id = $(this).data('id');
                //console.log(id);
                $('#modal-info').modal('show');
                $.get('customers/' + id, function(data) {
                    //console.log(data);
                    $('#cus_no_s').text(data.cus_no);
                    $('#cus_name_s').text(data.cus_name);
                    $('#tel_s').text(data.tel);
                    $('#status_s').text(data.status);
                    $('#budget_s').text(Commas(data.budget));
                    $('#job_s').text(data.notify_ref ? data.notify_ref.name : '-');

                    $('#maps_s').attr('href', data.maps);
                    $('#cus_date_s').text(data.cus_date ? data.cus_date : '-');
                    $('#onsite_date_s').text(data.onsite_date ? data.onsite_date : '-');
                    $('#location_s').text(data.location);
                    $('#detail_s').html(data.detail);
                    $('#remark_s').text(data.remark);

                    // $('#imgshow-1').attr('src', data.img_ref.url);

                    const container = $('#image-container-show');
                    const fscontainer = $('#file-container-show');
                    container.empty();
                    fscontainer.empty();

                    const imgRefs = data.img_ref;
                    const fileRefs = data.file_ref;
                    const itemsPerPage = 9; // Number of items per page
                    let currentPage = 1;

                    function renderImages(page) {
                        container.empty();

                        const start = (page - 1) * itemsPerPage;
                        const end = start + itemsPerPage;
                        const paginatedItems = imgRefs.slice(start, end);

                        paginatedItems.forEach((imgRef, index) => {
                            const imgWrapper = $('<div>', {
                                class: 'col-md-4',
                                id: `img-wrapper-${start + index + 1}`
                            });

                            const imgElement = $('<img>', {
                                class: 'products click-img',
                                id: `imgshow-${start + index + 1}`,
                                src: `{{ asset('storage/images') }}/${imgRef.url}`,
                                alt: `Image ${start + index + 1}`,
                            });

                            imgWrapper.append(imgElement);
                            container.append(imgWrapper);

                            if (start + index === 0) {
                                imgElement.addClass('active');
                                $('.product-image').prop('src', imgElement.attr('src'));
                            }

                            imgElement.on('click', function() {
                                $('.product-image').prop('src', $(this).attr(
                                'src'));
                                $('.product-image-thumb.active').removeClass(
                                    'active');
                                $(this).addClass('active');
                            });
                        });
                    }

                    $('#prev-page').on('click', function() {
                        if (currentPage > 1) {
                            currentPage--;
                            renderImages(currentPage);
                        }
                    });

                    $('#next-page').on('click', function() {
                        if (currentPage < Math.ceil(imgRefs.length / itemsPerPage)) {
                            currentPage++;
                            renderImages(currentPage);
                        }
                    });

                    // Initial render
                    renderImages(currentPage);

                    fileRefs.forEach((file, index) => {
                        const fileWrapper = $('<div>', {
                            class: 'col-md-12',
                            id: `file-wrapper-${index + 1}`
                        });
                        const fileElement = $(`<a>`, {
                            href: `{{ asset('storage/files') }}/${file.url}`,
                            target: '_blank',
                            class: 'mailbox-attachment-name',
                            html: `<i class="far fa-file-pdf mb-1"></i> ${file.url}`
                        });
                        fileWrapper.append(fileElement);
                        fscontainer.append(fileWrapper);
                    });

                });


            });

            //Edit
            $('body').on('click', '.edit-item', function() {

                const id = $(this).data('id');
                //console.log(id);
                $('#modal-edit').modal('show');
                $.get('customers/' + id, function(data) {
                    //console.log(data);
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

                    const imgRefs = data.img_ref;
                    const fileRefs = data.file_ref;
                    const container = $('#image-container');
                    const fcontainer = $('#file-container');
                    container.empty();
                    fcontainer.empty();

                    imgRefs.forEach((img, index) => {
                        const imgWrapper = $('<div>', {
                            class: 'col-md-3',
                            id: `img-wrapper-${index + 1}`
                        });
                        const imgElement = $('<img>', {
                            class: 'products',
                            id: `imgshow-${index + 1}`,
                            // src: 'images/'+img.url,
                            src: `{{ asset('storage/images') }}/${img.url}`,
                            name: `imgshow-${index + 1}`
                        });
                        const deleteButton = $('<a>', {
                            href: '#',
                            class: 'btn-tool',
                            html: '<i class="fas fa-times"></i>',
                            click: function(event) {
                                event.preventDefault();
                                const imgId = img.id;
                                //console.log(imgId);
                                $.ajax({
                                    url: 'customers/delete-image/' +
                                        imgId,
                                    type: 'DELETE',
                                    success: function(result) {
                                        $(`#img-wrapper-${index + 1}`)
                                            .remove();
                                        toastr.success(result
                                            .message);

                                    },
                                    error: function(xhr, status,
                                        error) {
                                        console.error(xhr
                                            .responseText);

                                        toastr.error(xhr
                                            .responseJSON
                                            .message);
                                    }
                                });
                            }
                        });

                        imgWrapper.append(imgElement).append(deleteButton);
                        container.append(imgWrapper);
                    });

                    fileRefs.forEach((file, index) => {
                        const fileWrapper = $('<div>', {
                            class: 'col-md-12',
                            id: `file-wrapper-${index + 1}`
                        });
                        const fileElement = $(`<a>`, {
                            target: '_blank',
                            href: `{{ asset('storage/files') }}/${file.url}`,
                            class: 'mailbox-attachment-name',
                            html: `<i class="far fa-file-pdf mb-1"></i> ${file.url}`
                        });
                        const deleteButton = $('<a>', {
                            href: '#',
                            class: 'btn btn-sm center-right',
                            html: '<i class="fas fa-times btn-tool2"></i>',
                            click: function(event) {
                                event.preventDefault();
                                const fileId = file.id;
                                $.ajax({
                                    url: 'customers/delete-file/' +
                                        fileId,
                                    type: 'DELETE',
                                    success: function(result) {
                                        $(`#file-wrapper-${index + 1}`)
                                            .remove();
                                        toastr.success(result
                                            .message);
                                    },
                                    error: function(xhr, status,
                                        error) {
                                        console.error(xhr
                                            .responseText);
                                        toastr.error(xhr
                                            .responseJSON
                                            .message);
                                    }
                                });
                            }
                        });

                        fileWrapper.append(fileElement).append(deleteButton);
                        fcontainer.append(fileWrapper);
                    });

                    if (data.notify_id == null || data.notify_id === "") {
                        $('#notify_id_edit option[value=""]').prop('selected', true);
                    } else {
                        $('#notify_id_edit option[value="' + data.notify_id + '"]').prop('selected',
                            true);
                    }
                });


            });

            //updateData
            $('#updatedata').click(function(e) {
                e.preventDefault();
                $(this).html('รอสักครู่..');

                const formData = new FormData($('#editForm')[0]);
                // รับไฟล์รูปภาพ
                const images = $('#images_edit')[0].files;
                $.each(images, function(index, image) {
                    formData.append('images_edit[]', image);
                });

                // รับไฟล์เอกสาร
                const files = $('#files_edit')[0].files;
                $.each(files, function(index, file) {
                    formData.append('files_edit[]', file);
                });


                $.ajax({
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "{{ route('customers.update') }}",
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
                                    timer: 2500
                                });
                                $('#modal-edit').trigger("reset");
                                $('#modal-edit').modal('hide');
                                //tableUser.draw();
                                setTimeout("location.href = '{{ route('customers') }}';",
                                    1500);
                            } else {
                                printErrorMsg(data.error);
                                // $('.name_edit_err').text(data.error.name_edit);
                                $('#modal-edit').trigger("reset");
                                $('#updatedata').html('ลองอีกครั้ง');

                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                                    html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                    timer: 2500
                                });
                            }

                        } else {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                showConfirmButton: true,
                                timer: 2500
                            });
                            $('#editForm').trigger("reset");
                        }


                    },

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

            //Showlog
            $('body').on('click', '.show-logs', function() {
                const id = $(this).data('id');
                $('#modal-logs').modal('show');

                $.get('customers/logs-status/' + id, function(data) {
                    const listLogs = data;
                    const container = $('#content-show');
                    container.empty();

                    if (listLogs.length === 0) {
                        container.text('ไม่พบข้อมูล');
                    } else {
                        // Create the table structure
                        const table = $('<table class="table table-sm"></table>');
                        const thead = $('<thead><tr><th>วันที่</th><th>สถานะ</th></tr></thead>');
                        const tbody = $('<tbody></tbody>');

                        table.append(thead);
                        table.append(tbody);

                        listLogs.forEach((log, index) => {
                            const row = $('<tr></tr>');
                            const dateCell = $('<td></td>').text(log.date_at);
                            const statusCell = $('<td></td>').text(log.status);

                            row.append(dateCell);
                            row.append(statusCell);
                            tbody.append(row);
                        });

                        container.append(table);
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.status-item', function() {
                // $('.status-item').click(function(event) {
                event.preventDefault();
                var customerId = $(this).data('id');
                var currentStatus = $(this).data('status');

                Swal.fire({
                    position: 'top-center',
                    title: 'เปลี่ยนสถานะ',
                    input: 'select',
                    inputOptions: {
                        'อยู่ระหว่างประสานงาน': 'อยู่ระหว่างประสานงาน',
                        'อยู่ระหว่างทำแบบ Draft': 'อยู่ระหว่างทำแบบ Draft',
                        'อยู่ระหว่างเสนอราคา': 'อยู่ระหว่างเสนอราคา',
                        'พัฒนาแบบ': 'พัฒนาแบบ',
                        'เสนอแบบ': 'เสนอแบบ',
                        'เซ็นสัญญาแล้ว': 'เซ็นสัญญาแล้ว',
                        'ยกเลิก': 'ยกเลิก'
                    },
                    inputPlaceholder: 'เลือกสถานะ',
                    inputValue: currentStatus,
                    showCancelButton: true,
                    inputValidator: function(value) {
                        return new Promise(function(resolve) {
                            if (value) {
                                resolve();
                            } else {
                                resolve('คุณต้องเลือกสถานะ!');
                            }
                        });
                    }
                }).then(function(result) {
                    if (result.isConfirmed) {
                        // ส่งข้อมูลไปยังเซิร์ฟเวอร์เพื่ออัปเดตสถานะ
                        $.ajax({
                            url: '/customers/update-status/' + customerId,
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                status: result.value
                            },
                            success: function(data) {
                                //console.log(data);
                                if (data.success = true) {

                                    if ($.isEmptyObject(data.error)) {
                                        Swal.fire({

                                            icon: 'success',
                                            title: data.message,
                                            showConfirmButton: true,
                                            timer: 2500
                                        });

                                        setTimeout(
                                            "location.href = '{{ route('customers') }}';",
                                            1500);
                                    } else {


                                        Swal.fire({
                                            position: 'top-center',
                                            icon: 'error',
                                            title: 'ไม่สามารถบันทึกข้อมูลได้',
                                            html: `เนื่องจากกรอกข้อมูลไม่ครบถ้วน`,
                                            timer: 2500
                                        });
                                    }

                                } else {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด!',
                                        showConfirmButton: true,
                                        timer: 2500
                                    });

                                }


                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush
