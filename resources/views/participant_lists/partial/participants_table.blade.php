
<div class="responsive">
    <table class="table table-striped" id="participants_tbl">
        <thead>
            <tr class="">
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Gender</th>
                <th scope="col" width="10%">Age Group</th>
                <th scope="col">Disability</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Designation</th>
                <th scope="col">Organisation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- row template -->
            <tr>
                <th scope="row" class="p-3 num">1</th>
                <td><input type="text" name="name[]" class="form-control name"></td>
                <td>
                    <select name="gender[]" class="form-select gender">
                        @foreach (['male', 'female'] as $item)
                            <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="age_group_id[]" class="form-select custom agegrp" data-placeholder="Age">
                        <option value=""></option>
                        @foreach ($age_groups as $item)
                            <option value="{{ $item->id }}">{{ $item->bracket }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="disability_id[]" class="form-select custom dsblty" data-placeholder="Ds">
                        <option value=""></option>
                        @foreach ($disabilities as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="phone[]" class="form-control phone"></td>
                <td><input type="text" name="email[]" class="form-control email"></td>
                <td><input type="text" name="designation[]" class="form-control desig"></td>
                <td><input type="text" name="organisation[]" class="form-control org"></td>
                <td>
                    <a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs ml-1"></i></a> 
                </td>
                <input type="hidden" name="item_id[]">
            </tr>
            <!-- end template -->
    
            <!-- edit participant list items -->
            @isset($participant_list)
                @foreach ($participant_list->items as $i => $list_item)
                    <tr>
                        <th scope="row" class="p-3 num">{{ $i+1 }}</th>
                        <td><input type="text" name="name[]" class="form-control name" value="{{ $list_item->name }}"></td>
                        <td>
                            <select name="gender[]" class="form-select gender">
                                @foreach (['male', 'female'] as $item)
                                    <option value="{{ $item }}" {{ $item == $list_item->gender? 'selected' : '' }}>{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="age_group_id[]" class="form-select custom agegrp" data-placeholder="Age">
                                <option value=""></option>
                                @foreach ($age_groups as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $list_item->age_group_id? 'selected' : '' }}>{{ $item->bracket }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="disability_id[]" class="form-select custom dsblty" data-placeholder="Ds">
                                <option value=""></option>
                                @foreach ($disabilities as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $list_item->disability_id? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="phone[]" class="form-control phone" value="{{ $list_item->phone }}"></td>
                        <td><input type="text" name="email[]" class="form-control email" value="{{ $list_item->email }}"></td>
                        <td><input type="text" name="designation[]" class="form-control desig" value="{{ $list_item->designation }}"></td>
                        <td><input type="text" name="organisation[]" class="form-control org" value="{{ $list_item->organisation }}"></td>
                        <td>
                            <a class="dropdown-item pt-1 pb-1 del" href="javascript:"><i class="bi bi-trash text-danger icon-xs ml-1"></i></a> 
                        </td>
                        <input type="hidden" name="item_id[]" value="{{ $list_item->id }}">
                    </tr>
                @endforeach
            @endisset
            <!-- end edit -->
        </tbody>
    </table>
</div>
<h5>
    <span class="badge bg-primary addrow" role="button">
        <i class="bi bi-plus-lg"></i> add row
    </span>
</h5>