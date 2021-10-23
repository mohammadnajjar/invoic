<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $invoice_number
 * @property string $invoice_date
 * @property string $due_date
 * @property string $product
 * @property string $section
 * @property string $discount
 * @property string $rate_vat
 * @property string $value_vat
 * @property string $total
 * @property string $status
 * @property int $value_status
 * @property string|null $note
 * @property string $user
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Invoice newModelQuery()
 * @method static Builder|Invoice newQuery()
 * @method static Builder|Invoice query()
 * @method static Builder|Invoice whereCreatedAt($value)
 * @method static Builder|Invoice whereDeletedAt($value)
 * @method static Builder|Invoice whereDiscount($value)
 * @method static Builder|Invoice whereDueDate($value)
 * @method static Builder|Invoice whereId($value)
 * @method static Builder|Invoice whereInvoiceDate($value)
 * @method static Builder|Invoice whereInvoiceNumber($value)
 * @method static Builder|Invoice whereNote($value)
 * @method static Builder|Invoice whereProduct($value)
 * @method static Builder|Invoice whereRateVat($value)
 * @method static Builder|Invoice whereSection($value)
 * @method static Builder|Invoice whereStatus($value)
 * @method static Builder|Invoice whereTotal($value)
 * @method static Builder|Invoice whereUpdatedAt($value)
 * @method static Builder|Invoice whereUser($value)
 * @method static Builder|Invoice whereValueStatus($value)
 * @method static Builder|Invoice whereValueVat($value)
 * @mixin Eloquent
 * @property int $section_id
 * @property string|null $amount_collection
 * @property string|null $amount_commission
 * @property string|null $Payment_Date
 * @method static Builder|Invoice whereAmountCollection($value)
 * @method static Builder|Invoice whereAmountCommission($value)
 * @method static Builder|Invoice wherePaymentDate($value)
 * @method static Builder|Invoice whereSectionId($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Query\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invoice withoutTrashed()
 */
class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'Section',
        'product',
        'discount',
        'rate_vat',
        'value_vat',
        'total',
        'status',
        'value_status',
        'note',
        'user',
        'amount_commission',
        'amount_collection',
        'section_id',
        'Payment_Date',
    ];
    protected $dates = ['deleted_at'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
