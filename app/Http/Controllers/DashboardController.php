<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function company_list(Request $request){
      
        if ($request->ajax()) {
            $_order = request('order');
            $_columns = request('columns');
            $order_by = $_columns[$_order[0]['column']]['name'];
            $order_dir = $_order[0]['dir'];
            $search = request('search');
            $skip = request('start');
            $take = request('length');

          
            $query = Company::query();
            if (isset($search['value'])) {
                $query->where('name', 'like', '%' . $search['value'] . '%');
            };

            $data = $query->orderBy($order_by, $order_dir)->skip($skip)->take($take)->get();
            $recordsTotal = $query->count();

            $recordsFiltered = $query->count();
            $i = 1;
            foreach ($data as $d) {
                $d->index_column = $i;
                $d->total_generated_url=$d->shortUrls()->count();
                $d->total_url_hits=$d->shortUrls()->sum('clicks');
                $d->total_users=$d->users()->count();
                $i++;
                $d->action = view('dashboard.super_admin.company-table-action', compact('d'))->render();
            }

            return [
                "draw" => request('draw'),
                "recordsTotal" => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                "data" => $data,
            ];
        }
    }


    public function teamMemberList(Request $request){
        if ($request->ajax()) {
            $_order = request('order');
            $_columns = request('columns');
            
            $order_by = $_columns[$_order[0]['column']]['name']=='name'?'id':$_columns[$_order[0]['column']]['name'];
            $order_dir = $_order[0]['dir'];
            $search = request('search');
            $skip = request('start');
            $take = request('length');

            $user =auth()->user();
       
            // $query = Invitation::where('invited_by',$user->id)->where('status',true);
           
            $query = Invitation::select(
               'id','email','status','company_id','role','invited_by','user_id',
                DB::raw('(select name from users where users.id =invitations.user_id) as  name'),
                DB::raw('(select email from users where users.id =invitations.user_id) as  email'),
            )->where('invited_by',$user->id)->where('status',true);
            // $query = Invitation::where('invited_by',$user->id)->where('status',true);
            // logger()->info($query);

            if (isset($search['value'])) {
                $query->where('email', 'like', '%' . $search['value'] . '%');
                // ->orWhere('name', 'like', '%' . $search['value'] . '%')
                // ->orWhere('role', 'like', '%' . $search['value'] . '%');

            };

            $data = $query->orderBy($order_by, $order_dir)->skip($skip)->take($take)->get();
            $recordsTotal = $query->count();

            $recordsFiltered = $query->count();
            foreach ($data as $d) {
                $d->role = $d->role;
                $d->total_generated_url = $d->user->shortUrls()->count();
                $d->total_hits = $d->user->shortUrls()->sum('clicks');

            }

            

            return [
                "draw" => request('draw'),
                "recordsTotal" => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                "data" => $data,
            ];
        }
    }
  
}
