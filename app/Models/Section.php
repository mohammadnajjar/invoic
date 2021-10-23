<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $section_name
 * @property string|null $description
 * @property string $Created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Section newModelQuery()
 * @method static Builder|Section newQuery()
 * @method static Builder|Section query()
 * @method static Builder|Section whereCreatedAt($value)
 * @method static Builder|Section whereCreatedBy($value)
 * @method static Builder|Section whereDescription($value)
 * @method static Builder|Section whereId($value)
 * @method static Builder|Section whereSectionName($value)
 * @method static Builder|Section whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string $created_by
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 */
class Section extends Model
{
    use HasFactory;

    protected $fillable = ['section_name', 'description', 'created_by'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
