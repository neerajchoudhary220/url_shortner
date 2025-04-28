<?php

namespace App\Jobs;

use App\Exports\ShortUrlExport;
use App\Mail\ExportReadyFile;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessShortUrlExportJob implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $company_id;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, int $company_id)
    {
        $this->user = $user;
        $this->company_id = $company_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $user = $this->user;
            $encrypted_user_id = sha1($user->id) . '_' . now()->timestamp;
            $filename = "short_url{$encrypted_user_id}.csv";
            $path = config('constant.csv_file_path') . $filename;
            $export = (new ShortUrlExport)->forCompany($this->company_id);

            if ($user->hasRole('SuperAdmin')) {
                $export->storeExcel($path, 'public');
            } else {
                $export->forUser($this->user->id)->storeExcel($path, 'public');
            }
            Mail::to($user->email)->send(new ExportReadyFile($user, $filename, $encrypted_user_id));
        } catch (\Exception $e) {
            logger()->error($e);
        }
    }
}
