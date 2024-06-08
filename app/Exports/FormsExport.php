<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormsExport implements FromCollection, WithHeadings
{
    protected $forms;
    protected $totalDueTax;

    public function __construct($forms, $totalDueTax)
    {
        $this->forms = $forms;
        $this->totalDueTax = $totalDueTax;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Map the forms collection to include only the required information
        $collection = $this->forms->map(function ($form) {
            return [
                'Form Reference Number' => $form->form_reference,
                'DueTax' => $form->payment ? $form->payment->dueTax : 'N/A',
                'Date Submitted' => $form->payment ? $form->payment->submission_date : 'N/A',
            ];
        });

        // Append a row for the total due tax
        $collection->push([
            'Form Reference Number' => 'Total Due Tax:',
            'DueTax' => $this->totalDueTax,
            'Date Submitted' => '', // Leave this column empty for consistency
        ]);

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Form Reference Number',
            'DueTax',
            'Date Submitted',
        ];
    }
}
