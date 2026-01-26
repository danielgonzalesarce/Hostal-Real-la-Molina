<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.complaints.index', compact('complaints'));
    }

    public function show($id)
    {
        $complaint = Complaint::with('user')->findOrFail($id);
        return view('admin.complaints.show', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,dismissed',
            'response' => 'nullable|string|min:10',
        ]);

        $complaint->update([
            'status' => $validated['status'],
            'response' => $validated['response'] ?? null,
            'response_date' => $validated['response'] ? now() : null,
        ]);

        return redirect()->route('admin.complaints.show', $complaint->id)
            ->with('success', 'Reclamo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Reclamo eliminado exitosamente.');
    }
}
