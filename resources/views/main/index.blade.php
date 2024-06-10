@extends('app')
@section('title', 'แดชบอร์ด')
@section('content')
    @push('style')
        <style>
            .products {
                width: 100%;
                height: 90px;
                object-fit: cover;
            }

            .click-img {
                cursor: pointer;
            }

            #table thead th {
                font-size: 13px;
            }

            #table tbody td {
                font-size: 13px;
                /* text-align: center; */
                vertical-align: middle;
            }

            #badge {
                font-size: 12px;
                /* color: #000 !important; */
            }
        </style>
    @endpush
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แดชบอร์ด

                    </h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-3 col-3">
                            <!-- small box -->
                            {{-- <a href="{{ route('main') }}" class="small-box-footer"> --}}
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <h3>{{ $countBstrature + $countRenovate + $countDesign }}</h3>
                                    <p>ข้อมูลทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-text"></i>
                                </div>
                            </div>
                            {{-- </a> --}}
                        </div>
                        <div class="col-md-3 col-3">
                            <!-- small box -->
                            {{-- <a href="{{ route('main', ['status' => 'ก่อสร้าง']) }}" class="small-box-footer"> --}}
                            <div class="small-box bg-gradient-lightblue">
                                <div class="inner">
                                    <h3>{{ number_format($countBstrature) }}</h3>
                                    <p>ก่อสร้าง</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-building"></i>
                                </div>
                            </div>
                            {{-- </a> --}}
                        </div>
                        <div class="col-md-3 col-3">
                            <!-- small box -->
                            {{-- <a href="{{ route('main', ['status' => 'รีโนเวท']) }}" class="small-box-footer"> --}}
                            <div class="small-box bg-gradient-lightblue">
                                <div class="inner">
                                    <h3>{{ number_format($countRenovate) }}</h3>
                                    <p>รีโนเวท</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                            {{-- </a> --}}
                        </div>
                        <div class="col-md-3 col-3">
                            <!-- small box -->
                            <a href="{{ route('main', ['status' => 'ออกแบบ']) }}" class="small-box-footer">
                                <div class="small-box bg-gradient-lightblue">
                                    <div class="inner">
                                        <h3>{{ number_format($countDesign) }}</h3>
                                        <p>ออกแบบ</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-lightbulb"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <!--Table-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-outline card-lightblue">
                            <h3 class="card-title text-danger">จำนวนรายที่เกิน SLA {{ $overSlaCount }} รายการ</h3>

                        </div>

                        <div class="card-body table-responsive">
                            <table id="table" class="table table-sm text-center table-striped ">
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
                                        <th class="text-danger">SLA</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item['customer']->cus_no }}</td>
                                            <td>{{ $item['customer']->cus_date ? $item['customer']->cus_date : '-' }}</td>
                                            <td>{{ $item['customer']->onsite_date ? $item['customer']->onsite_date : '-' }}
                                            </td>
                                            <td>{{ $item['customer']->cus_name }}</td>
                                            <td>{{ $item['customer']->status }}</td>
                                            <td>{{ optional($item['customer']->notify_ref)->name }}</td>
                                            <td>{{ $item['customer']->location }}</td>
                                            <td>{{ number_format($item['customer']->budget ?? 0) }}</td>
                                            <td class="text-danger">{{ $item['dayDiff'] }} วัน</td>
                                            <td width="15%" class="text-center">
                                                <button class="btn bg-gradient-success btn-sm show-item" title="รายละเอียด"
                                                    data-id="{{ $item['customer']->id }}">
                                                    <i class="fa fa-circle-info"></i>
                                                </button>
                                                <a href="{{ $item['customer']->maps }}" target="_blank"
                                                    class="btn bg-gradient-indigo btn-sm" title="โลเคชั่น">
                                                    <i class="fa fa-location-dot"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

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
                        <div class="col-12">
                            <img src="" class="img-fluid product-image" alt="Product Image">
                        </div>
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




@endsection
@push('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
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
                'paging': false,
                'lengthChange': true,
                'searching': true,
                'ordering': false,
                'info': false,
                'autoWidth': false,
                "responsive": true,
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




        });
    </script>
@endpush
