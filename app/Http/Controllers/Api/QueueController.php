<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QueueTicket;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return QueueTicket::orderBy('created_at', 'asc')->get();
    }

    public function store(Request $request)
    {
        $count = QueueTicket::count();
        return QueueTicket::create([
            'qNum' => '#0' . ($count + 1),
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Waiting',
            'waitTime' => ($count * 15) + 15,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ticket = QueueTicket::findOrFail($id);
        $ticket->update(['status' => $request->status]);
        return $ticket;
    }

    public function destroy($id)
    {
        return QueueTicket::destroy($id);
    }
}