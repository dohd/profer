<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Regional Activity Participant <span></span></h5>

      <!-- Column Chart -->
      <div id="regionalActivityParticipant"></div>

      <script>
        const regionDist = @json(@$region_dist);
        const regionPts = @json(@$region_pts);
        const maleDist = [];
        const femaleDist = [];
        regionPts.forEach(v => {
          maleDist.push(v['male_count']);
          femaleDist.push(v['female_count']);
        });

        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#regionalActivityParticipant"), {
            series: [{
              name: 'Male',
              // data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 23, 30, 10],
              data: maleDist,
              }, 
              {
                name: 'Female',
                // data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 25, 15, 42],
                data: femaleDist,
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
              // categories: ['Kisumu', 'Kakamega', 'Nairobi', 'Mombasa', 'Kisii', 'Nyeri', 'Machakos', 'Meru', 'Malindi', 'Eldoret', 'Isiolo', 'Busia'],
              categories: regionDist,
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