<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    //
    public function index()
    {
        $positions = Position::where('status', Position::STATUS_ACTIVE)->get();

        return view('dashboard', compact('positions'));
    }
}
