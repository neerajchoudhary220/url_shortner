<?php

namespace App\Jobs;

use App\Exports\ShortUrlExport;
use App\Mail\ExportReadyFile;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessShortUrlExportJob implements ShouldQueue
{
    use Queueable;
    protected $data;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(array $data,User $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $user = $this->user;
            logger()->info(['user'=>$user]);
            logger()->info($user->id);
            $export = new ShortUrlExport($this->data);
            $encrypted_user_id = sha1($user->id).'_'.now()->timestamp;
            $filename = "short_url{$encrypted_user_id}.csv";
            $path = config('constant.csv_file_path').$filename;
            Excel::store($export, $path, 'public', \Maatwebsite\Excel\Excel::CSV);
            Mail::to($user->email)->send(new ExportReadyFile($user,$filename,$encrypted_user_id));
            logger()->info("Sent file successfully");
        } catch (\Exception $e) {
            logger()->error($e);
        }
    }


}
