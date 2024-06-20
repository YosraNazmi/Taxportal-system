<?php

namespace App\Http\Controllers;

use App\Models\AppendixEight;
use App\Models\AppendixEightB;
use App\Models\AppendixEightC;
use App\Models\AppendixEighteen;
use App\Models\AppendixEleven;
use App\Models\AppendixFifteen;
use App\Models\AppendixFive;
use App\Models\AppendixFour;
use App\Models\AppendixFourteen;
use App\Models\AppendixFourteenB;
use App\Models\AppendixNine;
use App\Models\AppendixNineB;
use App\Models\AppendixNineteen;
use App\Models\AppendixSeven;
use App\Models\AppendixSeventeen;
use App\Models\AppendixSix;
use App\Models\AppendixSixteen;
use App\Models\AppendixTen;
use App\Models\AppendixThirteen;
use App\Models\AppendixTwelve;
use App\Models\AppendixTwenty;
use App\Models\AppendixTwentyB;
use App\Models\AppendixTwentyFive;
use App\Models\AppendixTwentyFour;
use App\Models\AppendixTwentyOne;
use App\Models\AppendixTwentySeven;
use App\Models\AppendixTwentySix;
use App\Models\AppendixTwentyThree;
use App\Models\AppendixTwentyTwo;
use App\Models\IntangibleAsset;
use App\Models\TangibleAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ViewAnnualFormTaxController extends Controller
{


    public function showAppendixFour()
    {    
        $appendixFourData = AppendixFour::where('user_id', auth()->id())->get();
        return view('Taxpayer.UpdateAnnualForm.Appendix4', compact('appendixFourData'));
    }
    
    public function showAppendixFive()
    {
        $appendixFiveData = AppendixFive::where('user_id', auth()->id())->get();
        return view('Taxpayer.UpdateAnnualForm.Appendix5', compact('appendixFiveData'));
    }
    public function showAppendixSix()
    {
        return view('Taxpayer.AnnualForms.Appendix6');
    }
    public function showAppendixSeven()
    {
        return view('Taxpayer.AnnualForms.Appendix7');
    }

    public function updateAppendixFour(Request $request) 
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'appendix_id.*' => 'required|exists:appendix_four,id',
            'corporation.*' => 'nullable|string|max:255',
            'tax_number.*' => 'nullable|string|max:255',
            'nationality.*' => 'nullable|string|max:255',
            'legal_form.*' => 'nullable|string|max:255',
            'ownership_ratio.*' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Loop through each submitted record
        foreach ($request->appendix_id as $index => $appendixId) {
            // Find the AppendixFour record by ID and user_id
            $appendix = AppendixFour::where('id', $appendixId)
                ->where('user_id', $userId)
                ->firstOrFail();
    
            // Update the AppendixFour record with the new data
            $appendix->update([
                'corporation' => $request->corporation[$index],
                'tax_number' => $request->tax_number[$index],
                'nationality' => $request->nationality[$index],
                'legal_form' => $request->legal_form[$index],
                'ownership_ratio' => $request->ownership_ratio[$index],
            ]);
        }
    
        // Return a response indicating success
        return redirect()->route('showAppendixFive')->with('success', 'Appendix 4 updated successfully. Proceed to Appendix 5.');
    }

    public function updateAppendixFive(Request $request)
    {
        $userId = $request->user()->id;

        $validatedData = $request->validate([
            'tax_number_merge.*' => 'nullable|string|max:255',
            'previous_company.*' => 'nullable|string|max:255',
            'Liquidated_company_name.*' => 'nullable|string|max:255',
            'tax_number_liquidation.*' => 'nullable|string|max:255',
            'start_date_liquidation.*' => 'nullable|date',
            'end_date_liquidation.*' => 'nullable|date',
        ]);

        // Retrieve existing records
        $existingAppendix = AppendixFive::where('user_id', $userId)->get();

        $tax_number_merge = $validatedData['tax_number_merge'] ?? [];
        $previous_company = $validatedData['previous_company'] ?? [];
        $Liquidated_company_name = $validatedData['Liquidated_company_name'] ?? [];
        $tax_number_liquidation = $validatedData['tax_number_liquidation'] ?? [];
        $start_date_liquidation = $validatedData['start_date_liquidation'] ?? [];
        $end_date_liquidation = $validatedData['end_date_liquidation'] ?? [];

        foreach ($existingAppendix as $index => $appendix) {
            $fields = [
                'tax_number_merge' => $tax_number_merge[$index] ?? $appendix->tax_number_merge,
                'previous_company' => $previous_company[$index] ?? $appendix->previous_company,
                'Liquidated_company_name' => $Liquidated_company_name[$index] ?? $appendix->Liquidated_company_name,
                'tax_number_liquidation' => $tax_number_liquidation[$index] ?? $appendix->tax_number_liquidation,
                'start_date_liquidation' => $start_date_liquidation[$index] ?? $appendix->start_date_liquidation,
                'end_date_liquidation' => $end_date_liquidation[$index] ?? $appendix->end_date_liquidation,
            ];

            $appendix->update($fields);
        }

        return redirect()->route('showAppendixSix')->with('success', 'Appendix 5 updated successfully. Proceed to Appendix 6.');
    }

    public function updateAppendixSix(Request $request)
    {   
        $userId = $request->user()->id;

        // Validate the request data
        $validatedData = $request->validate([
            'depreciation_value' => 'nullable|string',
            'continuous_installment' => 'nullable|string',
            'decreasing_installment' => 'nullable|string',
            'Another_method_administration' => 'nullable|string',
            'category_assets' => 'array',
            'category_assets.*' => 'nullable|string',
            'directory_number' => 'array',
            'directory_number.*' => 'nullable|string',
            'book_value' => 'array',
            'book_value.*' => 'nullable|numeric',
            'cost_acquisition' => 'array',
            'cost_acquisition.*' => 'nullable|numeric',
            'cost_assets' => 'array',
            'cost_assets.*' => 'nullable|numeric',
            'total_allowable' => 'array',
            'total_allowable.*' => 'nullable|numeric',
            'accumulated' => 'array',
            'accumulated.*' => 'nullable|numeric',
            'book_value_end' => 'array',
            'book_value_end.*' => 'nullable|numeric',
            'total_book_value' => 'nullable|numeric',
            'total_cost_acquisition' => 'nullable|numeric',
            'total_cost_assets' => 'nullable|numeric',
            'total_total_allowable' => 'nullable|numeric',
            'total_accumulated' => 'nullable|numeric',
            'total_book_value_end' => 'nullable|numeric',
        ]);

        // Retrieve existing Appendix Six record
        $appendixSix = AppendixSix::where('user_id', $userId)->first();

        if (!$appendixSix) {
            return redirect()->route('showAppendixSix')->with('error', 'Appendix Six record not found.');
        }

        // Update Appendix Six record fields
        $appendixSix->update([
            'depreciation_value' => $validatedData['depreciation_value'],
            'continuous_installment' => $request->has('continuous_installment'),
            'decreasing_installment' => $request->has('decreasing_installment'),
            'Another_method_administration' => $request->has('Another_method_administration'),
        ]);

        // Update related TangibleAsset records
        $tangibleAssetsData = [];
        foreach ($validatedData['category_assets'] as $index => $category) {
            $tangibleAssetsData[] = [
                'user_id' => $userId,
                'appendix_six_id' => $appendixSix->id,
                'category_assets' => $category,
                'directory_number' => $validatedData['directory_number'][$index] ?? null,
                'book_value' => $validatedData['book_value'][$index] ?? null,
                'cost_acquisition' => $validatedData['cost_acquisition'][$index] ?? null,
                'cost_assets' => $validatedData['cost_assets'][$index] ?? null,
                'total_allowable' => $validatedData['total_allowable'][$index] ?? null,
                'accumulated' => $validatedData['accumulated'][$index] ?? null,
                'book_value_end' => $validatedData['book_value_end'][$index] ?? null,
                'total_book_value' => $validatedData['total_book_value'],
                'total_cost_acquisition' => $validatedData['total_cost_acquisition'],
                'total_cost_assets' => $validatedData['total_cost_assets'],
                'total_total_allowable' => $validatedData['total_total_allowable'],
                'total_accumulated' => $validatedData['total_accumulated'],
                'total_book_value_end' => $validatedData['total_book_value_end'],
            ];
        }

        // Delete existing related TangibleAsset records and save new ones
        $appendixSix->tangibleAssets()->delete();
        $appendixSix->tangibleAssets()->createMany($tangibleAssetsData);

        return redirect()->route('showAppendixSix')->with('success', 'Appendix 6 updated successfully. Proceed to Appendix 7.');
    }

    public function updateAppendixSeven(Request $request)
    {
        // Get the authenticated user's ID
        $userId = $request->user()->id;
    
        // Validate the request
        $request->validate([
            'depreciation_value' => 'nullable|string',
            'continuous_installment' => 'nullable|string',
            'decreasing_installment' => 'nullable|string',
            'another_method_administration' => 'nullable|string',
            'type_of_intangible_assets' => 'array',
            'type_of_intangible_assets.*' => 'nullable|string',
            'book_value_beginning' => 'array',
            'book_value_beginning.*' => 'nullable|numeric',
            'cost_of_acquisition' => 'array',
            'cost_of_acquisition.*' => 'nullable|numeric',
            'cost_of_assets_sold' => 'array',
            'cost_of_assets_sold.*' => 'nullable|numeric',
            'total_consumption_allowed' => 'array',
            'total_consumption_allowed.*' => 'nullable|numeric',
            'depreciation_of_assets_sold' => 'array',
            'depreciation_of_assets_sold.*' => 'nullable|numeric',
            'book_value_end' => 'array',
            'book_value_end.*' => 'nullable|numeric',
    
            'total_book_value_beginning' => 'nullable|numeric',
            'total_cost_of_acquisition' => 'nullable|numeric',
            'total_cost_of_assets_sold' => 'nullable|numeric',
            'total_total_consumption_allowed' => 'nullable|numeric',
            'total_depreciation_of_assets_sold' => 'nullable|numeric',
            'total_book_value_end' => 'nullable|numeric',
        ]);
    
        // Retrieve existing Appendix Seven record
        $appendixSeven = AppendixSeven::where('user_id', $userId)->first();
    
        if (!$appendixSeven) {
            return redirect()->route('appendix.show', ['number' => 7])->with('error', 'Appendix Seven record not found.');
        }
    
        // Update the AppendixSeven record
        $appendixSeven->update([
            'depreciation_value' => $request->depreciation_value,
            'continuous_installment' => $request->has('continuous_installment'),
            'decreasing_installment' => $request->has('decreasing_installment'),
            'another_method_administration' => $request->has('another_method_administration'),
        ]);
    
        // Update or create related IntangibleAsset records for filled input rows
        foreach ($request->type_of_intangible_assets as $index => $type) {
            // Check if any of the input fields in the row are filled
            if (
                isset($request->book_value_beginning[$index]) ||
                isset($request->cost_of_acquisition[$index]) ||
                isset($request->cost_of_assets_sold[$index]) ||
                isset($request->total_consumption_allowed[$index]) ||
                isset($request->depreciation_of_assets_sold[$index]) ||
                isset($request->book_value_end[$index])
            ) {
                $intangibleAsset = IntangibleAsset::updateOrCreate(
                    ['appendix_seven_id' => $appendixSeven->id, 'user_id' => $userId, 'type_of_intangible_assets' => $type],
                    [
                        'book_value_beginning' => $request->book_value_beginning[$index] ?? null,
                        'cost_of_acquisition' => $request->cost_of_acquisition[$index] ?? null,
                        'cost_of_assets_sold' => $request->cost_of_assets_sold[$index] ?? null,
                        'total_consumption_allowed' => $request->total_consumption_allowed[$index] ?? null,
                        'depreciation_of_assets_sold' => $request->depreciation_of_assets_sold[$index] ?? null,
                        'book_value_end' => $request->book_value_end[$index] ?? null,
                        'total_book_value_beginning' => $request->total_book_value_beginning ?? null,
                        'total_cost_of_acquisition' => $request->total_cost_of_acquisition ?? null,
                        'total_cost_of_assets_sold' => $request->total_cost_of_assets_sold ?? null,
                        'total_total_consumption_allowed' => $request->total_total_consumption_allowed ?? null,
                        'total_depreciation_of_assets_sold' => $request->total_depreciation_of_assets_sold ?? null,
                        'total_book_value_end' => $request->total_book_value_end ?? null,
                    ]
                );
            }
        }
    
        // Remove any existing IntangibleAsset records not updated in the current request
        $appendixSeven->intangibleAssets()
            ->whereNotIn('type_of_intangible_assets', $request->type_of_intangible_assets)
            ->delete();
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 8])->with('success', 'Appendix 7 updated successfully. Proceed to Appendix 8.');
    }

    public function updateAppendixEight(Request $request)
    {
        $userId = Auth::id();

        // Validate the request data
        $validatedData = $request->validate([
            'tax_number.1.*' => 'nullable|string',
            'owned_company_name.1.*' => 'nullable|string',
            'number_of_shares.1.*' => 'nullable|integer',
            'ownership_percentage.1.*' => 'nullable|numeric',
            'book_value.1.*' => 'nullable|numeric',
            'accounting_profit.1.*' => 'nullable|numeric',
            
            'tax_number.2.*' => 'nullable|string',
            'owned_company_name.2.*' => 'nullable|string',
            'type_of_company.2.*' => 'nullable|string',
            'number_of_shares.2.*' => 'nullable|integer',
            'ownership_percentage.2.*' => 'nullable|numeric',
            'number_of_preferred_contribution.2.*' => 'nullable|integer',
            'book_value.2.*' => 'nullable|numeric',
            'accounting_profit.2.*' => 'nullable|numeric',

            'tax_number.3.*' => 'nullable|string',
            'owned_company_name.3.*' => 'nullable|string',
            'nationality.3.*' => 'nullable|string',
            'company_type.3.*' => 'nullable|string',
            'number_of_shares.3.*' => 'nullable|integer',
            'ownership_percentage.3.*' => 'nullable|numeric',
            'number_of_preferred_shared.3.*' => 'nullable|integer',
            'book_value.3.*' => 'nullable|numeric',
            'accounting_profit.3.*' => 'nullable|numeric',
            
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
        ]);

        // Retrieve all existing AppendixEight records for the current user
        $existingAppendixEight = AppendixEight::where('user_id', $userId)->get();

        // Update AppendixEight records
        foreach ($existingAppendixEight as $index => $appendix) {
            $fields = [
                'tax_number' => $validatedData['tax_number.1'][$index] ?? $appendix->tax_number,
                'owned_company_name' => $validatedData['owned_company_name.1'][$index] ?? $appendix->owned_company_name,
                'number_of_shares' => $validatedData['number_of_shares.1'][$index] ?? $appendix->number_of_shares,
                'ownership_percentage' => $validatedData['ownership_percentage.1'][$index] ?? $appendix->ownership_percentage,
                'book_value' => $validatedData['book_value.1'][$index] ?? $appendix->book_value,
                'accounting_profit' => $validatedData['accounting_profit.1'][$index] ?? $appendix->accounting_profit,
                'total_1' => $validatedData['total_1'] ?? $appendix->total_1,
            ];
        
            $appendix->update($fields);
        }
        
        // Retrieve all existing AppendixEightB records for the current user
        $existingAppendixEightB = AppendixEightB::where('user_id', $userId)->get();

        // Update AppendixEightB records
        foreach ($existingAppendixEightB as $index => $appendixB) {
            $fields = [
                'tax_number' => $validatedData['tax_number.2'][$index] ?? $appendixB->tax_number,
                'owned_company_name' => $validatedData['owned_company_name.2'][$index] ?? $appendixB->owned_company_name,
                'type_of_company' => $validatedData['type_of_company.2'][$index] ?? $appendixB->type_of_company,
                'number_of_shares' => $validatedData['number_of_shares.2'][$index] ?? $appendixB->number_of_shares,
                'ownership_percentage' => $validatedData['ownership_percentage.2'][$index] ?? $appendixB->ownership_percentage,
                'number_of_preferred_contribution' => $validatedData['number_of_preferred_contribution.2'][$index] ?? $appendixB->number_of_preferred_contribution,
                'book_value' => $validatedData['book_value.2'][$index] ?? $appendixB->book_value,
                'accounting_profit' => $validatedData['accounting_profit.2'][$index] ?? $appendixB->accounting_profit,
                'total_2' => $validatedData['total_2'] ?? $appendixB->total_2,
            ];
        
            $appendixB->update($fields);
        }

        // Retrieve all existing AppendixEightC records for the current user
        $existingAppendixEightC = AppendixEightC::where('user_id', $userId)->get();

        // Update AppendixEightC records
        foreach ($existingAppendixEightC as $index => $appendixC) {
            $fields = [
                'tax_number' => $validatedData['tax_number.3'][$index] ?? $appendixC->tax_number,
                'owned_company_name' => $validatedData['owned_company_name.3'][$index] ?? $appendixC->owned_company_name,
                'nationality' => $validatedData['nationality.3'][$index] ?? $appendixC->nationality,
                'company_type' => $validatedData['company_type.3'][$index] ?? $appendixC->company_type,
                'number_of_shares' => $validatedData['number_of_shares.3'][$index] ?? $appendixC->number_of_shares,
                'ownership_percentage' => $validatedData['ownership_percentage.3'][$index] ?? $appendixC->ownership_percentage,
                'number_of_preferred_shared' => $validatedData['number_of_preferred_shared.3'][$index] ?? $appendixC->number_of_preferred_shared,
                'book_value' => $validatedData['book_value.3'][$index] ?? $appendixC->book_value,
                'accounting_profit' => $validatedData['accounting_profit.3'][$index] ?? $appendixC->accounting_profit,
                'total_3' => $validatedData['total_3'] ?? $appendixC->total_3,
            ];
        
            $appendixC->update($fields);
        }

        // Redirect back with success message
        return redirect()->route('appendix.show', ['number' => 9])->with('success', 'Appendix 8 updated successfully. Proceed to Appendix 9.');
    }

    public function updateAppendixNine(Request $request)
    {
        $userId = Auth::id();

        // Validate the request
        $request->validate([
            't_asset_type.*' => 'nullable|string',
            't_purchase_date.*' => 'nullable|date',
            't_book_value.*' => 'nullable|numeric',
            't_net_selling_value.*' => 'nullable|numeric',
            't_profit_loss.*' => 'nullable|numeric',
            'number_of_shares.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'purchase_date.*' => 'nullable|date',
            'purchase_cost.*' => 'nullable|numeric',
            'net_selling_value.*' => 'nullable|numeric',
            'profit_loss.*' => 'nullable|numeric',

            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
        ]);

        $total_1 = $this->calculateTotal($request->t_profit_loss);
        $total_2 = $this->calculateTotal($request->profit_loss);

        // Update or create data in appendix_nine table
        if (is_array($request->t_asset_type)) {
            foreach ($request->t_asset_type as $key => $value) {
                if (!empty($value) || !empty($request->t_purchase_date[$key]) || !empty($request->t_book_value[$key]) || !empty($request->t_net_selling_value[$key]) || !empty($request->t_profit_loss[$key])) {
                    AppendixNine::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'id' => $request->appendix_nine_id[$key], // Assuming you have a hidden input in your form for each record's ID
                        ],
                        [
                            'total_1' => $total_1,
                            't_asset_type' => $value,
                            't_purchase_date' => $request->t_purchase_date[$key],
                            't_book_value' => $request->t_book_value[$key],
                            't_net_selling_value' => $request->t_net_selling_value[$key],
                            't_profit_loss' => $request->t_profit_loss[$key],
                        ]
                    );
                }
            }
        }

        // Update or create data in appendix_nine_b table
        if (is_array($request->number_of_shares)) {
            foreach ($request->number_of_shares as $key => $value) {
                if (!empty($value) || !empty($request->tax_number[$key]) || !empty($request->company_name[$key]) || !empty($request->purchase_date[$key]) || !empty($request->purchase_cost[$key]) || !empty($request->net_selling_value[$key]) || !empty($request->profit_loss[$key])) {
                    AppendixNineB::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'id' => $request->appendix_nine_b_id[$key], // Assuming you have a hidden input in your form for each record's ID
                        ],
                        [
                            'total_1' => $total_2,
                            'number_of_shares' => $value,
                            'tax_number' => $request->tax_number[$key],
                            'company_name' => $request->company_name[$key],
                            'purchase_date' => $request->purchase_date[$key],
                            'purchase_cost' => $request->purchase_cost[$key],
                            'net_selling_value' => $request->net_selling_value[$key],
                            'profit_loss' => $request->profit_loss[$key],
                        ]
                    );
                }
            }
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 10])->with('success', 'Appendix 9 updated successfully. Proceed to Appendix 10.');
    }

    // Helper function to calculate total
    private function calculateTotal($values)
    {
        return array_sum($values);
    }

    public function updateAppendixTen(Request $request)
    {
        $validatedData = $request->validate([
            'year_one.*' => 'nullable|numeric',
            'original_loss_one.*' => 'nullable|numeric',
            'written_offs_previous_year_one.*' => 'nullable|numeric',
            'written_offs_current_year_one.*' => 'nullable|numeric',
            'accumulated_loss_one.*' => 'nullable|numeric',
            'total' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        // Retrieve existing AppendixTen records for the current user
        $existingRecords = AppendixTen::where('user_id', $userId)->get();

        // Prepare data to update and insert
        $appendixTenData = [];
        $total = $validatedData['total'];

        foreach ($validatedData['year_one'] as $index => $year) {
            // Check if any of the fields in this row is filled
            if (!empty($year) || !empty($validatedData['original_loss_one'][$index]) ||
                !empty($validatedData['written_offs_previous_year_one'][$index]) ||
                !empty($validatedData['written_offs_current_year_one'][$index]) ||
                !empty($validatedData['accumulated_loss_one'][$index])) {

                // Check if an existing record exists at this index
                if (isset($existingRecords[$index])) {
                    // Update existing record
                    $existingRecords[$index]->update([
                        'year_one' => $year,
                        'original_loss_one' => $validatedData['original_loss_one'][$index],
                        'written_offs_previous_year_one' => $validatedData['written_offs_previous_year_one'][$index],
                        'written_offs_current_year_one' => $validatedData['written_offs_current_year_one'][$index],
                        'accumulated_loss_one' => $validatedData['accumulated_loss_one'][$index],
                        'total' => $total,
                    ]);
                } else {
                    // Create new record
                    $appendixTenData[] = [
                        'user_id' => $userId,
                        'year_one' => $year,
                        'original_loss_one' => $validatedData['original_loss_one'][$index],
                        'written_offs_previous_year_one' => $validatedData['written_offs_previous_year_one'][$index],
                        'written_offs_current_year_one' => $validatedData['written_offs_current_year_one'][$index],
                        'accumulated_loss_one' => $validatedData['accumulated_loss_one'][$index],
                        'total' => $total,
                    ];
                }
            }
        }

        // Insert new records if any
        if (!empty($appendixTenData)) {
            AppendixTen::insert($appendixTenData);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 11])->with('success', 'Appendix 10 submitted successfully. Proceed to Appendix 11.');
    }

    public function updateAppendixEleven(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'batch.*' => 'nullable|string',
            'refunds.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'sold_assets.*' => 'nullable|string',
            'purchased_assets.*' => 'nullable|string',
            'total' => 'nullable'
        ]);

        $userId = Auth::id();

        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['link_code'][$index]) &&
                empty($validatedData['batch'][$index]) &&
                empty($validatedData['refunds'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index]) &&
                empty($validatedData['sold_assets'][$index]) &&
                empty($validatedData['purchased_assets'][$index])) {
                continue; // Skip this row if it's empty
            }

            // Update existing records if the ID is provided
            if (isset($request->id[$index])) {
                $appendixEleven = AppendixEleven::find($request->id[$index]);
                if ($appendixEleven) {
                    $appendixEleven->update([
                        'link_code' => $validatedData['link_code'][$index],
                        'batch' => $validatedData['batch'][$index],
                        'refunds' => $validatedData['refunds'][$index],
                        'debit_account' => $validatedData['debit_account'][$index],
                        'credit_account' => $validatedData['credit_account'][$index],
                        'sold_assets' => $validatedData['sold_assets'][$index],
                        'purchased_assets' => $validatedData['purchased_assets'][$index],
                        'updated_at' => now(),
                    ]);
                    continue; // Move to the next iteration
                }
            }

            // Create new data if no ID is provided or if the record doesn't exist
            $data[] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'batch' => $validatedData['batch'][$index],
                'refunds' => $validatedData['refunds'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'sold_assets' => $validatedData['sold_assets'][$index],
                'purchased_assets' => $validatedData['purchased_assets'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert new records if any
        if (!empty($data)) {
            AppendixEleven::insert($data);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 12])->with('success', 'Appendix 11 updated successfully. Proceed to Appendix 12.');
    }

    public function updateAppendixTwelve(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'batch.*' => 'nullable|string',
            'refunds.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'sold_assets.*' => 'nullable|string',
            'purchased_assets.*' => 'nullable|string',
            'leased_assets.*' => 'nullable|string',
            'total' => 'nullable'
        ]);
    
        $userId = Auth::id();
    
        // Fetch existing records for the user
        $existingRecords = AppendixTwelve::where('user_id', $userId)->get()->keyBy('link_code');
    
        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($linkCode) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['batch'][$index]) &&
                empty($validatedData['refunds'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index]) &&
                empty($validatedData['sold_assets'][$index]) &&
                empty($validatedData['purchased_assets'][$index]) &&
                empty($validatedData['leased_assets'][$index])) {
                continue; // Skip this row if it's empty
            }
    
            $data[$linkCode] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'tax_number' => $validatedData['tax_number'][$index],
                'batch' => $validatedData['batch'][$index],
                'refunds' => $validatedData['refunds'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'sold_assets' => $validatedData['sold_assets'][$index],
                'purchased_assets' => $validatedData['purchased_assets'][$index],
                'leased_assets' => $validatedData['leased_assets'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        DB::beginTransaction();
    
        try {
            // Update existing records and insert new ones
            foreach ($data as $linkCode => $row) {
                if (isset($existingRecords[$linkCode])) {
                    // Update existing record
                    AppendixTwelve::where('user_id', $userId)
                        ->where('link_code', $linkCode)
                        ->update($row);
                    unset($existingRecords[$linkCode]);
                } else {
                    // Insert new record
                    AppendixTwelve::create($row);
                }
            }
    
            // Delete any records that were not included in the new data
            foreach ($existingRecords as $linkCode => $record) {
                AppendixTwelve::where('user_id', $userId)
                    ->where('link_code', $linkCode)
                    ->delete();
            }
    
            DB::commit();
    
            return redirect()->route('appendix.show', ['number' => 13])
                ->with('success', 'Appendix 12 updated successfully. Proceed to Appendix 13.');
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to update Appendix 12 records:', ['error' => $e->getMessage()]);
    
            return redirect()->route('appendix.show', ['number' => 13])
                ->with('error', 'Failed to update records. Please try again.');
        }
    }

    public function updateAppendixThirteen(Request $request)
    {
        $validatedData = $request->validate([
            'link_code.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'net_commercial_sales.*' => 'nullable|string',
            'net_commercial_purchase.*' => 'nullable|string',
            'debit_account.*' => 'nullable|string',
            'credit_account.*' => 'nullable|string',
            'total' => 'nullable'
        ]);
    
        $userId = Auth::id();
    
        // Fetch existing records for the user
        $existingRecords = AppendixThirteen::where('user_id', $userId)->get()->keyBy('link_code');
    
        $data = [];
        foreach ($validatedData['link_code'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['link_code'][$index]) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['net_commercial_sales'][$index]) &&
                empty($validatedData['net_commercial_purchase'][$index]) &&
                empty($validatedData['debit_account'][$index]) &&
                empty($validatedData['credit_account'][$index])) {
                continue; // Skip this row if it's empty
            }
    
            $data[$linkCode] = [
                'user_id' => $userId,
                'link_code' => $validatedData['link_code'][$index],
                'tax_number' => $validatedData['tax_number'][$index],
                'net_commercial_sales' => $validatedData['net_commercial_sales'][$index],
                'net_commercial_purchase' => $validatedData['net_commercial_purchase'][$index],
                'debit_account' => $validatedData['debit_account'][$index],
                'credit_account' => $validatedData['credit_account'][$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Update existing records and insert new ones
        foreach ($data as $linkCode => $row) {
            if (isset($existingRecords[$linkCode])) {
                // Update existing record
                AppendixThirteen::where('user_id', $userId)
                    ->where('link_code', $linkCode)
                    ->update($row);
                unset($existingRecords[$linkCode]);
            } else {
                // Insert new record
                AppendixThirteen::create($row);
            }
        }
    
        // Delete any records that were not included in the new data
        foreach ($existingRecords as $linkCode => $record) {
            AppendixThirteen::where('user_id', $userId)
                ->where('link_code', $linkCode)
                ->delete();
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 14])->with('success', 'Appendix 13 updated successfully. Proceed to Appendix 14.');
    }
    
    public function updateAppendixFourteen(Request $request)
    {
        $validatedData = $request->validate([
            'beginning_of_year.*' => 'nullable|string',
            'end_of_year.*' => 'nullable|string',
            'warehouse_address.*' => 'nullable|string',
            'area.*' => 'nullable|string',
            'private_owned.*' => 'nullable|boolean',
            'musataha.*' => 'nullable|boolean',
            'rent.*' => 'nullable|boolean',
            'rent_owner_name.*' => 'nullable|string',
        ]);
    
        $userId = Auth::id();
    
        // Fetch existing records for the user
        $existingRecordsFourteen = AppendixFourteen::where('user_id', $userId)->get()->keyBy('beginning_of_year');
        $existingRecordsFourteenB = AppendixFourteenB::where('user_id', $userId)->get()->keyBy('warehouse_address');
    
        $dataFourteen = [];
        $dataFourteenB = [];
    
        // Process AppendixFourteen data
        foreach ($validatedData['beginning_of_year'] as $index => $beginningOfYear) {
            if (empty($beginningOfYear) && empty($validatedData['end_of_year'][$index])) {
                continue;
            }
    
            $dataFourteen[$beginningOfYear] = [
                'user_id' => $userId,
                'beginning_of_year' => $beginningOfYear,
                'end_of_year' => $validatedData['end_of_year'][$index] ?? null,
                'updated_at' => now(),
            ];
        }
    
        foreach ($dataFourteen as $beginningOfYear => $row) {
            if (isset($existingRecordsFourteen[$beginningOfYear])) {
                AppendixFourteen::where('user_id', $userId)
                    ->where('beginning_of_year', $beginningOfYear)
                    ->update($row);
                unset($existingRecordsFourteen[$beginningOfYear]);
            } else {
                AppendixFourteen::create($row);
            }
        }
    
        foreach ($existingRecordsFourteen as $record) {
            $record->delete();
        }
    
        // Process AppendixFourteenB data
        foreach ($validatedData['warehouse_address'] as $index => $warehouseAddress) {
            if (empty($warehouseAddress) &&
                empty($validatedData['area'][$index]) &&
                !isset($validatedData['private_owned'][$index]) &&
                !isset($validatedData['musataha'][$index]) &&
                !isset($validatedData['rent'][$index]) &&
                empty($validatedData['rent_owner_name'][$index])) {
                continue;
            }
    
            $dataFourteenB[$warehouseAddress] = [
                'user_id' => $userId,
                'warehouse_address' => $warehouseAddress,
                'area' => $validatedData['area'][$index] ?? null,
                'private_owned' => isset($validatedData['private_owned'][$index]) ? (bool) $validatedData['private_owned'][$index] : false,
                'musataha' => isset($validatedData['musataha'][$index]) ? (bool) $validatedData['musataha'][$index] : false,
                'rent' => isset($validatedData['rent'][$index]) ? (bool) $validatedData['rent'][$index] : false,
                'rent_owner_name' => $validatedData['rent_owner_name'][$index] ?? null,
                'updated_at' => now(),
            ];
        }
    
        foreach ($dataFourteenB as $warehouseAddress => $row) {
            if (isset($existingRecordsFourteenB[$warehouseAddress])) {
                AppendixFourteenB::where('user_id', $userId)
                    ->where('warehouse_address', $warehouseAddress)
                    ->update($row);
                unset($existingRecordsFourteenB[$warehouseAddress]);
            } else {
                AppendixFourteenB::create($row);
            }
        }
    
        foreach ($existingRecordsFourteenB as $record) {
            $record->delete();
        }
    
        return redirect()->route('appendix.show', ['number' => 15])
                         ->with('success', 'Appendix 14 updated successfully. Proceed to Appendix 15.');
    }
    
    public function updateAppendixFifteen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'fees.*' => 'nullable|numeric',
            'admin_expenses.*' => 'nullable|numeric',
            'research_development_expenses.*' => 'nullable|numeric',
            'technical_assistance.*' => 'nullable|numeric',
            'similar_amounts.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
            'total_4' => 'nullable|numeric',
            'total_5' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

       
        // Fetch existing records for the user
        $existingRecords = AppendixFifteen::where('user_id', $userId)->get()->keyBy('tax_number');
    
        $data = [];
        foreach ($validatedData['tax_number'] as $index => $linkCode) {
            // Check if the row is completely empty
            if (empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['company_name'][$index]) &&
                empty($validatedData['fees'][$index]) &&
                empty($validatedData['admin_expenses'][$index]) &&
                empty($validatedData['research_development_expenses'][$index]) &&
                empty($validatedData['technical_assistance'][$index]) &&
                empty($validatedData['similar_amounts'][$index])) {
                continue; // Skip this row if it's empty
            }
    
            $data[$linkCode] = [
                'user_id' => $userId,
                'tax_number' => $validatedData['tax_number'][$index],
                'company_name' => $validatedData['company_name'][$index],
                'fees' => $validatedData['fees'][$index],
                'admin_expenses' => $validatedData['admin_expenses'][$index],
                'research_development_expenses' => $validatedData['research_development_expenses'][$index],
                'technical_assistance' => $validatedData['technical_assistance'][$index],
                'similar_amounts' => $validatedData['similar_amounts'][$index],
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'total_4' => $validatedData['total_4'],
                'total_5' => $validatedData['total_5'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Update existing records and insert new ones
        foreach ($data as $linkCode => $row) {
            if (isset($existingRecords[$linkCode])) {
                // Update existing record
                AppendixFifteen::where('user_id', $userId)
                    ->where('tax_number', $linkCode)
                    ->update($row);
                unset($existingRecords[$linkCode]);
            } else {
                // Insert new record
                AppendixFifteen::create($row);
            }
        }
    
        // Delete any records that were not included in the new data
        foreach ($existingRecords as $linkCode => $record) {
            AppendixFifteen::where('user_id', $userId)
                ->where('tax_number', $linkCode)
                ->delete();
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 16])->with('success', 'Appendix 15 updated successfully. Proceed to Appendix 16.');
    }

    public function updateAppendixSixteen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_name.*' => 'nullable|string',
            'address.*' => 'nullable|string',
            'batch_code.*' => 'nullable|numeric',
            'value.*' => 'nullable|numeric',
            'total_1' => 'nullable',
        ]);
    
        $userId = auth()->id(); // Assuming you're using authentication
    
        // Fetch existing records for the user
        $existingRecords = AppendixSixteen::where('user_id', $userId)->get()->keyBy('company_name');
    
        $data = [];
        foreach ($validatedData['company_name'] as $index => $companyName) {
            // Check if the row is completely empty
            if (empty($validatedData['company_name'][$index]) &&
                empty($validatedData['address'][$index]) &&
                empty($validatedData['batch_code'][$index]) &&
                empty($validatedData['value'][$index])) {
                continue; // Skip this row if it's empty
            }
    
            $data[$companyName] = [
                'user_id' => $userId,
                'company_name' => $validatedData['company_name'][$index],
                'address' => $validatedData['address'][$index],
                'batch_code' => $validatedData['batch_code'][$index],
                'value' => $validatedData['value'][$index],
                'total_1' => $validatedData['total_1'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Update existing records and insert new ones
        foreach ($data as $companyName => $row) {
            if (isset($existingRecords[$companyName])) {
                // Update existing record
                AppendixSixteen::where('user_id', $userId)
                    ->where('company_name', $companyName)
                    ->update($row);
                unset($existingRecords[$companyName]);
            } else {
                // Insert new record
                AppendixSixteen::create($row);
            }
        }
    
        // Delete any records that were not included in the new data
        foreach ($existingRecords as $companyName => $record) {
            AppendixSixteen::where('user_id', $userId)
                ->where('company_name', $companyName)
                ->delete();
        }
    
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 17])->with('success', 'Appendix 16 updated successfully. Proceed to Appendix 17.');
    }

    public function updateAppendixSeventeen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'page_number' => 'required|integer',
            'websites.*' => 'url|nullable',
            'revenue_percentage' => 'required|integer',
        ]);
    
        $userId = auth()->id(); // Assuming you're using authentication
        $pageNumber = $validatedData['page_number'];
        $websites = $validatedData['websites'];
    
        // Fetch existing records for the given user and page number
        $existingRecords = AppendixSeventeen::where('user_id', $userId)
                                            ->where('page_number', $pageNumber)
                                            ->get();
    
        // Track existing URLs to determine updates vs inserts
        $existingUrls = $existingRecords->pluck('url')->toArray();
    
        // Process each incoming website URL
        foreach ($websites as $url) {
            // Validate URL and ensure it's not empty
            if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                // Check if the URL already exists for this user and page_number
                $existingRecord = $existingRecords->where('url', $url)->first();
                if ($existingRecord) {
                    // Update the existing record with the revenue percentage
                    $existingRecord->update([
                        'revenue_percentage' => $validatedData['revenue_percentage'],
                    ]);
    
                    // Remove this URL from $existingUrls to track updated records
                    $existingUrls = array_diff($existingUrls, [$url]);
                } else {
                    // Create a new record for the new URL
                    AppendixSeventeen::create([
                        'user_id' => $userId,
                        'page_number' => $pageNumber,
                        'url' => $url,
                        'revenue_percentage' => $validatedData['revenue_percentage'],
                    ]);
                }
            }
        }
    
        // Delete any records that are no longer present in the updated data
        foreach ($existingUrls as $urlToDelete) {
            $recordToDelete = $existingRecords->where('url', $urlToDelete)->first();
            if ($recordToDelete) {
                $recordToDelete->delete();
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 18])->with('success', 'Appendix 17 updated successfully. Proceed to Appendix 18.');
    }
    
    
    public function updateAppendixEighteen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name_secondry_contract.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'nationality.*' => 'nullable|string',
            'contract_value.*' => 'nullable|numeric',
            'amount_paid.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        // Iterate through the validated data
        foreach ($validatedData['name_secondry_contract'] as $index => $nameSecondryContract) {
            // Check if the row is completely empty
            if (empty($nameSecondryContract) &&
                empty($validatedData['tax_number'][$index]) &&
                empty($validatedData['nationality'][$index]) &&
                empty($validatedData['contract_value'][$index]) &&
                empty($validatedData['amount_paid'][$index])) {
                continue; // Skip this row if it's empty
            }
    
            // Check if the record already exists
            $record = AppendixEighteen::where('user_id', $userId)
                        ->where('tax_number', $validatedData['tax_number'][$index])
                        ->first();
    
            if ($record) {
                // Update the existing record
                $record->update([
                    'name_secondry_contract' => $validatedData['name_secondry_contract'][$index],
                    'nationality' => $validatedData['nationality'][$index],
                    'contract_value' => $validatedData['contract_value'][$index],
                    'amount_paid' => $validatedData['amount_paid'][$index],
                    'total_1' => $validatedData['total_1'],
                    'total_2' => $validatedData['total_2'],
                    'updated_at' => now(),
                ]);
            } else {
                // Insert a new record if it does not exist
                AppendixEighteen::create([
                    'user_id' => $userId,
                    'name_secondry_contract' => $validatedData['name_secondry_contract'][$index],
                    'tax_number' => $validatedData['tax_number'][$index],
                    'nationality' => $validatedData['nationality'][$index],
                    'contract_value' => $validatedData['contract_value'][$index],
                    'amount_paid' => $validatedData['amount_paid'][$index],
                    'total_1' => $validatedData['total_1'],
                    'total_2' => $validatedData['total_2'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 19])->with('success', 'Appendix 18 updated successfully. Proceed to Appendix 19.');
    }

    public function updateAppendixNineteen(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'name_of_debtor.*' => 'nullable|string',
            'amount_of_bad_debt.*' => 'nullable|numeric',
            'date_of_debt.*' => 'nullable|date',
            'was_included_in_previous_income.*' => 'nullable|boolean',
            'has_all_means_been_taken.*' => 'nullable|boolean',
            'amount_allowed.*' => 'nullable|numeric',
            'amount_of_bad_debit' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        if (!isset($validatedData['tax_number']) || !is_array($validatedData['tax_number'])) {
            return redirect()->back()->with('error', 'Invalid data provided.');
        }
    
        // Iterate through the validated data
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            // Check if the row is completely empty
            if (empty($taxNumber) &&
                empty($validatedData['name_of_debtor'][$index]) &&
                empty($validatedData['amount_of_bad_debt'][$index]) &&
                empty($validatedData['date_of_debt'][$index]) &&
                empty($validatedData['was_included_in_previous_income'][$index]) &&
                empty($validatedData['has_all_means_been_taken'][$index]) &&
                empty($validatedData['amount_allowed'][$index]) &&
                empty($validatedData['amount_of_bad_debit'])) {
                continue; // Skip this row if it's empty
            }
    
            // Check if the record already exists for this user and tax_number
            $record = AppendixNineteen::where('user_id', $userId)
                        ->where('tax_number', $validatedData['tax_number'][$index])
                        ->first();
    
            if ($record) {
                // Update the existing record
                $record->update([
                    'tax_number' => $validatedData['tax_number'][$index],
                    'name_of_debtor' => $validatedData['name_of_debtor'][$index],
                    'amount_of_bad_debt' => $validatedData['amount_of_bad_debt'][$index],
                    'date_of_debt' => $validatedData['date_of_debt'][$index],
                    'was_included_in_previous_income' => $validatedData['was_included_in_previous_income'][$index],
                    'has_all_means_been_taken' => $validatedData['has_all_means_been_taken'][$index],
                    'amount_allowed' => $validatedData['amount_allowed'][$index],
                    'amount_of_bad_debit' => $validatedData['amount_of_bad_debit'],
                    'total_1' => $validatedData['total_1'],
                    'updated_at' => now(),
                ]);
            } else {
                // Insert a new record if it does not exist
                AppendixNineteen::create([
                    'user_id' => $userId,
                    'tax_number' => $validatedData['tax_number'][$index],
                    'name_of_debtor' => $validatedData['name_of_debtor'][$index],
                    'amount_of_bad_debt' => $validatedData['amount_of_bad_debt'][$index],
                    'date_of_debt' => $validatedData['date_of_debt'][$index],
                    'was_included_in_previous_income' => $validatedData['was_included_in_previous_income'][$index],
                    'has_all_means_been_taken' => $validatedData['has_all_means_been_taken'][$index],
                    'amount_allowed' => $validatedData['amount_allowed'][$index],
                    'amount_of_bad_debit' => $validatedData['amount_of_bad_debit'],
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 20])->with('success', 'Appendix 19 updated successfully. Proceed to Appendix 20.');
    }
    
    public function updateAppendixTwenty(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'name_of_donation.*' => 'nullable|string',
            'govermental_entity.*' => 'nullable|boolean',
            'value_of_donation.*' => 'nullable|numeric',
            'allowable_dontations.*' => 'nullable|numeric',
            'unauthorized_differences_one.*' =>'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',

            'tax_number_1.*' => 'nullable|string',
            'name_of_entity.*' => 'nullable|string',
            'value_subsidies.*' => 'nullable|numeric',
            'allowable_allowances.*' => 'nullable|numeric',
            'unauthorized_differernce_1.*' => 'nullable|numeric',
            'total_amount_1' => 'nullable|numeric',
            'total_amount_2' => 'nullable|numeric',
            'total_amount_3' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        if (!isset($validatedData['tax_number']) || !is_array($validatedData['tax_number'])) {
            return redirect()->back()->with('error', 'Invalid data provided.');
        }

        // Process updates for AppendixTwenty
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            $record = AppendixTwenty::where('user_id', $userId)
                        ->where('tax_number', $taxNumber)
                        ->first();

            if ($record) {
                $record->update([
                    'name_of_donation' => $validatedData['name_of_donation'][$index],
                    'govermental_entity' => isset($validatedData['govermental_entity'][$index]) ? 1 : 0,
                    'value_of_donation' => $validatedData['value_of_donation'][$index],
                    'allowable_dontations' => $validatedData['allowable_dontations'][$index],
                    'unauthorized_differences_one' => $validatedData['unauthorized_differences_one'][$index],
                    'total_1' => $validatedData['total_1'],
                    'total_2' => $validatedData['total_2'],
                    'total_3' => $validatedData['total_3'],
                    'updated_at' => now(),
                ]);
            }
        }

        // Process updates for AppendixTwentyB
        foreach ($validatedData['tax_number_1'] as $index => $taxNumber) {
            $recordB = AppendixTwentyB::where('user_id', $userId)
                        ->where('tax_number_1', $taxNumber)
                        ->first();

            if ($recordB) {
                $recordB->update([
                    'name_of_entity' => $validatedData['name_of_entity'][$index],
                    'value_subsidies' => $validatedData['value_subsidies'][$index],
                    'allowable_allowances' => $validatedData['allowable_allowances'][$index],
                    'unauthorized_differernce_1' => $validatedData['unauthorized_differernce_1'][$index],
                    'total_amount_1' => $validatedData['total_amount_1'],
                    'total_amount_2' => $validatedData['total_amount_2'],
                    'total_amount_3' => $validatedData['total_amount_3'],
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 21])->with('success', 'Appendix 20 updated successfully. Proceed to Appendix 21.');
    }

    public function updateAppendixTwentyOne(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string|max:15',
            'name_of_insurance_company.*' => 'nullable|string',
            'local_insurance.*' => 'nullable|boolean', // Ensure it's validated as boolean
            'external_insurance.*' => 'nullable|boolean', // Ensure it's validated as boolean
            'insurance_current_period.*' => 'nullable|numeric',
            'allowed_insurance_premiums.*' => 'nullable|numeric',
            'difference_allowed.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
        ]);
    
        $userId = Auth::id();
    
        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            $nameOfInsuranceCompany = $validatedData['name_of_insurance_company'][$index] ?? null;
            $localInsurance = isset($validatedData['local_insurance'][$index]) ? 1 : 0;
            $externalInsurance = isset($validatedData['external_insurance'][$index]) ? 1 : 0;
            $insuranceCurrentPeriod = $validatedData['insurance_current_period'][$index] ?? null;
            $allowedInsurancePremiums = $validatedData['allowed_insurance_premiums'][$index] ?? null;
            $differenceAllowed = $validatedData['difference_allowed'][$index] ?? null;
    
            // Check if all fields are null, skip iteration if true
            if (is_null($taxNumber) &&
                is_null($nameOfInsuranceCompany) &&
                is_null($insuranceCurrentPeriod) &&
                is_null($allowedInsurancePremiums) &&
                is_null($differenceAllowed)
            ) {
                continue;
            }
    
            // Find existing record or create new one
            $record = AppendixTwentyOne::where('user_id', $userId)
                ->where('tax_number', $taxNumber)
                ->first();
    
            if ($record) {
                // Update existing record
                $record->update([
                    'name_of_insurance_company' => $nameOfInsuranceCompany,
                    'local_insurance' => $localInsurance,
                    'external_insurance' => $externalInsurance,
                    'insurance_current_period' => $insuranceCurrentPeriod,
                    'allowed_insurance_premiums' => $allowedInsurancePremiums,
                    'difference_allowed' => $differenceAllowed,
                    'total_1' => $validatedData['total_1'],
                    'updated_at' => now(),
                ]);
            } else {
                // Create new record if it doesn't exist
                AppendixTwentyOne::create([
                    'user_id' => $userId,
                    'tax_number' => $taxNumber,
                    'name_of_insurance_company' => $nameOfInsuranceCompany,
                    'local_insurance' => $localInsurance,
                    'external_insurance' => $externalInsurance,
                    'insurance_current_period' => $insuranceCurrentPeriod,
                    'allowed_insurance_premiums' => $allowedInsurancePremiums,
                    'difference_allowed' => $differenceAllowed,
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 22])->with('success', 'Appendix 21 updated successfully. Proceed to Appendix 22.');
    }

    public function updateAppendixTwentyTwo(Request $request)
    {
        $validatedData = $request->validate([
            'amount_of_bad_debit' => 'nullable|numeric',
            'income_type.*' => 'nullable|string',
            'amount_in_statement.*' => 'nullable|numeric',
            'allowed_amount.*' => 'nullable|numeric',
            'not_allowed_amount.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        $existingData = AppendixTwentyTwo::where('user_id', $userId)->get();
        $dataToUpdate = [];
        $dataToInsert = [];

        foreach ($validatedData['income_type'] as $index => $incomeType) {
            $amountInStatement = $validatedData['amount_in_statement'][$index] ?? null;
            $allowedAmount = $validatedData['allowed_amount'][$index] ?? null;
            $notAllowedAmount = $validatedData['not_allowed_amount'][$index] ?? null;

            // Check if all fields are null or empty
            if (empty($incomeType) && is_null($amountInStatement) && is_null($allowedAmount) && is_null($notAllowedAmount)) {
                continue;
            }

            // Prepare data for update or insert
            $data = [
                'user_id' => $userId,
                'income_type' => $incomeType,
                'amount_in_statement' => $amountInStatement,
                'allowed_amount' => $allowedAmount,
                'not_allowed_amount' => $notAllowedAmount,
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Check if there's existing data to update
            if ($existingData->isNotEmpty() && isset($existingData[$index])) {
                // Update existing record
                $existingData[$index]->update($data);
            } else {
                // Add to data to insert array
                $dataToInsert[] = $data;
            }
        }

        // Insert new records
        if (!empty($dataToInsert)) {
            AppendixTwentyTwo::insert($dataToInsert);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 23])->with('success', 'Appendix 22 updated successfully. Proceed to Appendix 23.');
    }

    public function updateAppendixTwentyThree(Request $request)
    {
        $validatedData = $request->validate([
            'bank_interest.*' => 'nullable|numeric',
            'allowed_bank_value.*' => 'nullable|numeric',
            'capital_interest.*' => 'nullable|numeric',
            'other_bank_interest_*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric',
            'total_2' => 'nullable|numeric',
            'total_3' => 'nullable|numeric',
            'total_4' => 'nullable|numeric',
        ]);

        $userId = Auth::id();

        // Fetch existing data for the user
        $existingData = AppendixTwentyThree::where('user_id', $userId)->get();

        $dataToUpdate = [];
        $dataToInsert = [];

        foreach ($validatedData['bank_interest'] as $index => $bankInterest) {
            $allowedBankValue = $validatedData['allowed_bank_value'][$index] ?? null;
            $capitalInterest = $validatedData['capital_interest'][$index] ?? null;
            $otherBankInterest = $validatedData['other_bank_interest_' . $index] ?? null;

            // Check if all fields are null or empty
            if (empty($bankInterest) && is_null($allowedBankValue) && is_null($capitalInterest) && is_null($otherBankInterest)) {
                continue;
            }

            // Prepare data for update or insert
            $data = [
                'user_id' => $userId,
                'bank_interest' => $bankInterest,
                'allowed_bank_value' => $allowedBankValue,
                'capital_interest' => $capitalInterest,
                'other_bank_interest' => $otherBankInterest,
                'total_1' => $validatedData['total_1'],
                'total_2' => $validatedData['total_2'],
                'total_3' => $validatedData['total_3'],
                'total_4' => $validatedData['total_4'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Check if there's existing data to update
            if ($existingData->isNotEmpty() && isset($existingData[$index])) {
                // Update existing record
                $existingData[$index]->update($data);
            } else {
                // Add to data to insert array
                $dataToInsert[] = $data;
            }
        }

        // Insert new records
        if (!empty($dataToInsert)) {
            AppendixTwentyThree::insert($dataToInsert);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 24])->with('success', 'Appendix 23 updated successfully. Proceed to Appendix 24.');
    }

    public function updateAppendixTwentyFour(Request $request)
    {
        $validatedData = $request->validate([
            'type.*' => 'nullable|string',
            'value_of_provision_start.*' => 'nullable|numeric',
            'the_value.*' => 'nullable|numeric',
            'allowed_value.*' => 'nullable|numeric',
            'unallowed_value.*' => 'nullable|numeric',
            'recovery_allocations.*' => 'nullable|numeric',
            'value_of_provision_end.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        // Fetch existing data for the user
        $existingData = AppendixTwentyFour::where('user_id', $userId)->get();

        $dataToUpdate = [];
        $dataToInsert = [];

        foreach ($validatedData['type'] as $index => $type) {
            $valueOfProvisionStart = $validatedData['value_of_provision_start'][$index] ?? null;
            $theValue = $validatedData['the_value'][$index] ?? null;
            $allowedValue = $validatedData['allowed_value'][$index] ?? null;
            $unallowedValue = $validatedData['unallowed_value'][$index] ?? null;
            $recoveryAllocations = $validatedData['recovery_allocations'][$index] ?? null;
            $valueOfProvisionEnd = $validatedData['value_of_provision_end'][$index] ?? null;

            // Check if at least one of the numeric fields is filled
            if (
                !is_null($valueOfProvisionStart) ||
                !is_null($theValue) ||
                !is_null($allowedValue) ||
                !is_null($unallowedValue) ||
                !is_null($recoveryAllocations) ||
                !is_null($valueOfProvisionEnd)
            ) {
                $data = [
                    'user_id' => $userId,
                    'type' => $type,
                    'value_of_provision_start' => $valueOfProvisionStart,
                    'the_value' => $theValue,
                    'allowed_value' => $allowedValue,
                    'unallowed_value' => $unallowedValue,
                    'recovery_allocations' => $recoveryAllocations,
                    'value_of_provision_end' => $valueOfProvisionEnd,
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Check if there's existing data to update
                if ($existingData->isNotEmpty() && isset($existingData[$index])) {
                    // Update existing record
                    $existingData[$index]->update($data);
                } else {
                    // Add to data to insert array
                    $dataToInsert[] = $data;
                }
            }
        }

        // Insert new records
        if (!empty($dataToInsert)) {
            AppendixTwentyFour::insert($dataToInsert);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 25])->with('success', 'Appendix 24 updated successfully. Proceed to Appendix 25.');
    }

    public function updateAppendixTwentyFive(Request $request)
    {
        $validatedData = $request->validate([
            'tax_number.*' => 'nullable|string',
            'company_name.*' => 'nullable|string',
            'nationality.*' => 'nullable|string',
            'currency.*' => 'nullable|numeric',
            'value.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        // Fetch existing data for the user
        $existingData = AppendixTwentyFive::where('user_id', $userId)->get();

        $dataToUpdate = [];
        $dataToInsert = [];

        foreach ($validatedData['tax_number'] as $index => $taxNumber) {
            $companyName = $validatedData['company_name'][$index] ?? null;
            $nationality = $validatedData['nationality'][$index] ?? null;
            $currency = $validatedData['currency'][$index] ?? null;
            $value = $validatedData['value'][$index] ?? null;

            // Check if at least one of the numeric fields is filled
            if (
                !is_null($companyName) ||
                !is_null($nationality) ||
                !is_null($currency) ||
                !is_null($value)
            ) {
                $data = [
                    'user_id' => $userId,
                    'tax_number' => $taxNumber,
                    'company_name' => $companyName,
                    'nationality' => $nationality,
                    'currency' => $currency,
                    'value' => $value,
                    'total_1' => $validatedData['total_1'],
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Check if there's existing data to update
                if ($existingData->isNotEmpty() && isset($existingData[$index])) {
                    // Update existing record
                    $existingData[$index]->update($data);
                } else {
                    // Add to data to insert array
                    $dataToInsert[] = $data;
                }
            }
        }

        // Insert new records
        if (!empty($dataToInsert)) {
            AppendixTwentyFive::insert($dataToInsert);
        }

        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 26])->with('success', 'Appendix 25 updated successfully. Proceed to Appendix 26.');
    }

    public function updateAppendixTwentySix(Request $request)
    {
        $validatedData = $request->validate([
            'country.*' => 'nullable|string',
            'net_profit.*' => 'nullable|string',
            'income_tax_iqd.*' => 'nullable|string',
            'unused_foreign_tax_credit.*' => 'nullable|numeric',
            'total_foreign_tax.*' => 'nullable|numeric',
            'maximum_tax_credit.*' => 'nullable|numeric',
            'due_tax_approved_foreign_tax.*' => 'nullable|numeric',
            'allowable_foreign_tax.*' => 'nullable|numeric',
            'approval_foreign_tax.*' => 'nullable|numeric',
            'total_1' => 'nullable|numeric'
        ]);
    
        $userId = Auth::id();
    
        foreach ($validatedData['country'] as $index => $country) {
            $netProfit = $validatedData['net_profit'][$index] ?? null;
            $incomeTaxIqd = $validatedData['income_tax_iqd'][$index] ?? null;
            $unusedTax = $validatedData['unused_foreign_tax_credit'][$index] ?? null;
            $totalTax = $validatedData['total_foreign_tax'][$index] ?? null;
            $maximumTax = $validatedData['maximum_tax_credit'][$index] ?? null;
            $dueTax = $validatedData['due_tax_approved_foreign_tax'][$index] ?? null;
            $allowableTax = $validatedData['allowable_foreign_tax'][$index] ?? null;
            $approvalTax = $validatedData['approval_foreign_tax'][$index] ?? null;
    
            // Check if at least one of the fields is filled
            if (
                !is_null($country) ||
                !is_null($netProfit) ||
                !is_null($incomeTaxIqd) ||
                !is_null($unusedTax) ||
                !is_null($totalTax) ||
                !is_null($maximumTax) ||
                !is_null($dueTax) ||
                !is_null($allowableTax) ||
                !is_null($approvalTax)
            ) {
                $data = [
                    'user_id' => $userId,
                    'country' => $country,
                    'net_profit' => $netProfit,
                    'income_tax_iqd' => $incomeTaxIqd,
                    'unused_foreign_tax_credit' => $unusedTax,
                    'total_foreign_tax' => $totalTax,
                    'maximum_tax_credit' => $maximumTax,
                    'due_tax_approved_foreign_tax' => $dueTax,
                    'allowable_foreign_tax' => $allowableTax,
                    'approval_foreign_tax' => $approvalTax,
                    'total_1' => $validatedData['total_1'],
                    'updated_at' => now()
                ];
    
                // Check if the record exists
                $existingRecord = AppendixTwentySix::where('user_id', $userId)->where('country', $country)->first();
                
                if ($existingRecord) {
                    // Update existing record
                    $existingRecord->update($data);
                } else {
                    // Insert new record
                    $data['created_at'] = now();
                    AppendixTwentySix::create($data);
                }
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('appendix.show', ['number' => 27])->with('success', 'Appendix 26 updated successfully. Proceed to Appendix 27.');
    }

    public function updateAppendixTwentySeven(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'deduction_entity.*' => 'nullable|string',
            'tax_number.*' => 'nullable|string',
            'date_of_deduction.*' => 'nullable|date',
            'number.*' => 'nullable|integer',
            'date.*' => 'nullable|date',
            'amount_of_withheld_tax.*' => 'nullable|numeric',
            'notes.*' => 'nullable|string',
            'total_1' => 'nullable|numeric'
        ]);

        $userId = Auth::id();

        // Fetch existing records for the user
        $existingRecords = AppendixTwentySeven::where('user_id', $userId)->get();
        foreach ($validatedData['deduction_entity'] as $index => $entity) {
            if (
                !is_null($validatedData['tax_number'][$index]) &&
                !is_null($validatedData['date_of_deduction'][$index]) &&
                !is_null($validatedData['number'][$index]) &&
                !is_null($validatedData['date'][$index]) &&
                !is_null($validatedData['amount_of_withheld_tax'][$index]) &&
                !is_null($validatedData['notes'][$index])
            ) {
                // Find the corresponding existing record by index
                if (isset($existingRecords[$index])) {
                    $record = $existingRecords[$index];

                    // Update the existing record
                    $record->update([
                        'deduction_entity' => $entity,
                        'tax_number' => $validatedData['tax_number'][$index],
                        'date_of_deduction' => $validatedData['date_of_deduction'][$index],
                        'number' => $validatedData['number'][$index],
                        'date' => $validatedData['date'][$index],
                        'amount_of_withheld_tax' => $validatedData['amount_of_withheld_tax'][$index],
                        'notes' => $validatedData['notes'][$index],
                        'total_1' => $validatedData['total_1'],
                        'updated_at' => now()
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data updated successfully.');
    }

    







    


    


    

    
    

    

    

    

    
    

    
   
    




    
}
