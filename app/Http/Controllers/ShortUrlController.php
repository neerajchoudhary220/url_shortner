<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateUrlRequest;
use App\Jobs\ProcessShortUrlExportJob;
use App\Models\Company;
use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{

    public function index(Company $company)
    {
        return view('short_url.index', compact('company'));
    }

    public function showGenerateUrlForm()
    {
        return view('short_url.short-url-form');
    }

    public function generateShortUrl(GenerateUrlRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $shortUrlData = [
                'company_id' => $user->company_id,
                'original_url' => $request->original_url,
                'short_code' => Str::random(6),
            ];
            $user->shortUrls()->create($shortUrlData);
            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Short URL created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);
        }
    }

    public function shortUrlList(Request $request, $company_id = null,)
    {
        try {
            $user = $request->user();
            if ($request->ajax()) {
                $_order = request('order');
                $_columns = request('columns');
                $order_by = $_columns[$_order[0]['column']]['name'] == 'short_url' ? 'id' : $_columns[$_order[0]['column']]['name'];
                $order_dir = $_order[0]['dir'];
                $search = request('search');
                $skip = request('start');
                $take = request('length');

                if ($user->hasRole('SuperAdmin')) {
                    $query = ShortUrl::where('company_id', $request->company_id);
                } elseif ($user->hasRole('Admin')) {
                    $query = ShortUrl::where('company_id', $user->company_id);
                } else if ($user->hasRole('Member')) {
                    $query = ShortUrl::where('company_id', $user->company_id)->where('user_id', $user->id);
                }

                if (isset($search['value'])) {
                    $query->where('short_code', 'like', '%' . $search['value'] . '%')
                        ->where('original_url', 'like', '%' . $search['value'] . '%');
                };

                $data = $query->orderBy($order_by, $order_dir)->skip($skip)->take($take)->get();
                $recordsTotal = $query->count();
                $recordsFiltered = $query->count();

                foreach ($data as $d) {
                    $short_url_route = route('shortUrl.redirect', $d->short_code);
                    $d->short_url = <<<HTML
                    <a href="{$short_url_route}">{$short_url_route}</a>
                    HTML;
                    $d->date = Carbon::parse($d->created_at)->format('Y-m-d');
                }
                return [
                    "draw" => request('draw'),
                    "recordsTotal" => $recordsTotal,
                    'recordsFiltered' => $recordsFiltered,
                    "data" => $data,
                ];
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }
    }

    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();
        $shortUrl->increment('clicks');
        return redirect($shortUrl->original_url);
    }

    public function exportToCsv(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = $request->data;
                $user = auth()->user();
                ProcessShortUrlExportJob::dispatch($data,$user);
                return response()->json([
                    'msg' => "Your CSV file will be sent via email to your email address."
                ]);
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }
    }

    public function downloadCsvFile(Request $request)
    {
        $filename = "short_url{$request->encrypted_user_id}.csv";
        $path = config('constant.csv_file_path').$filename;
        if (!Storage::has($path)) {
            logger()->error("File not found at path: " . $path);
            abort(404, 'File not found at specified location');
        }
        return Storage::download($path);

    }
}
