<div class="row">

  <!--
    The following is JavaScript. This has been used to draw a graph to help display data on
    the Admin Panel main Dashboard.

    The function PopulateGraph is found on the;

    root/admin/php/AdminGraphManagement.php
  -->

  <!-- Chart script -->
  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php PopulateGraph(); ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <!-- Draw Graph -->
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


</div>
