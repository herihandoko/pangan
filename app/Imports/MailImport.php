<?php

namespace App\Imports;

use App\Model\MailAddress;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MailImport implements ToModel, WithStartRow
{
    protected $filename;

    function __construct($filename)
    {
        $this->filename = $filename;
    }
    /**
     * @param Collection $collection
     */

    public function model(array $row)
    {
        return new MailAddress([
            'display_name' => $row[0],
            'email_address' => $row[1],
            'filename' => $this->filename,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
