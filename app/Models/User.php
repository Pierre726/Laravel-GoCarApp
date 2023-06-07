<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'adress',
        'country',
        'code_postal',
        'password',
        'telephone',
        'carte_grise',
        'num_permis',
        'date_emission_permis',
        'date_expiration_permis',
        'photo_permis',
        'num_identite',
        'date_emission_identite',
        'date_expiration_identite',
        'photo_identite',
        'annee_experience_conducteur',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }

    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

}
