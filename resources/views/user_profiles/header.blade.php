<div class="pagetitle">
  <h1>
    User Profile Management
    <div class="float-end">
      <a href="{{ route('user_profiles.index') }}" class="btn btn-secondary"><i class="bi bi-card-list"></i> List</a>
      <a href="{{ route('user_profiles.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create</a>
    </div>
  </h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('user_profiles.index') }}">User Profiles</a></li>
    </ol>
  </nav>
</div>