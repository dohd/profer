@php
  $is_project = request('is_project');
  $title = $is_project? 'Project Management' : 'Proposal Management';
@endphp
<div class="pagetitle">
  <h1>
    {{ $title }}
    <div class="float-end">
      @if (request('is_project'))
        <a href="{{ route('proposals.index', request()->only('is_project')) }}" class="btn btn-secondary">List</a>
      @else
        <a href="{{ route('proposals.create') }}" class="btn btn-primary">Create</a>
        <a href="{{ route('proposals.index') }}" class="btn btn-secondary">List</a>
      @endif
    </div>
  </h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('proposals.index', request()->only('is_project')) }}">{{ $title }} / {{ $is_project? 'Project' : 'Proposal' }}</a></li>
    </ol>
  </nav>
</div>