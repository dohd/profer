<div class="card">
  <div class="card-body">
    <h5 class="card-title">Participant Age Distribution</h5>
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