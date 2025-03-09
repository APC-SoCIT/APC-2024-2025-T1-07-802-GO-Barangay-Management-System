<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentRequest::query();

        // Search filter for reference number, first name, last name, and document type
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('reference_number', 'like', "%{$searchTerm}%")
                  ->orWhere('first_name', 'like', "%{$searchTerm}%")
                  ->orWhere('last_name', 'like', "%{$searchTerm}%")
                  ->orWhere('document_type', 'like', "%{$searchTerm}%");
        }

        $documentRequests = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.document-request.document-request-index', compact('documentRequests'));
    }

    public function show($id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);
        return view('admin.document-request.show', compact('documentRequest'));
    }

    public function edit($id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);
        return view('admin.document-request.edit', compact('documentRequest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,released',
        ]);

        $documentRequest = DocumentRequest::findOrFail($id);
        $documentRequest->update(['status' => $request->status]);

        return redirect()->route('admin.document-requests.index')->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        $documentRequest = DocumentRequest::findOrFail($id);
        $documentRequest->delete();

        return redirect()->route('admin.document-requests.index')->with('success', 'Document request deleted successfully.');
    }
}
