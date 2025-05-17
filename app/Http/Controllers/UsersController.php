<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAuditLog;  // Assuming your audit model is named UserAudit
use App\Mail\ContactMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Contracts\Activity;

class UsersController extends Controller
{
    public function edit(Request $request)
    {
        $users = User::all();
        return view('pets.users', ['user' => $request->user(), 'users' => $users]);
    }
    public function index(Request $request) {
        $users = User::where('is_admin', '!=', 1)->get();
        return view('pets.view-users', [
            'users' => $users,
            'user' => $request->user(),
        ]);
    }

    public function showLogs()
{
    $activities = \Spatie\Activitylog\Models\Activity::all();
    return view('pets.pets-logs', compact('activities'));
}
    public function update(Request $request)
    {
        $this->validate($request, [
            'idEdit' => 'required|exists:users,id',
            'fnameEdit' => 'required|string|max:255',
            'lnameEdit' => 'required|string|max:255',
            'emailEdit' => 'required|email|unique:users,email,' . $request->idEdit,
            'phoneEdit' => 'required|digits:10|numeric',
            'addressEdit' => 'required|string|max:255',
            'cityEdit' => 'required|string|max:100',
            'provinceEdit' => 'required|string|max:100',
            'postalcodeEdit' => 'required|string|min:6|max:6',
        ]);

        $user = User::findOrFail($request->idEdit);
        $user->fname = $request->fnameEdit;
        $user->lname = $request->lnameEdit;
        $user->email = $request->emailEdit;
        $user->phone = $request->phoneEdit;
        $user->street = $request->addressEdit;
        $user->city = $request->cityEdit;
        $user->province = $request->provinceEdit;
        $user->postal_code = $request->postalcodeEdit;
        $user->save();

        return redirect()->route('users.edit')->with('status', 'user-profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->id);
        $user->delete();

        return redirect()->route('users.edit')->with('status', 'user-profile-deleted');
    }

   
    public function auditLog(Request $request, $userId)
    {
        $audits = UserAuditLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

       
        if ($request->ajax()) {
            return view('pets.partials.audit-log-table', compact('audits'))->render();
        }

        
        return view('pets.audit-log', compact('audits'));
    }

    public function sendEmail(Request $request, $type)
    {
        if ($type == 'admin') {
            $mail = 'Rutvik.joshi@live.com';
        } else {
            $mail = $request->receiver_email;
        }
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
        Message::insert($details);
        Mail::to($mail)->send(new ContactMail($details));
        return redirect()->back()->with('status', 'email-sent');
    }
}
