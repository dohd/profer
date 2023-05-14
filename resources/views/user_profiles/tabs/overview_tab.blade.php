<div class="tab-pane fade show active profile-overview" id="profile-overview">
  <h5 class="card-title">About</h5>
  <p class="small fst-italic">
    Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. 
    Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. 
    Fuga sequi sed ea saepe at unde.
  </p>

  <h5 class="card-title">Profile Details</h5>
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