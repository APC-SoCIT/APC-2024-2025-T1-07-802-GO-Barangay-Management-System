<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Modify existing table if it exists
        if (Schema::hasTable('document_requests')) {
            Schema::table('document_requests', function (Blueprint $table) {
                $table->string('contact_number', 15)->change(); // Ensure contact number is a string with max 15 characters
            });
        } else {
            // Create the table if it doesn't exist
            Schema::create('document_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('document_type');
                $table->string('reference_number')->unique();
    
                // Common Fields
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('civil_status')->nullable();
                $table->string('contact_number', 15);
                $table->text('block_street');
                $table->string('barangay')->default('802');
                $table->string('district')->default('Sta. Ana');
                $table->string('city')->default('Manila');
    
                // Document-Specific Fields (Stored in JSON)
                $table->json('extra_data')->nullable();
    
                // Uploadable Files
                $table->string('valid_id')->nullable();
                $table->string('proof_of_residency')->nullable();
                $table->string('recent_photo')->nullable();
                $table->string('signature')->nullable();
    
                // Business Permit Specific Fields
                $table->string('business_name')->nullable();
                $table->string('business_address')->nullable();
                $table->string('nature_of_business')->nullable();
                $table->string('tax_identification_number')->nullable();
                $table->string('dti_sec_registration')->nullable();
                $table->string('lease_contract')->nullable();
                $table->string('business_permit_application')->nullable();
                $table->string('valid_id_owner')->nullable();
    
                // Cedula-Specific Fields
                $table->string('place_of_birth')->nullable();
                $table->string('citizenship')->nullable();
                $table->string('occupation')->nullable();
                $table->decimal('annual_income', 10, 2)->nullable();
    
                // Other Fields
                $table->string('purpose_of_request')->nullable();
                $table->string('purpose_of_cedula')->nullable();
                $table->string('proof_of_income')->nullable();
    
                // Status & Timestamps
                $table->enum('status', ['pending', 'approved', 'rejected', 'released'])->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::table('document_requests', function (Blueprint $table) {
            $table->string('contact_number')->change(); // Revert to default if necessary
        });
    }
};