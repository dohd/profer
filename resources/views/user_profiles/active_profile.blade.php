@extends('layouts.core')

@section('title', 'User Profile')

@section('content')
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('user_profiles.active_profile') }}">User Profile</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ asset('img/profile-img.jpeg') }}" alt="Profile" class="rounded-circle">
            <h2>Super Admin</h2>
            <h3>Web Designer</h3>
            <div class="social-links mt-2">
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <!-- Overview -->
              @include('user_profiles.tabs.overview_tab')
              <!-- End Overview -->

              <!-- Profile Edit -->
              @include('user_profiles.tabs.profile_edit_tab')
              <!-- End Profile Edit -->

              <!-- Profile Settings -->
              @include('user_profiles.tabs.profile_settings_tab')
              <!-- End Profile Settings -->

              <!-- Profile Change Password -->
              @include('user_profiles.tabs.profile_change_password_tab')
              <!-- End Profile Change Password -->
            </div>
            <!-- End Bordered Tabs -->
          </div>
        </div>
      </div>
    </div>
  </section>
@stop