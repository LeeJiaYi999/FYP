<?php
session_start();
include("db_connection.php");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        include("sidebar.php");
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="right-side">
                <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>2</h3>
                                    <p>Total Employees</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-stalker"></i>
                                </div>
                                <a href="employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>100.00<sup style='font-size: 20px'>%</sup></h3>          
                                    <p>On Time Percentage</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="viewAttendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>0</h3>             
                                    <p>On Time Today</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-clock"></i>
                                </div>
                                <a href="viewAttendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>0</h3>
                                    <p>Late Today</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="viewAttendance.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Monthly Attendance Report</h3>
                                    <div class="box-tools pull-right">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label>Select Year: </label>
                                                <select class="form-control input-sm" id="select_year">

                                                    <option value='2015' >2015</option>

                                                    <option value='2016' >2016</option>

                                                    <option value='2017' >2017</option>

                                                    <option value='2018' >2018</option>

                                                    <option value='2019' >2019</option>

                                                    <option value='2020' >2020</option>

                                                    <option value='2021' selected>2021</option>

                                                    <option value='2022' >2022</option>

                                                    <option value='2023' >2023</option>

                                                    <option value='2024' >2024</option>

                                                    <option value='2025' >2025</option>

                                                    <option value='2026' >2026</option>

                                                    <option value='2027' >2027</option>

                                                    <option value='2028' >2028</option>

                                                    <option value='2029' >2029</option>

                                                    <option value='2030' >2030</option>

                                                    <option value='2031' >2031</option>

                                                    <option value='2032' >2032</option>

                                                    <option value='2033' >2033</option>

                                                    <option value='2034' >2034</option>

                                                    <option value='2035' >2035</option>

                                                    <option value='2036' >2036</option>

                                                    <option value='2037' >2037</option>

                                                    <option value='2038' >2038</option>

                                                    <option value='2039' >2039</option>

                                                    <option value='2040' >2040</option>

                                                    <option value='2041' >2041</option>

                                                    <option value='2042' >2042</option>

                                                    <option value='2043' >2043</option>

                                                    <option value='2044' >2044</option>

                                                    <option value='2045' >2045</option>

                                                    <option value='2046' >2046</option>

                                                    <option value='2047' >2047</option>

                                                    <option value='2048' >2048</option>

                                                    <option value='2049' >2049</option>

                                                    <option value='2050' >2050</option>

                                                    <option value='2051' >2051</option>

                                                    <option value='2052' >2052</option>

                                                    <option value='2053' >2053</option>

                                                    <option value='2054' >2054</option>

                                                    <option value='2055' >2055</option>

                                                    <option value='2056' >2056</option>

                                                    <option value='2057' >2057</option>

                                                    <option value='2058' >2058</option>

                                                    <option value='2059' >2059</option>

                                                    <option value='2060' >2060</option>

                                                    <option value='2061' >2061</option>

                                                    <option value='2062' >2062</option>

                                                    <option value='2063' >2063</option>

                                                    <option value='2064' >2064</option>

                                                    <option value='2065' >2065</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <br>
                                        <div id="legend" class="text-center"></div>
                                        <canvas id="barChart" style="height:350px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </aside>
            

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>       



        <script>
            $(function () {
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [
                        {
                            label: 'Late',
                            fillColor: 'rgba(210, 214, 222, 1)',
                            strokeColor: 'rgba(210, 214, 222, 1)',
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]},
                        {
                            label: 'Ontime',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]}
                    ]
                }
                barChartData.datasets[1].fillColor = '#00a65a'
                barChartData.datasets[1].strokeColor = '#00a65a'
                barChartData.datasets[1].pointColor = '#00a65a'
                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true
                }

                barChartOptions.datasetFill = false
                var myChart = barChart.Bar(barChartData, barChartOptions)
                document.getElementById('legend').innerHTML = myChart.generateLegend();
            });
        </script>

        <script>
            $(function () {
                $('#select_year').change(function () {
                    window.location.href = 'home.php?year=' + $(this).val();
                });
            });
        </script>

    </body>
</html>