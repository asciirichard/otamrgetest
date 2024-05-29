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

        return view('index', compact('positions'));
    }

    public function job($id)
    {
        $position = Position::find($id);
        return view('job', compact('position'));
    }

    public function dashboard()
    {
        $positions = Position::all();

        return view('dashboard', compact('positions'));
    }

    public function submit(Request $request)
    {

    }
}
