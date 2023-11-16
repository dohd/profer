@if (request('category') == 'support-groups')
    @foreach ($support_groups as $i => $row)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $row->group_name }}</td>
            <td>{{ $row->contact_person }}</td>
            <td>{{ $row->mobile_no }}</td>
            <td>{{ $row->county }}</td>
            <td>{{ $row->sub_county }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->sub_location }}</td>
            <td>{{ $row->village }}</td>
            <td>{{ $row->formation_year }}</td>
            <td>{{ $row->activity_1 }}</td>
            <td>{{ $row->activity_2 }}</td>
            <td>{{ $row->other_activity }}</td>
            <td>{{ $row->male_pwd }}</td>
            <td>{{ $row->female_pwd }}</td>
            <td>{{ $row->total_pwd }}</td>
            <td>{{ $row->male_caregiver }}</td>
            <td>{{ $row->female_caregiver }}</td>
            <td>{{ $row->total_caregiver }}</td>
        </tr>
    @endforeach
@endif

@if (request('category') == 'families')
    @foreach ($families as $i => $row)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->gender }}</td>
            <td>{{ dateFormat($row->dob) }}</td>
            <td>{{ $row->primary_beneficiary }}</td>
            <td>{{ $row->id_card_no }}</td>
            <td>{{ $row->mobile_no }}</td>
            <td>{{ $row->county }}</td>
            <td>{{ $row->sub_county  }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->village }}</td>
            <td>{{ $row->source_of_income }}</td>
            <td>{{ $row->caregiver_income_level }}</td>
            <td>{{ $row->group_name }}</td>
            <td>{{ $row->benefit_1 }}</td>
            <td>{{ $row->benefit_2 }}</td>
            <td>{{ $row->benefit_3 }}</td>
            <td>{{ $row->other_benefit }}</td>
            <td>{{ $row->support_1 }}</td>
            <td>{{ $row->support_2 }}</td>
            <td>{{ $row->support_3 }}</td>
            <td>{{ $row->remarks }}</td>
        </tr>
    @endforeach
@endif

@if (request('category') == 'self-advocates')
    @foreach ($self_advocates as $i => $row)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $row->beneficiary_name }}</td>
            <td>{{ $row->gender }}</td>
            <td>{{ dateFormat($row->dob) }}</td>
            <td>{{ $row->disability_1 }}</td>
            <td>{{ $row->disability_2 }}</td>
            <td>{{ $row->disability_3 }}</td>
            <td>{{ $row->support_service_1 }}</td>
            <td>{{ $row->support_service_2 }}</td>
            <td>{{ $row->support_service_3 }}</td>
            <td>{{ $row->support_service_4 }}</td>
            <td>{{ $row->nhif_cover }}</td>
            <td>{{ $row->birth_cert_no }}</td>
            <td>{{ $row->ncpwd_reg_no  }}</td>
            <td>{{ $row->id_card_no  }}</td>
            <td>{{ $row->mobile_no  }}</td>
            <td>{{ $row->county  }}</td>
            <td>{{ $row->sub_county  }}</td>
            <td>{{ $row->location }}</td>
            <td>{{ $row->village }}</td>
            <td>{{ $row->caregiver_name }}</td>
            <td>{{ $row->caregiver_contact }}</td>
            <td>{{ $row->source_of_income }}</td>
            <td>{{ numberFormat($row->monthly_income) }}</td>
            <td>{{ $row->school_last_attended }}</td>
            <td>{{ $row->type_of_training }}</td>
            <td>{{ $row->group_name }}</td>
            <td>{{ $row->benefit_1 }}</td>
            <td>{{ $row->benefit_2 }}</td>
            <td>{{ $row->other_benefit }}</td>
            <td>{{ $row->remarks }}</td>
        </tr>
    @endforeach
@endif
