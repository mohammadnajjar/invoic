<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InvoiceAttachment
 *
 * @property int $id
 * @property string $file_name
 * @property string $invoice_number
 * @property int $invoice_id
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceAttachment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InvoiceAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'invoice_number', 'invoice_id', 'created_by'];
}
