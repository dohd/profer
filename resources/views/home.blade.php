@extends('layouts.core')

@section('title', 'Dashboard')

@section('content')
<main>
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <!-- Activities Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Activities <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-stack"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $activity_done_count }}</h6>
                    <span class="text-muted small pt-2 ps-1">Activities</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Activities Card -->

          <!-- Grants Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Grants <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{ route('proposals.index') }}" style="color:inherit"><i class="bi bi-currency-dollar"></i></a>
                  </div>
                  <div class="ps-3">
                    <h6 style="font-size: 1.2em">{{ numberFormat($project_budget) }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $project_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Projects</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Grants Card -->

          <!-- Donors Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Donors <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{ route('donors.index') }}" style="color:inherit"><i class="bi bi-tag"></i></a>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $donor_count }}</h6>
                    <span class="text-muted small pt-2 ps-1">Donors</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Donors Card -->

          <!-- Programmes Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Programmes <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{ route('programmes.index') }}" style="color:inherit"><i class="bi bi-file-earmark-text"></i></a>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $programmes_count }}</h6>
                    <span class="text-muted small pt-2 ps-1">Programmes</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Programmes Card -->

          <!-- Cohorts Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card revenue-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Cohorts <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{ route('cohorts.index') }}" style="color:inherit"><i class="bi bi-people"></i></a>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $cohorts_count }}</h6>
                    <span class="text-muted small pt-2 ps-1">Cohorts</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Cohorts Card -->

          <!-- Regions Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Regions <span></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <a href="{{ route('regions.index') }}" style="color:inherit"><i class="bi bi-geo-alt-fill"></i></a>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $regions_count }}</h6>
                    <span class="text-muted small pt-2 ps-1">Regions</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Regions Card -->
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <!-- Monthly Activity Participant Card -->
          @include('charts.activity_monthly_participant')
          <!-- End Monthly Activity Participant Card -->

          <!-- Regional Activity Participant Card -->
          @include('charts.activity_regional_participant')
          <!-- End Monthly Activity Participant Card -->
        </div>
      </div>
      <!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">
        <!-- Donor Activity Distribution -->
        @include('charts.activity_donor_dist')
        <!-- End Donor Activity Distribution -->

        <!-- Participant Age Distribution -->
        @include('charts.participant_age_dist')
        <!-- End Participant Age Distribution -->

        <!-- Participant Cohort Distribution -->
        @include('charts.participant_cohort_dist')
        <!-- End Participant Cohort Distribution -->
      </div>
      <!-- End Right side columns -->
    </div>
  </section>
</main>
@stop
