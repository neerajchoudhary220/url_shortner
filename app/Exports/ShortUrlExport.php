<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShortUrlExport implements FromCollection,WithChunkReading,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct(array $data)
    {
        $this->data = collect($data);
    }
    public function collection()
    {
        return $this->data;
    }

    public function headings():array{
        return array_keys($this->data->first());
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
