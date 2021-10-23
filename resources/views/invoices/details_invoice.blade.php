@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل فاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('messages.messages')

    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتورة</a>
                                            </li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive">
                                                <table class="table table-striped mg-b-0 text-md-nowrap">
                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td>{{$invoice->invoice_number}}</td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td>{{$invoice->invoice_date}}</td>
                                                        <th scope="row">تاريخ الاستحقاق</th>
                                                        <td>{{$invoice->due_date}}</td>
                                                        <th scope="row">القسم</th>
                                                        <td>{{$invoice->section->section_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td>{{ $invoice->product }}</td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td>{{$invoice->amount_collection}}</td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td>{{$invoice->amount_commission}}</td>
                                                        <th scope="row">الخصم</th>
                                                        <td>{{$invoice->discount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">نسبة الضربية</th>
                                                        <td>{{$invoice->rate_vat}}</td>
                                                        <th scope="row">قيمة الضربية</th>
                                                        <td>{{$invoice->value_vat}}</td>
                                                        <th scope="row">الاجمالي مع الضريبة</th>
                                                        <td>{{$invoice->total}}</td>
                                                        <th scope="row">الحالة الحالية</th>
                                                        <td>
                                                            @if ($invoice->value_status == 1)
                                                                <span class="text-danger">{{ $invoice->status }}</span>
                                                            @elseif($invoice->value_status == 2)
                                                                <span class="text-success">{{ $invoice->status }}</span>
                                                            @else
                                                                <span class="text-warning">{{ $invoice->status }}</span>
                                                            @endif</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">ملاحظات</th>
                                                        <td>{{$invoice->note}}</td>
                                                    </tr>
                                                </table>
                                            </div><!-- bd -->

                                        </div>
                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive">
                                                <table class="table  mg-b-0 text-md-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>رقم الفاتورة</th>
                                                        <th>نوع المنتج</th>
                                                        <th>القسم</th>
                                                        <th>حالة الدفع</th>
                                                        <th>تاريخ الدفع</th>
                                                        <th>ملاحظات</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>المستخدم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoices_details as $detail)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$detail->invoice_number}}</td>
                                                            <td>{{$detail->product}}</td>
                                                            <td>{{$invoice->section->section_name}}</td>
                                                            <td>
                                                                @if ($detail->value_status == 1)
                                                                    <span class="badge rounded-pill fs-2  fw-bold text-light
                                                                    bg-danger">{{
                                                                    $detail->status }}</span>
                                                                @elseif($detail->value_status == 2)
                                                                    <span class="badge rounded-pill fs-2 fw-bold text-light
                                                                    bg-success">{{
                                                                    $detail->status }}</span>
                                                                @else
                                                                    <span class="badge rounded-pill fs-2 fw-bold
                                                                    text-light bg-warning">{{
                                                                    $detail->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$detail->Payment_Date}}</td>
                                                            <td>{{$detail->note}}</td>
                                                            <td>{{$detail->created_at}}</td>
                                                            <td>{{$detail->user}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div><!-- bd -->

                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                <div class="card-body">
                                                    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                    <h5 class="card-title">اضافة مرفقات</h5>
                                                    <form method="post" action="{{ route('invoicesdetails.store')}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="customFile"
                                                                   name="file_name" required>
                                                            <input type="hidden" id="customFile"
                                                                   name="invoice_number"
                                                                   value="{{ $invoice->invoice_number }}">
                                                            <input type="hidden" id="invoice_id" name="invoice_id"
                                                                   value="{{ $invoice->id }}">
                                                            <label class="custom-file-label" for="customFile">حدد
                                                                المرفق</label>
                                                        </div>
                                                        <br><br>
                                                        <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد
                                                        </button>
                                                    </form>
                                                </div>

                                                <br>
                                                <table class="table  mg-b-0 mt-3 text-md-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الملف</th>
                                                        <th>قام بالاضافة</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoice_attachments as $attachment)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$attachment->file_name}}</td>
                                                            <td>{{$attachment->created_by}}</td>
                                                            <td>{{$attachment->created_at}}</td>
                                                            <td>
                                                            <td>

                                                                <a class="btn btn-outline-success btn-sm"
                                                                   href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                   role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                   href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $attachment->file_name }}"
                                                                   role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>


                                                                <button class="btn btn-outline-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-file_name="{{ $attachment->file_name }}"
                                                                        data-invoice_number="{{ $attachment->invoice_number }}"
                                                                        data-id_file="{{ $attachment->id }}"
                                                                        data-target="#delete_file">حذف
                                                                </button>


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /div -->
            </div>
            <!-- delete -->
            <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('delete_file') }}" method="post">

                            @csrf
                            <div class="modal-body">
                                <p class="text-center">
                                <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                </p>

                                <input type="hidden" name="id_file" id="id_file" value="">
                                <input type="hidden" name="file_name" id="file_name" value="">
                                <input type="hidden" name="invoice_number" id="invoice_number" value="">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->

        <!-- delete -->

        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
