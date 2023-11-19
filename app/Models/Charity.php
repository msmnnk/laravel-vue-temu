<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'website', 'donation_percentage'];
    protected $appends = ['TotalDonated'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalDonatedAttribute() {
        $total = 0;
        $this->orders()->each(function ($order) use (&$total) {
            $total += $order->donation;
        });
        return $total;
    }
}
