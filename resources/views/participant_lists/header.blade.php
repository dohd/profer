<div class="pagetitle">
  <div class="row">
    <h1 class="col-sm-10 col-xs-12">Participant List Management</h1>
    <div class="col-sm-2 col-xs-12">
      <a href="{{ route('participant_lists.index') }}" class="btn btn-secondary">List</a>
      <a href="{{ route('participant_lists.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Create</a>
    </div>
  </div>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('participant_lists.index') }}">Participant List</a></li>
    </ol>
  </nav>
</div>