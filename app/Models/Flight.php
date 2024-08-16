<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = [
        'origin',
        'destination',
        'flight_date',
        'departure_time',
        'arrival_time',
        'company_name',
        'logo_url',
        'slug',
        'price_usd',
        'gate',
        'is_active',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($flight) {
            $flight->slug = Str::slug($flight->origin . '-to-' . $flight->destination . '-' . Str::random(10));
        });
    }

    public function getLogoUrlAttribute()
    {

        $filename = Str::slug($this->company_name) . '.png';

        $jpgCompanies = ['ryanair']; // Lista de empresas com imagens JPG
        if (in_array(Str::slug($this->company_name), $jpgCompanies)) {
            $filename = Str::slug($this->company_name) . '.jpg';
        }

    return url('logos/' . $filename);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_flights');
    }

}
