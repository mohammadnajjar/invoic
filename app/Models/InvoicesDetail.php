<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InvoicesDetail
 *
 * @property int $id
 * @property string $invoice_number
 * @property int $invoice_id
 * @property string $product
 * @property string $section
 * @property string $status
 * @property int $value_status
 * @property string|null $Payment_Date
 * @property string|null $note
 * @property string $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicesDetail whereValueStatus($value)
 * @mixin \Eloquent
 */
class InvoicesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'note',
        'user',
        'Payment_Date',
    ];
}
