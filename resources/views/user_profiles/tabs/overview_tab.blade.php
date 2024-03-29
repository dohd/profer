<div class="tab-pane fade show active profile-overview" id="profile-overview">
  <h5 class="card-title">Details</h5>
  @php
    $details = [
      'Full Name' => $user_profile->name,
      'Company' => @$user_profile->tenant->name,
      'Role' => 'Admin',
      'Town' => $user_profile->town,
      'Address' => $user_profile->address,
      'Phone' => $user_profile->phone,
      'Email' => $user_profile->email,
    ];
  @endphp
  @foreach ($details as $key => $value)
    <div class="row">
      <div class="col-lg-3 col-md-4 label">{{ $key }}</div>
      <div class="col-lg-9 col-md-8">{{ $value }}</div>
    </div>
  @endforeach
</div>