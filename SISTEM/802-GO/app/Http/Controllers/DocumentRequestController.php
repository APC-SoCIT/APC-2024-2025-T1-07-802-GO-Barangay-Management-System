<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DocumentRequestController extends Controller
{
    /**
     * Display the document request page.
     */
    public function index()
    {
        return view('document-request');
    }

    /**
     * Display individual document request forms.
     */
    public function barangayClearance() { return view('document_forms.barangay-clearance'); }
    public function certificateOfResidency() { return view('document_forms.certificate-of-residency'); }
    public function indigencyCertificate() { return view('document_forms.indigency-certificate'); }
    public function barangayID() { return view('document_forms.barangay-id'); }
    public function businessPermit() { return view('document_forms.business-permit'); }
    public function cedula() { return view('document_forms.cedula'); }

    /**
     * Handle form submission for Barangay Clearance.
     */
    public function submitBarangayClearance(Request $request)
    {
        $request->merge(['document_type' => 'barangay-clearance']);
        return $this->store($request);
    }

    /**
     * Handle form submission for Certificate of Residency.
     */
    public function submitCertificateOfResidency(Request $request)
    {
        $request->merge(['document_type' => 'certificate-of-residency']);
        return $this->store($request);
    }

    /**
     * Handle form submission for Indigency Certificate.
     */
    public function submitIndigencyCertificate(Request $request)
    {
        $request->merge(['document_type' => 'indigency-certificate']);
        return $this->store($request);
    }

    /**
     * Handle form submission for Barangay ID.
     */
    public function submitBarangayID(Request $request)
    {
        $request->merge(['document_type' => 'barangay-id']);
        return $this->store($request);
    }

    /**
     * Handle form submission for Business Permit.
     */
    public function submitBusinessPermit(Request $request)
    {
        $request->merge(['document_type' => 'business-permit']);
        return $this->store($request);
    }

    /**
     * Handle form submission for Cedula.
     */
    public function submitCedula(Request $request)
    {
        $request->merge(['document_type' => 'cedula']);
        return $this->store($request);
    }

    /**
     * Handle form submission and store the request in the database.
     */
    public function store(Request $request)
    {
        // Log request data for debugging
        Log::info('Form submitted:', $request->all());
    
        // Validate form input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => ['required', 'regex:/^09[0-9]{9}$/'],
            'document_type' => 'required|string',
            'block_street' => 'required|string|max:255',
            'extra_data' => 'nullable|array',
            'recent_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'valid_id' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'proof_of_residency' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'proof_of_income' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dti_sec_registration' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'lease_contract' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'business_permit_application' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
            'valid_id_owner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Generate a unique reference number
        $referenceNumber = 'BRGY-' . strtoupper(Str::random(8));
    
// Prepare the data to be stored
$data = [
    'user_id' => auth()->id() ?? null,
    'document_type' => $validated['document_type'],
    'reference_number' => $referenceNumber,
    'first_name' => $validated['first_name'],
    'middle_name' => $request->middle_name,
    'last_name' => $validated['last_name'],
    'gender' => $request->gender,
    'date_of_birth' => $request->date_of_birth,
    'place_of_birth' => $request->place_of_birth,
    'citizenship' => $request->citizenship,
    'civil_status' => $request->civil_status,
    'occupation' => $request->occupation,
    'annual_income' => is_numeric($request->annual_income) ? $request->annual_income : null,
    'contact_number' => $validated['contact_number'],
    'block_street' => $validated['block_street'],
    'barangay' => '802',
    'district' => 'Sta. Ana',
    'city' => 'Manila',
    'purpose_of_request' => $request->purpose_of_request,
    'purpose_of_cedula' => $request->purpose_of_cedula,
    'business_name' => $request->business_name,
    'business_address' => $request->block_street,
    'nature_of_business' => $request->business_nature,
    'tax_identification_number' => $request->tin,
    'extra_data' => json_encode($request->extra_data),
    'status' => 'pending',
];

    
        // Handle file uploads (Save in storage/app/public/)
        foreach ([
            'recent_photo', 'valid_id', 'proof_of_residency', 'signature',
            'proof_of_income', 'dti_sec_registration', 'lease_contract',
            'business_permit_application', 'valid_id_owner'
        ] as $fileField) {
            if ($request->hasFile($fileField)) {
                $filePath = $request->file($fileField)->store('', 'public');
                $data[$fileField] = $filePath;
                Log::info("File stored for {$fileField}: " . $filePath);
            }
        }
    
        // Log the final data before saving
        Log::info('Final data to be saved:', $data);
    
        // Store request in the database
        $documentRequest = DocumentRequest::create($data);
    
        Log::info('Saved to database:', $documentRequest->toArray());
    
        return redirect()->route('document-request')->with('success', 'Your request has been submitted! Your reference number is ' . $referenceNumber);
    }
}    