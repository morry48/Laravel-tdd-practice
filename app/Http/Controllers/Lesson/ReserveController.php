<?php

namespace App\Http\Controllers\Lesson;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function __invoke(Lesson $lesson)
    {
        $user = Auth::user();
        Reservation::create(['lesson_id' => $lesson->id, 'user_id' => $user->id]);
        return redirect()->route('lessons.show', ['lesson' => $lesson]);
    }
}
