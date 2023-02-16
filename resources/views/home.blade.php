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
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <!-- Activities Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" ><i class="bi bi-three-dots"></i></a>
              </div>
              <div class="card-body">
                <h5 class="card-title">Activities <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-stack"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $activity_count }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $activity_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
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
                <h5 class="card-title">Grants <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ numberFormat($grant_amount) }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $approved_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
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
                <h5 class="card-title">Donors <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-tag"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $donor_count }}</h6>
                    <span class="text-danger small pt-1 fw-bold">{{ $approved_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
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
                <h5 class="card-title">Programmes <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark-text"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $programmes_count }}</h6>
                    <span class="text-danger small pt-1 fw-bold">{{ $approved_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
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
                <h5 class="card-title">Cohorts <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $cohorts_count }}</h6>
                    <span class="text-danger small pt-1 fw-bold">{{ $approved_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
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
                <h5 class="card-title">Regions <span>| Collective</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $regions_count }}</h6>
                    <span class="text-danger small pt-1 fw-bold">{{ $approved_proposal_count }}</span>
                    <span class="text-muted small pt-2 ps-1">Project</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Regions Card -->

          <!-- Monthly Activity Participants Card -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Monthly Activity Participants <span>| Collective</span></h5>
  
                <!-- Column Chart -->
                <div id="monthlyActivityParticipant"></div>
  
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#monthlyActivityParticipant"), {
                      series: [{
                        name: 'Male',
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 23, 30, 10]
                        }, 
                        {
                          name: 'Female',
                          data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 25, 15, 42]
                        },
                      ],
                      chart: {
                        type: 'bar',
                        height: 350
                      },
                      plotOptions: {
                        bar: {
                          horizontal: false,
                          columnWidth: '55%',
                          endingShape: 'rounded'
                        },
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                      },
                      xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                      },
                      yaxis: {
                        title: {
                          text: 'Count'
                        }
                      },
                      fill: {
                        opacity: 1
                      },
                      tooltip: {
                        y: {
                          formatter: function(val) {
                            return val + " participants"
                          }
                        }
                      }
                    }).render();
                  });
                </script>
                <!-- End Column Chart -->
  
              </div>
            </div>
          </div>
          <!-- End Monthly Activity Participants Card -->

          <!-- Regional Activity Participants Card -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Regional Activity Participants <span>| Collective</span></h5>
                <!-- Column Chart -->
                <div id="regionalActivityParticipant"></div>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#regionalActivityParticipant"), {
                      series: [{
                        name: 'Male',
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 23, 30, 10],
                        }, 
                        {
                          name: 'Female',
                          data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 25, 15, 42],
                        },
                      ],
                      colors: ['#6f42c1', '#d63384'],
                      chart: {
                        type: 'bar',
                        height: 350
                      },
                      plotOptions: {
                        bar: {
                          horizontal: true,
                          columnWidth: '55%',
                          endingShape: 'rounded'
                        },
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                      },
                      xaxis: {
                        categories: ['Kisumu', 'Kakamega', 'Nairobi', 'Mombasa', 'Kisii', 'Nyeri', 'Machakos', 'Meru', 'Malindi', 'Eldoret', 'Isiolo', 'Busia'],
                      },
                      yaxis: {
                        title: {
                          text: 'Region'
                        },
                        
                      },
                      fill: {
                        opacity: 1
                      },
                      tooltip: {
                        y: {
                          formatter: function(val) {
                            return val + " participants"
                          }
                        }
                      }
                    }).render();
                  });
                </script>
                <!-- End Column Chart -->
              </div>
            </div>
          </div>
          <!-- End Monthly Activity Participants Card -->
        </div>
      </div>
      <!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">
        <!-- Recent Activity -->
        <div class="card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"
              ><i class="bi bi-three-dots"></i
            ></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow d-none">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>

          <div class="card-body">
            <h5 class="card-title">Recent Activity <span>| This Month</span></h5>

            <div class="activity">
              <div class="activity-item d-flex">
                <div class="activite-label">32 min</div>
                <i
                  class="bi bi-circle-fill activity-badge text-success align-self-start"
                ></i>
                <div class="activity-content">
                  Quia quae rerum
                  <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                  beatae
                </div>
              </div>
              <!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">56 min</div>
                <i
                  class="bi bi-circle-fill activity-badge text-danger align-self-start"
                ></i>
                <div class="activity-content">
                  Voluptatem blanditiis blanditiis eveniet
                </div>
              </div>
              <!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">2 hrs</div>
                <i
                  class="bi bi-circle-fill activity-badge text-primary align-self-start"
                ></i>
                <div class="activity-content">
                  Voluptates corrupti molestias voluptatem
                </div>
              </div>
              <!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">1 day</div>
                <i
                  class="bi bi-circle-fill activity-badge text-info align-self-start"
                ></i>
                <div class="activity-content">
                  Tempore autem saepe
                  <a href="#" class="fw-bold text-dark">occaecati voluptatem</a>
                  tempore
                </div>
              </div>
              <!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">2 days</div>
                <i
                  class="bi bi-circle-fill activity-badge text-warning align-self-start"
                ></i>
                <div class="activity-content">
                  Est sit eum reiciendis exercitationem
                </div>
              </div>
              <!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">4 weeks</div>
                <i
                  class="bi bi-circle-fill activity-badge text-muted align-self-start"
                ></i>
                <div class="activity-content">
                  Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                </div>
              </div>
              <!-- End activity item-->
            </div>
          </div>
        </div>
        <!-- End Recent Activity -->

        <!-- Participants Age Distribution -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Participants Age Distribution</h5>
              <!-- Pie Chart -->
              <div id="participantAgeDistribution"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#participantAgeDistribution"), {
                    series: [44, 60, 13,],
                    chart: {
                      height: 350,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: ['Under 18', 'Btwn 18 & 35', 'Above 35']
                  }).render();
                });
              </script>
              <!-- End Pie Chart -->
            </div>
          </div>
        <!-- End Participants Age Distribution -->

        <!-- Participants Cohort Distribution -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Participants Cohort Distribution</h5>
            <!-- Donut Chart -->
            <div id="participantCohortDistribution"></div>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#participantCohortDistribution"), {
                  series: [44, 56, 12, 20],
                  chart: {
                    height: 350,
                    type: 'donut',
                    toolbar: {
                      show: true
                    }
                  },
                  labels: ['Youth', 'Students', 'Teachers', 'Patients'],
                }).render();
              });
            </script>
            <!-- End Participants Cohort Distribution -->

          </div>
        </div>
      </div>
      <!-- End Right side columns -->
    </div>
  </section>
</main>
@stop
