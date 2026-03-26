<?php

namespace App\Exports;

use App\Models\SeekerProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SeekersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Eager load 'user' relationship to get name/email
        return SeekerProfile::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Company Name',
            'Domain',
            'City',
            'State',
            'Joined Date',
        ];
    }

    public function map($seeker): array
    {
        return [
            $seeker->user->name ?? 'N/A',
            $seeker->user->email ?? 'N/A',
            $seeker->user->phone ?? 'N/A',
            $seeker->company_name,
            $seeker->business_domain,
            $seeker->city,
            $seeker->state,
            $seeker->created_at->format('d M Y'),
        ];
    }
}
