<div class="row mb-3">
    <div class="col-md-10 col-12 mb-2">
        <label for="name">Program Name</label>
        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="col-md-4 col-12 mb-3">
        <label for="program">Programe Type</label>
        <select name="program_type" id="program_type" class="form-select">
            <option value="">-- Select Type --</option>
            @foreach (['Seek', 'Serve', 'Sacrifice'] as $program)
                <option value="{{ $program }}" {{ @$region->program_type == $program? 'selected' : '' }}>
                    {{ $program }}
                </option>
            @endforeach
        </select>
    </div>  
</div>
