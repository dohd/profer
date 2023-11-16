@extends('layouts.core')

@section('title', 'Beneficiary List Database')
    
@section('content')
    @include('reports.partial.beneficiary_list_header')
    <div class="card">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <label for="category">Beneficiary Category</label>
                        <select id="category" class="custom-select col-12 mt-2">
                            <option value="">-- Select Category --</option>
                            @foreach (['self-advocates' => 'Self-Advocates', 'families' => 'Families', 'support-groups' => 'Support Group'] as $key => $value)
                                <option value="{{ $key }}">
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-12 pt-3">
                        {{ Form::submit('Generate', ['class' => 'btn btn-primary btn-sm mt-3', 'id' => 'submit']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Self Advocates -->
    <div class="card self-advocates">
        <div class="card-body">
            <div class="card-title p-0 pt-2 m-0">SELF-ADVOCATES</div>
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead class="bg-light bg-gradient">
                            <tr>
                                <th>#Code</th>
                                <th>Beneficiary Name</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Main disability</th>
                                <th>Second disability</th>
                                <th>Third disability</th>
                                <th>Support Services</th>
                                <th>Support Service 1</th>
                                <th>Support Service 2</th>
                                <th>Support Service 3</th>
                                <th>NHIF Cover</th>
                                <th>Birth Cert. No.</th>
                                <th>NCPWD reg. No.</th>
                                <th>ID Card No.</th>
                                <th>Mobile no.</th>
                                <th>County</th> 
                                <th>Sub county</th>
                                <th>Location</th>
                                <th>Village</th>
                                <th>Caregiver's name</th>
                                <th>Caregiver's Contact</th>
                                <th>Source of income</th>
                                <th>Monthly income</th>
                                <th>School last attended</th>
                                <th>Type of training</th>
                                <th>Group name</th>
                                <th>Benefit 1</th>
                                <th>Benefit 2</th>
                                <th>Other Benefit</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Self Advocates -->

    <!-- Families -->
    <div class="card families">
        <div class="card-body">
            <div class="card-title p-0 pt-2 m-0">FAMILIES</div>
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead class="bg-light bg-gradient">
                            <tr>
                                <th>#Code</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Name of primary beneficiary</th>
                                <th>ID Card No.</th>
                                <th>Mobile no</th>.
                                <th>County </th>
                                <th>Sub county</th>
                                <th>Location</th>
                                <th>Village</th>
                                <th>Source of income</th>
                                <th>Caregiver's income level</th>
                                <th>Group's name</th>
                                <th>Benefit 1</th>
                                <th>Benefit 2</th>
                                <th>Benefit 3</th>
                                <th>Other Benefit</th>
                                <th>Support needed 1</th>
                                <th>Support needed 2</th>
                                <th>Support needed 3</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <!-- End families -->

    <!-- Support Group -->
    <div class="card support-groups">
        <div class="card-body">
            <div class="card-title p-0 pt-2 m-0">SUPPORT GROUP</div>
            <div class="card-content p-2">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead class="bg-light bg-gradient">
                            <tr>
                                <th>No.</th>
                                <th>Group name</th>
                                <th>Contact person</th>
                                <th>Mobile no.</th>
                                <th>County </th>
                                <th>Sub County</th>
                                <th>Location</th>
                                <th>Sub location</th>
                                <th>Village</th>
                                <th>Year of Formation</th>
                                <th>Activity 1</th>
                                <th>Activity 2</th>
                                <th>Other Activity</th>
                                <th>Males PWID</th>
                                <th>Female PWID</th>
                                <th>Total PWID</th>
                                <th>Male Caregivers</th>
                                <th>Female Caregivers</th>
                                <th>Total Caregivers</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Support Group -->
@stop

@section('script')
<script>
    $('#submit').click(function() {
        const category = $('#category').val();
        if (category == 'self-advocates') {
            $('div .' + category).removeClass('d-none');
            $('div .families').addClass('d-none');
            $('div .support-groups').addClass('d-none');
        } else if (category == 'families') {
            $('div .' + category).removeClass('d-none');
            $('div .self-advocates').addClass('d-none');
            $('div .support-groups').addClass('d-none');
        } else if (category == 'support-groups') {
            $('div .' + category).removeClass('d-none');
            $('div .families').addClass('d-none');
            $('div .self-advocates').addClass('d-none');
        } else {
            $('div.card').each(function() { $(this).removeClass('d-none') });
        }

        $('div.card').each(function() { $(this).find('table tbody').html('') });
        if (category) {
            $.post("{{ route('reports.beneficiary_list_data') }}", {category})
            .done(data => {
                $('div .' + category).find('table tbody').html(data);
            })
            .catch(err => err);
        }
    });
</script>
@stop

