<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value)
    {
        return $query->where('name', 'like', "%{$value}%")
            ->orWhere('email', 'like', "%{$value}%");
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // OP Pharmacy Bill
    public function opd_medicine_receipts()
    {
        return $this->hasMany(OpdMedicineReceipt::class, "created_by_id", "id");
    }

    // OP Bills
    public function opd_billings()
    {
        return $this->hasMany(OpdBilling::class, "created_by_id", "id");
    }

    // IP Bills
    public function ip_pharmacy_indent_billings()
    {
        return $this->hasMany(IpPharmacyIndentBilling::class, "created_by_id", "id");
    }

    public function ip_service_billings()
    {
        return $this->hasMany(IpServiceBilling::class, "created_by_id", "id");
    }

    public function registrations()
    {
        return $this->hasMany(Patient::class, "created_by_id", "id");
    }

    public function patient_visits()
    {
        return $this->hasMany(PatientVisit::class, "created_by_id", "id");
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
