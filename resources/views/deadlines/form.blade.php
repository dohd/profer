<div class="row mb-3">
    <div class="col-md-10 col-12">
        <label for="subject">Subject</label>
        {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-3 col-12">
        <label for="date">Deadline Date</label>
        {{ Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) }}
    </div>
    <div class="col-md-4 col-12">
        <label for="module">Module</label>
        <select name="module" id="module" class="form-select" required>
            @foreach (['action-plan', 'agenda'] as $key => $item)
                <option value="{{ strtoupper($item) }}" {{ @$deadline->module == strtoupper($item)? 'selected' : '' }}>
                    {{ strtoupper($item) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 col-12">
        <label for="active">Deadline Status</label>
        <select name="active" id="active" class="form-select" required>
            @foreach (['inactive', 'active'] as $key => $item)
                <option value="{{ $key }}" {{ @$deadline->active == $key? 'selected' : '' }}>
                    {{ strtoupper($item) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
