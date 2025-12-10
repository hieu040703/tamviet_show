<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactRequest extends Model
{
    use SoftDeletes;

    protected $table = 'contact_requests';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'note',
        'status',
        'save_info',
        'channel',
        'meta',
        'customer_id'
    ];

    protected $casts = [
        'save_info' => 'boolean',
        'meta' => 'array',
        'status' => 'integer',
    ];

    public const STATUS_PENDING = 1;
    public const STATUS_PROCESSING = 2;
    public const STATUS_DONE = 3;
    public const STATUS_CANCELLED = 4;

    public function items(): HasMany
    {
        return $this->hasMany(ContactRequestItem::class, 'contact_request_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, ContactRequestItem::class, 'contact_request_id', 'id', 'id', 'product_id');
    }

    public static function statusList(): array
    {
        return [
            self::STATUS_PENDING => 'Chờ xử lý',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_DONE => 'Hoàn tất',
            self::STATUS_CANCELLED => 'Đã huỷ',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        $map = [
            self::STATUS_PENDING => 'Chờ xử lý',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_DONE => 'Hoàn tất',
            self::STATUS_CANCELLED => 'Đã huỷ',
        ];

        return $map[$this->status] ?? 'Không xác định';
    }

    public function scopeForCustomer(Builder $query, $customer): Builder
    {
        if (!$customer) {
            return $query;
        }

        return $query->whereHas('items', function (Builder $sub) use ($customer) {
            $sub->where('customer_id', $customer->id);
        });
    }
}
