@extends('layouts.master')
@section('title')
    قائمة الفواتير المؤرشفة
@endsection
@section('css')
    {{--    <!-- Internal Data table css -->--}}
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2
							mb-0">/ قائمة الفواتير المؤرشفة</span>
            </div>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    <!-- row -->
    <div class="row">
        @include('messages.messages')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <a href="{{route('invoices.create')}}" class="modal-effect btn btn-sm btn-primary"
                       style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap " id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                <th class="wd-15p border-bottom-0">تاريخ الفاتورة</th>
                                <th class="wd-20p border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="wd-15p border-bottom-0">المنتج</th>
                                <th class="wd-10p border-bottom-0">القسم</th>
                                <th class="wd-25p border-bottom-0">الخصم</th>
                                <th class="wd-15p border-bottom-0">نسبة الضريبة</th>
                                <th class="wd-10p border-bottom-0">قيمة الضريبة</th>
                                <th class="wd-25p border-bottom-0">الأجمالي</th>
                                <th class="wd-15p border-bottom-0">الحالة</th>
                                <th class="wd-10p border-bottom-0">الملاحظات</th>
                                <th class="wd-10p border-bottom-0 ">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{$invoice->due_date}}</td>
                                    <td>{{$invoice->product}}</td>
                                    <td><a href="{{route('invoicesDetails',$invoice->id)
                                    }}">{{$invoice->section->section_name}}</a>
                                    </td>
                                    <td>{{$invoice->discount}}</td>
                                    <td>{{$invoice->rate_vat}}</td>
                                    <td>{{$invoice->value_vat}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>
                                        @if ($invoice->value_status == 1)
                                            <span class="text-success">{{ $invoice->status }}</span>
                                        @elseif($invoice->value_status == 2)
                                            <span class="text-danger">{{ $invoice->status }}</span>
                                        @else
                                            <span class="text-warning">{{ $invoice->status }}</span>
                                        @endif


                                    </td>
                                    <td>{{$invoice->note}}</td>
                                    <td>

                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button"> العمليات&nbsp; <i class="fas fa-caret-down ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.edit',$invoice->id)}}">تعديل
                                                    الفاتورة</a>
                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                   data-toggle="modal" data-target="#delete_invoice"><i
                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                    الفاتورة</a>
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.show',$invoice->id)}}"><i
                                                            class=" text-success fas  fa-money-bill"></i>&nbsp;
                                                    &nbsp;تغير
                                                    حالة
                                                    الدفع</a>

                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                   data-toggle="modal"
                                                   data-target="#Transfer_invoice"
                                                ><i
                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;
                                                    استعادة الفاتورة</a>
                                                <a class="dropdown-item" href="">
                                                    <i
                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                    الفاتورة
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete -->
        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف
                            الفاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('invoices.destroy', 'test')}}"
                          method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف
                                الفاتورة ؟</h6>
                            </p>
                            <input type="hidden" name="invoice_id"
                                   id="invoice_id" value="">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">الغاء
                            </button>
                            <button type="submit" class="btn btn-danger">تاكيد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ارشيف الفاتورة -->
        <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">استعادة الفاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="{{ route('invoices.restore', 'test') }}" method="post">
                        @csrf

                    </div>
                    <div class="modal-body">
                        هل انت متاكد من عملية استعادة الفاتورة ؟
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <input type="hidden" name="id_page" id="id_page" value="2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-info ">تاكيد</button>
                    </div>
                    </form>
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
    {{--    <!-- Internal Data tables -->--}}
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)

            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>
    <script>
        $('#Transfer_invoice').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id');
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id)
        })

    </script>
@endsection