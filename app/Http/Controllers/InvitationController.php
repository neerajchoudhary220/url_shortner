<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Http\Requests\InvitationRequest;
use App\Mail\InviteMail;
use App\Models\Company;

class InvitationController extends Controller
{

    public function index(Request $request){
        $company_id = $request->company_id??null;
        $company='';
        if(auth()->user()->hasRole('SuperAdmin')){

            if($company_id){
               $company= Company::findOrFail($company_id);
            }else{
                abort(404);
            }
        }
        
        
        return view('invitation.invite',compact('company'));
    }

    public function store(InvitationRequest $request)
    {
        try {
            DB::beginTransaction();

            $invitationData = [
                'email' => $request->email,
                'name' => $request->name,
                'token' => Str::random(32),
                'company_id' => auth()->user()->hasRole('Admin') ? auth()->user()->company_id : $request->company_id,
                'invited_by' => auth()->user()->id,
                'role' => auth()->user()->hasRole('SuperAdmin') ? 'Admin' : $request->role,
            ];

            // Create invitation
            $invitation = Invitation::create($invitationData);

            // Send email
            Mail::to($request->email)->send(new InviteMail($invitation));

            DB::commit();

            return redirect()->back()
                ->with('success', 'Invitation sent successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Invitation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
                'user' => auth()->user()->id
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to send invitation. Please try again.');
        }
    }
}
