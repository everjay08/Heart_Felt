<?php

namespace App\Http\Controllers;

use App\Models\UserAuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuditLogController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $auditLogs = UserAuditLog::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pets.audit-log', compact('user', 'auditLogs'));
    }
}