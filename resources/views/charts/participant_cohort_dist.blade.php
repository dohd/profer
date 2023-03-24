<div class="card">
  <div class="card-body">
    <h5 class="card-title">Participant Cohort Distribution</h5>
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
  </div>
</div>