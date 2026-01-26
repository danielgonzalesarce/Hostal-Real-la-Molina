<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Verificar que el usuario esté autenticado
        if (!Auth::check()) {
            return back()->withErrors(['error' => 'Debes iniciar sesión para dejar una reseña.'])->withInput();
        }

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ], [
            'room_id.required' => 'El ID de la habitación es requerido.',
            'room_id.exists' => 'La habitación seleccionada no existe.',
            'rating.required' => 'Debes seleccionar una calificación.',
            'rating.min' => 'La calificación mínima es 1 estrella.',
            'rating.max' => 'La calificación máxima es 5 estrellas.',
            'comment.required' => 'El comentario es obligatorio.',
            'comment.min' => 'El comentario debe tener al menos 10 caracteres.',
            'comment.max' => 'El comentario no puede exceder 1000 caracteres.',
        ]);

        // Verificar si el usuario ya dejó una reseña para esta habitación
        $existingReview = Review::where('user_id', Auth::id())
            ->where('room_id', $request->room_id)
            ->first();

        if ($existingReview) {
            return back()->withErrors(['error' => 'Ya has dejado una reseña para esta habitación.'])->withInput();
        }

        Review::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'guest_name' => Auth::user()->name,
            'guest_email' => Auth::user()->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
            'is_featured' => false,
        ]);

        // Limpiar cache relacionado con esta habitación
        $room = \App\Models\Room::find($request->room_id);
        if ($room) {
            \Illuminate\Support\Facades\Cache::forget("room.{$room->slug}");
            \Illuminate\Support\Facades\Cache::forget("room.{$room->slug}.reviews.approved");
            \Illuminate\Support\Facades\Cache::forget("room.{$room->slug}.related");
            \Illuminate\Support\Facades\Cache::forget('home.featured_reviews');
            \Illuminate\Support\Facades\Cache::forget('reviews.average_rating');
        }

        return back()->with('success', 'Reseña enviada exitosamente. Será revisada antes de publicarse.');
    }
}
