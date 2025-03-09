<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    // Allow mass assignment of these fields
    protected $fillable = [
        'user_id',
        'document_type',
        'reference_number',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'citizenship',
        'civil_status',
        'occupation',
        'annual_income',
        'contact_number',
        'block_street',
        'barangay',
        'district',
        'city',
        'purpose_of_request',
        'purpose_of_cedula',
        'business_name',
        'business_address',
        'nature_of_business',
        'tax_identification_number',
        'dti_sec_registration',
        'valid_id_owner',
        'lease_contract',
        'business_permit_application',
        'proof_of_income',
        'recent_photo',
        'valid_id',
        'proof_of_residency',
        'signature',
        'extra_data',
        'status',
        'completed_at'
    ];

    // Cast JSON fields automatically
    protected $casts = [
        'date_of_birth' => 'date',
        'extra_data' => 'array',
        'contact_number' => 'string'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'completed_at'
    ];
}
