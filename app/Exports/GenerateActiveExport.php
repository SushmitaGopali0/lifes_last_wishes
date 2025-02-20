<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GenerateActiveExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Newsletter::all();
        return Newsletter::select('email', 'firstname', 'lastname')->where('subscribed', 'yes')->get();
    }

    // Adding headings to the export
    public function headings(): array
    {
        return [
            'Email', 'First Name', 'Last Name'
        ];
    }
}
