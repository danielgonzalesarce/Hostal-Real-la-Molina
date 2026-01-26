<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'claimant_name' => 'required|string|max:255',
            'claimant_dni' => 'required|string|max:20',
            'claimant_phone' => 'required|string|max:20',
            'claimant_email' => 'required|email|max:255',
            'claimant_address' => 'nullable|string|max:500',
            'complaint_description' => 'required|string|min:10',
        ]);

        $complaint = Complaint::create([
            ...$validated,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('complaints.create')
            ->with('success', 'Tu reclamo ha sido registrado exitosamente. Te contactaremos pronto.');
    }
}
