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

        // Search filter
        if ($request->has('search')) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhere('reference_number', 'like', '%' . $request->search . '%');
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
