<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersFormsPaymentsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Apply filters and retrieve data
        $query = User::with(['forms.payment']);
        
        if (!empty($this->filters['form_reference'])) {
            $query->whereHas('forms', function($formQuery) {
                $formQuery->where('form_reference', 'like', '%' . $this->filters['form_reference'] . '%');
            });
        }
        if (!empty($this->filters['taxpayer'])) {
            $query->whereHas('forms', function($formQuery) {
                $formQuery->where('taxpayer', 'like', '%' . $this->filters['taxpayer'] . '%');
            });
        }
        if (!empty($this->filters['seasontoDate'])) {
            $query->whereHas('forms', function($formQuery) {
                $formQuery->where('seasontoDate', $this->filters['seasontoDate']);
            });
        }
        if (!empty($this->filters['status'])) {
            $query->whereHas('forms.payment', function($paymentQuery) {
                $paymentQuery->where('status', $this->filters['status']);
            });
        }

        $users = $query->get();
        $data = [];

        foreach ($users as $user) {
            foreach ($user->forms as $form) {
                $data[] = [
                    $user->firstname,
                    $user->lastname,
                    $form->form_reference,
                    $form->taxpayer,
                    $form->uen,
                    $form->seasonfromDate,
                    $form->seasontoDate,
                    $form->total,
                    $form->dueTax,
                    optional($form->payment)->submission_date,
                    optional($form->payment)->payment_deadline,
                    optional($form->payment)->status,
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Firstname',
            'Lastname',
            'Tax form Reference',
            'Taxpayer',
            'UEN',
            'Season Date from',
            'Season Date to',
            'Total',
            'Due Tax',
            'Submission Date',
            'Due Date',
            'Status'
        ];
    }
}
