@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet"/>
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل حالة دفع فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل حالة دفع فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('invoices.statusUpdate',$invoice->id)}}" method="POST"
                          autocomplete="off">
                        @csrf
                        @method('PATCH')
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input readonly type="text" class="form-control" id="inputName" name="invoice_number"
                                       title="يرجي ادخال رقم الفاتورة" required value="{{$invoice->invoice_number}}">
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker" name="invoice_Date"
                                       placeholder="YYYY-MM-DD"
                                       type="text" value="{{ date('Y-m-d') }}" required
                                       value="{{$invoice->invoice_date}}">
                            </div>

                            <div class=" col">
                                <label>تاريخ الاستحقاق</label>
                                <input readonly class="form-control fc-datepicker" name="Due_date"
                                       placeholder="YYYY-MM-DD"
                                       type="text" required value="{{$invoice->due_date}}">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox"
                                        onclick="console.log($(this).val())"
                                        onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value="{{$invoice->section->id}}"
                                            selected> {{ $invoice->section->section_name}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select readonly id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input readonly type="text" class="form-control" id="inputName" name="Amount_collection"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,
                                       '$1');" value="{{ $invoice->amount_collection }}">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Amount_Commission"
                                       name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       required value="{{ $invoice->amount_commission	 }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Discount"
                                       name="Discount"
                                       title="يرجي ادخال مبلغ الخصم "
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       value=0 required value="{{ $invoice->discount	 }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="mySum()">
                                    <!--placeholder-->
                                    <option value="" disabled selected>حدد نسبة الضريبة</option>
                                    <option value="5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly
                                       value="{{ $invoice->	value_vat	 }}">
                            </div>

                            <div class=" col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                       value="{{ $invoice->total	 }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class=" row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{
                                $invoice->note	 }}</textarea>
                            </div>
                        </div>

                        <br>
                        {{-- 6 --}}
                        <div class=" row">
                            <div class="col">
                                <label for="inputName" class="control-label">حالة الدفع</label>
                                <select name="status" class="form-control SlectBox" required>
                                    <!--placeholder-->
                                    <option value="مدفوعة">مدفوعة</option>
                                    <option value="غير مدفوعة">غير مدفوعة</option>
                                    <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="Payment_Date"
                                       placeholder="YYYY-MM-DD"
                                       type="text" value="{{ date('Y-m-d') }}" required
                                       value="">
                            </div>

                            <input class="form-control fc-datepicker" name="id"
                                   type="hidden" value="{{ $invoice->id }}"
                            >


                        </div>

                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Section"]').on('change', function () {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId, // url to send the Request
                        type: "GET", // method
                        dataType: "json",
                        success: function (data) {    // function to run when Request successed
                            $('select[name="product"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });


    </script>


    <script>
        function mySum() {

            // Amount_Commission مبلغ العمولة
            // Amount_collection مبلغ التحصيل
            // Discount الخصم
            // Rate_VAT نسبة ضريبة القيمة المضافة
            // Value_VAT قيمة ضريبة القيمة المضافة
            // Total الاجمالي شامل الضريبة
            /*
                 المبلغ بعد الخصم = مبلغ العمولة - الخصم
                 قيمة ضريبة القيمة المضافة = المبلغ بعد الخسم * نسبة الضريبة المضافة / 100
                  الاجمالي شامل الضريبة = قيمة ضريبة القيمة المضافة +  المبلغ بعد الخصم
             */
            let Amount_Commission = parseFloat(document.getElementById('Amount_Commission').value);
            let Discount = parseFloat(document.getElementById('Discount').value);
            let Rate_VAT = parseFloat(document.getElementById('Rate_VAT').value);
            let Value_VAT = parseFloat(document.getElementById('Value_VAT').value);
            let Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                let resValue_VAT = Amount_Commission2 * Rate_VAT / 100;
                let resTotal = parseFloat(Amount_Commission2 + resValue_VAT);
                let sumValue_VAT = parseFloat(resValue_VAT).toFixed(2);
                let sumTotal = parseFloat(resTotal).toFixed(2);
                document.getElementById('Value_VAT').value = sumValue_VAT;
                document.getElementById('Total').value = sumTotal;
            }
        }
    </script>


@endsection
