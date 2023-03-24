<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Monthly Activity Participant <span></span></h5>

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