<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\InvoicesDetail;
use App\Models\Section;
use App\Notifications\InvoiceAdd;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index()
    {
//         return "hi";
//        $invoices = Invoice::where('deleted_at', NULL)->with('section')->get();
        $invoices = Invoice::withoutTrashed()->with('section')->get();
        return view('invoices.invoices', compact('invoices'));
    }

    public function getArchive()
    {
        $invoices = Invoice::onlyTrashed()->with('section')->get();
        return view('invoices.archive-invoices', compact('invoices'));
    }

    public function getUnpaid()
    {
        $invoices = Invoice::withTrashed()->with('section')->where('value_status', 1)->get();
        return view('invoices.unPaid-invoices', compact('invoices'));
    }


    public function getPaid()
    {
        $invoices = Invoice::withTrashed()->with('section')->where('value_status', 2)->get();
        return view('invoices.paid-invoices', compact('invoices'));
    }

    public function getPartial()
    {
        $invoices = Invoice::withTrashed()->with('section')->where('value_status', 3)->get();
        return view('invoices.partial-invoices', compact('invoices'));
    }

    public function restore(Request $request)
    {
//        return $request;
        $invoice_id = $request->invoice_id;
        $invoice = Invoice::withTrashed()->find($invoice_id);
        $invoice->restore();
        return redirect()->route('invoices.index')->with('restore', 'تم استعادة الفاتورة بنجاح');
    }

    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }

    public function store(Request $request)
    {

//        return $request;
        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'total' => $request->Total,
            'status' => 'غير مدفوعة',
            'value_status' => '1',
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        $invoice_id = invoice::latest()->first()->id; // Eloquent: Get the Latest Row from Relationship
        InvoicesDetail::create([
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $invoice_id,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'غير مدفوعة',
            'value_status' => '1',
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        if ($request->hasFile('pic')) {
            $invoice_id = Invoice::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachments = new InvoiceAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
        $invoice = Invoice::latest()->first();
        $user = Auth::user();
        $user->notify(new InvoiceAdd($invoice));


        return redirect()->route('invoices.index')->with('Add', 'تم اضافة الفاتورة بنجاح');
    }

    public function show($id)
    {
        $invoice = Invoice::withTrashed()->with('section')->findOrFail($id);
        return view('invoices.statusUpdate_invoice', compact('invoice'));
    }

    public function statusUpdate(Request $request)
    {

        $invoice_id = $request->id;
        $invoice = Invoice::withTrashed()->findOrFail($invoice_id);
        if ($request->status == 'غير مدفوعة')
            $value_status = 1;
        elseif ($request->status == 'مدفوعة')
            $value_status = 2;
        else
            $value_status = 3;
        $invoice->update([
            'status' => $request->status,
            'value_status' => $value_status,
            'Payment_Date' => $request->Payment_Date,
        ]);

        InvoicesDetail::create([
            'invoice_number' => $request->invoice_number,
            'invoice_id' => $invoice_id,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => $request->status,
            'value_status' => $value_status,
            'Payment_Date' => $request->Payment_Date,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        return redirect()->route('invoices.index')->with('edit', 'تم تغير حالة الفاتورة بنجاح');
    }

    public function edit($id)
    {

        $invoice = Invoice::with('section')->findOrFail($id);
//        return $invoice;
        $sections = Section::all();

        return view('invoices.edit_invoice', compact('invoice', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $invoiceid = $id;
        $invoice = Invoice::findOrFail($invoiceid);
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'total' => $request->Total,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        $invoicedetail = InvoicesDetail::findOrFail($invoiceid);

        $invoicedetail->update([
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        return redirect()->route('invoices.index')->with('edit', 'تم تعديل الفاتورة بنجاح');

    }

    public function destroy(Request $request)
    {

//        return $request;
        $invoice_id = $request->invoice_id;
        $id_page = $request->id_page;
        $invoice = Invoice::findOrFail($invoice_id);
        $attachment = InvoiceAttachment::findOrFail($invoice_id);
//        return $attachment;
        if ($id_page == 2) {
            $invoice->delete();
            return redirect()->route('invoices.archive')->with('archive', 'تم ارشفة الرسالة بنجاح');
        } else {
            if (!empty($attachment->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($attachment->invoice_number);
            }
            $invoice->forceDelete();
            return redirect()->route('invoices.index')->with('delete', 'تم حذف الرسالة بنجاح');
        }
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
//        return $products;
    }

    public function print($id)
    {
        $invoice = Invoice::with('section')->findOrFail($id);
//        return $invoice;
        return view('invoices.print_invoice', compact('invoice'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}
