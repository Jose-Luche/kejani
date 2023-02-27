<!-- Content Wrapper. Contains page content -->

@extends('admin.admin_master')
@section('admin')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   

<div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row">

         <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-body">
                <h4 class="box-title">Monthly Revenue</h4>
                <div>
                  <canvas id="bar-chart1" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          <script>
            const ctx = document.getElementById('bar-chart1');
          
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                  label: 'Revenue',
                  data: [60000, 45000, 52000, 50000, 48000, 30000, 25000, 32000, 42000, 67000, 45000, 26000 ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          </script>

          <div class="col-xl-6 col-12">
            <div class="box">
              <div class="box-body">
                <h4 class="box-title">Doughnut Chart</h4>
                <div>
                  <canvas id="doughnut-chart" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>

          

          <script>
            const pie = document.getElementById('doughnut-chart');
            new Chart(pie, {
              type: 'doughnut',
              data: {
                labels: ['Red','Blue','Yellow'],
                datasets: [{
                  label: 'My First Dataset',
                  data: [300, 50, 100],
                  backgroundColor: ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)'],
                  hoverOffset: 4
                }]
              },
            });
          </script>

        </div>

      </section>
      
      
      
      
      
      <!-- /.content -->
    </div>
</div>
@endsection
<!-- /.content-wrapper -->
