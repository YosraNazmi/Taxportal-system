@extends('Taxpayer.AnnualTaxForm')

@section('AppendixFourteen')
<div class="custom-container mt-5">
    <br>
    <h4 class="text-center  custom-header">Appendix #14 Inventory and Warehouse Statement</h4>
    <h5 class="custom-header-2">Inventory Statement</h5>
    <form action="{{route('AppendixFourteen.store')}}" method="POST">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-bordered custom-table form-table ">
            <thead>
                <tr>
                    <th>code</th>
                    <th>Explanation</th>
                    <th class="text-center">The Beginning of the Year</th>
                    <th class="text-center">End of Year</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>100</td>
                    <td>Raw Materials</td>
                    <td><input type="text" name="beginning_of_year[]" class="form-control"></td>
                    <td><input type="text" name="end_of_year[]" class="form-control"></td>
                
                </tr>
                <tr>
                    <td>110</td>
                    <td>Work in process</td>
                    <td><input type="text" name="beginning_of_year[]" class="form-control"></td>
                    <td><input type="text" name="end_of_year[]" class="form-control"></td>
                
                </tr>
                <tr>
                    <td>120</td>
                    <td>Finished Goods</td>
                    <td><input type="text" name="beginning_of_year[]" class="form-control"></td>
                    <td><input type="text" name="end_of_year[]" class="form-control"></td>
                </tr>
            </tbody>
        </table>

        <h5 class="custom-header-2">Warehouse Statement</h5>
        <table class="table table-bordered custom-table form-table">
            <thead>
                <tr>
                    <th rowspan="2">Number</th>
                    <th rowspan="2">Warehouse Address</th>
                    <th rowspan="2">Area</th>
                    <th colspan="3" class="text-center">Property Type</th>
                    <th rowspan="2">In case of Rent: The Name of the Owner</th>
                </tr>
                <tr>
                    <th class="text-center">Privately Owned</th>
                    <th class="text-center">Musataha</th>
                    <th class="text-center">Rent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="warehouse_address[]" class="form-control"></td>
                    <td><input type="text" name="area[]" class="form-control"></td>
                    <td class="text-center"><input name="private_owned[]" type="checkbox"></td>
                    <td class="text-center"><input name="musataha[]" type="checkbox"></td>
                    <td class="text-center"><input name="rent[]" type="checkbox"></td>
                    <td><input type="text" name="rent_owner_name[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="warehouse_address[]" class="form-control"></td>
                    <td><input type="text" name="area[]" class="form-control"></td>
                    <td class="text-center"><input name="private_owned[]" type="checkbox"></td>
                    <td class="text-center"><input name="musataha[]" type="checkbox"></td>
                    <td class="text-center"><input name="rent[]" type="checkbox"></td>
                    <td><input type="text" name="rent_owner_name[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="warehouse_address[]" class="form-control"></td>
                    <td><input type="text" name="area[]" class="form-control"></td>
                    <td class="text-center"><input name="private_owned[]" type="checkbox"></td>
                    <td class="text-center"><input name="musataha[]" type="checkbox"></td>
                    <td class="text-center"><input name="rent[]" type="checkbox"></td>
                    <td><input type="text" name="rent_owner_name[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><input type="text" name="warehouse_address[]" class="form-control"></td>
                    <td><input type="text" name="area[]" class="form-control"></td>
                    <td class="text-center"><input name="private_owned[]" type="checkbox"></td>
                    <td class="text-center"><input name="musataha[]" type="checkbox"></td>
                    <td class="text-center"><input name="rent[]" type="checkbox"></td>
                    <td><input type="text" name="rent_owner_name[]" class="form-control"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><input type="text" name="warehouse_address[]" class="form-control"></td>
                    <td><input type="text" name="area[]" class="form-control"></td>
                    <td class="text-center"><input name="private_owned[]" type="checkbox"></td>
                    <td class="text-center"><input name="musataha[]" type="checkbox"></td>
                    <td class="text-center"><input name="rent[]" type="checkbox"></td>
                    <td><input type="text" name="rent_owner_name[]" class="form-control"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
        
</div>
@endsection