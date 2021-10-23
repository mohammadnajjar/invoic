<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class InvoicesExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        $invoices = Invoice::select(['id', 'invoice_number', 'invoice_date', 'due_date',
            'product', 'section_id', 'discount', 'rate_vat', 'value_vat', 'total', 'value_status', 'note'])->get();
        return $invoices;
    }

    public function headings(): array
    {
        return [
            '#',
            'رقم الفاتورة',
            'تاريخ الفاتورة',
            ' تاريخ الاستحقاق',
            'المنتج',
            'القسم',
            'الخصم',
            'نسبة الضريبة',
            'قيمة الضريبة',
            'الأجمالي',
            'الحالة',
            'الملاحظات',
        ];
    }
}
