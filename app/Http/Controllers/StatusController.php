<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    public function getStatusCard(Request $request, Card $card)
    {
        $status = $card->status;

        return DataTables::of($status)->make(true);
    }
}
