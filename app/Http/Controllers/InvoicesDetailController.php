<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoicesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:اضافة مرفق|حذف المرفق', ['only' => ['index', 'store']]);
        $this->middleware('permission:اضافة مرفق', ['only' => ['create', 'store']]);
        $this->middleware('permission:حذف المرفق', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'mimes:pdf,jpeg,jpg,png'
        ]);
        $invoice_number = $request->invoice_number;
        $invoice_id = $request->invoice_id;
        $file_name = $request->file_name->getClientOriginalName();
        $attachments = new InvoiceAttachment();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $invoice_number;
        $attachments->created_by = Auth::user()->name;
        $attachments->invoice_id = $invoice_id;
        $attachments->save();
        // move pic
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/' . $invoice_number), $imageName);
        return redirect()->back()->with('Add', 'تم اضافة المرفق بنجاح');
    }

    public function show(InvoicesDetail $invoicesDetail)
    {
        //
    }

    public function edit($id)
    {
        $invoice = Invoice::withTrashed()->where('id', $id)->first();
        $invoices_details = InvoicesDetail::where('invoice_id', $id)->get();
        $invoice_attachments = InvoiceAttachment::where('invoice_id', $id)->get();
        return view('invoices.details_invoice', compact('invoice', 'invoice_attachments', 'invoices_details'));
    }

    public function destroy(Request $request)
    {
        $invoices = InvoiceAttachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }

    public function open_file($invoice_number, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
}
