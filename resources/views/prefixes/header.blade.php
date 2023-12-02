<div class="pagetitle">
  <div class="row">
    <div class="col-6">
      <h1>Code Prefixes</h1>
    </div>
    <div class="col-6">
      @can('view-code-prefix')
      <a href="{{ route('prefixes.index') }}" class="btn btn-secondary float-end"><i class="bi bi-card-list"></i> List</a> 
      @endcan
    </div>
  </div>
  
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('prefixes.index') }}">Code Prefixes</a></li>
    </ol>
  </nav>
</div>