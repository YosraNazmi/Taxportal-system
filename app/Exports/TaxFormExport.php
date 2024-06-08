<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaxFormExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Retrieve the authenticated user's forms
        $userForms = auth()->user()->forms()->get();

        // Return the forms collection
        return $userForms;
    }

    public function map($form): array
    {
        return [
            $form->form_reference,
            $form->taxpayer,
            $form->propertyyearfrom,
            $form->propertuyearto,
            $form->uen,
            $form->quarter,
            $form->seasonfromDate,
            $form->seasontoDate,
            $form->representativename,
            $form->upn,
            $form->position,
            $form->phone,
            $form->numberofEmployee,
            $form->salaryandwages,
            $form->Allowancess,
            $form->bonus,
            $form->total,
            $form->retire,
            $form->Gallowances,
            $form->summary,
            $form->examptions,
            $form->taxAmount,
            $form->dueTax,
            $form->delayone,
            $form->dalaytwo,
            $form->dalaythree,
            $form->totaloftaxpen,
            $form->delayinterest,
            $form->paidamount,
            $form->blanace,
            $form->remainingbalance,
            $form->tobepaid,
            $form->agreeCheckbox,
            // Add other columns as needed
        ];
    }
    

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tax Form Reference',
            'Name of Taxpayer',
            'Financial Year From',
            'Financial Year To',
            'UEN',
            'Quarter',
            'Season From Date',
            'Season To Date',
            'Tax Representative',
            'UPN',
            'Position',
            'Phone',
            'Number of Employees',
            'salaryandwages',
            'Allowancess',
            'bonus',
            'total',
            'retire',
            'Gallowances',
            'summary',
            'examptions',
            'Tax Amount',
            'dueTax',
            'Fisrt Delay',
            'Second Delay',
            'Third Delay',
            'Total Penalty',
            'Delay Interest',
            'Paid Amount',
            'Balance',
            'Remaining balance',
            'To be paid',
            'agreeCheckbox',
        ];
    }
}
