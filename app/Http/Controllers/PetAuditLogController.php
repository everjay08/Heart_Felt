<?php

namespace App\Http\Controllers;

use App\Models\PetAuditLog;

class PetAuditLogController extends Controller
{
    public function index()
    {
        $logs = PetAuditLog::latest()->get();
        return view('audit_logs.index', compact('logs'));
    }
}
