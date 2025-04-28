<?php

namespace App\Exports;

use App\Models\ShortUrl;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class ShortUrlExport implements WithHeadings, FromQuery,WithMapping
{
    use Exportable;
    protected ?int $company_id = null;
    protected ?int $user_id = null;

    public function forCompany(int $company_id)
    {
        $this->company_id = $company_id;
        return $this;
    }
    public function forUser(int $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function query()
    {
        $query = ShortUrl::query()
            ->select([
                'short_code',
                'original_url',
                'clicks',
                'created_at'
            ]);

        if ($this->company_id) {
            $query->where('company_id', $this->company_id);
        }
        if ($this->user_id) {
            $query->where('user_id', $this->user_id);
        }

        return $query;
    }

    public function map($item):array{
        return [
            'short_url' => route('shortUrl.redirect', $item->short_code),
            'long_url' => $item->original_url,
            'hits' => $item->clicks??0,
            'created_on' => $item->created_at
        ];
    }

    public function storeExcel(string $path, string $disk = 'public', string $writerType = Excel::CSV)
    {
        return $this->store($path, $disk, $writerType);
    }

    public function headings(): array
    {
        return [
            'Short Url',
            'Long Url',
            'Hits',
            'Created On'
        ];
    }
}
