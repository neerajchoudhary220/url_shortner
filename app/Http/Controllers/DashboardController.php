<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function company_list(Request $request){
      
        if ($request->ajax()) {
            $_order = request('order');
            $_columns = request('columns');
            //   dd($_columns[$_order[0]['column']]['name']);
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
                $d->total_generated_url=0;
                $d->total_url_hits=0;
                $d->total_users=0;
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

  
}
