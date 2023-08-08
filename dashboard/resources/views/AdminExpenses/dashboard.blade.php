@extends('master')
@section('title')
    <title>Dashboard Admin Expenses</title>
@stop
@section('extra_links')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Script Font Awesome-->
    <script src="https://kit.fontawesome.com/55c0c4353f.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Chart JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.js" integrity="sha512-a+uzkcbI/MyXYDayp12Y28mqzeAlzdKZRaJfhpyU8326w+oGqfqA3B73CMNl77D0N11FLOe8ZeHURAf6mnO8Jg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.esm.min.js" integrity="sha512-x5/OWp6+ZmVcHgn9/8L9ts51vU4pEA1JN3FpFbKKn5uMwVF25lM3NhbXlC62Aw0KZEiKNEWrcGnwrOb7QPHuEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.js" integrity="sha512-lUsN5TEogpe12qeV8NF4cxlJJatTZ12jnx9WXkFXOy7yFbuHwYRTjmctvwbRIuZPhv+lpvy7Cm9o8T9e+9pTrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.js" integrity="sha512-sLvQol0YcXzV+X/MY/VOWx4jw6AUrnTCTRgJaJFsNjdVfM3roYU9duIUPTlNR8lQjjH2phaQCU5/Yekar1M8Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/helpers.esm.min.js" integrity="sha512-m4VsSgMQ0Mw2iOS3ysNMINQNje3Q5c4AXeZXCVv60HjGMXy2iqZFo9c64itcXZ3ndsPOn5sOk4RgYWC1mBeEmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    {{HTML::style('css/admin/dashboard.css')}}
    {{HTML::script('js/AdminExpenses/dashboard.js')}}
@stop
@section('content')
<div class="container2">
    <div class="text-center" style="margin-bottom: 5px;">
        <h4>DASHBOARD ADMIN EXPENSES</h4>
        <h6>{{$currentDate}}</h6>
    </div>
    <div class="row hiddenMobile">       
        <div class="col text-left">
            <div class="row">
                <input class="inputsDate" type="text" id="datepicker" width="135" name="dateTimeline" autocomplete="off" placeholder="Start Date">
                <input class="inputsDate" type="text" id="datepicker2" width="135" name="dateTimeline" autocomplete="off" placeholder="End Date">
            </div>
        </div>
        <div class="col text-right" style="display: flex; justify-content: right; align-items: center;">
            <a class="btn btn-secondary responsiveText" href="#" role="button">ADD EXPENSE</a>
            <a class="btn btn-secondary responsiveText" href="#" role="button">ALL EXPENSES</a>
        </div>
    </div>

    <div class="btn-group btn-group-toggle hiddenDesktop" style="width: 100%;" data-toggle="buttons">
        <label class="btn btn-secondary active" style="width:100%; padding: 0px;" onclick="showDates()">
        <input type="radio" name="options" id="option1" autocomplete="off" checked > Dates
        </label>
        <label class="btn btn-secondary" style="width:100%; padding: 0px;" onclick="showActions()">
        <input type="radio" name="options" id="option2" autocomplete="off" > Actions
        </label>
    </div>
    
    <div id="mobileDates">
        <br>
        <div class="row">
            <div class="col-6 datepicker-container" style="padding-left: 35px;">
                <div class="datepicker-center">
                    <input class="inputsDate" type="text" id="datepicker3" width="135" name="dateTimeline" placeholder="Start Date" autocomplete="off">
                </div>
            </div>
            <div class="col-6 datepicker-container">
                <div class="datepicker-center">
                    <input class="inputsDate" type="text" id="datepicker4" width="135" name="dateTimeline" placeholder="End Date" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    
    <div id="mobileActions">
        <br>
        <div class="row text-center">
            <div class="col-6">
                <a class="btn btn-secondary responsiveText" href="#" role="button">ADD EXPENSE</a>
            </div>
            <div class="col-6">
                <a class="btn btn-secondary responsiveText" href="#" role="button">ALL EXPENSES</a>
            </div>
        </div>
    </div>

    <br>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" alt="First slide">
            <div class="row" style="height: 50%;">
                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-sm-1 col-md-2 text-center hiddenMobile" style="padding-top: 25px; padding-left:10px;">
                                        <i class="fas fa-dollar-sign fa-2x" ></i>
                                    </div>
                                    <div class="col-sm-11 col-md-10">
                                        <div class="card-body">
                                        <h6 class="card-title">Current Cost</h6>
                                        <p class="card-text">${{$totalCurrentCost}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-sm-1 col-md-2 text-center hiddenMobile" style="padding-top: 25px; padding-left:10px;">
                                        <i class="fas fa-dollar-sign fa-2x" ></i>
                                    </div>
                                    <div class="col-sm-11 col-md-10">
                                        <div class="card-body">
                                        <h6 class="card-title">Last Month</h6>
                                        <p class="card-text">${{$totalLastMonthCost}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="container3" style="width: 100%; height:100%;">
                        <canvas id="myBarChart" ></canvas>
                    </div>
                </div>
            </div>
          </div>

          <div class="carousel-item" alt="First slide">
            <div class="row" style="height: 50%;">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-sm-1 col-md-2 text-center hiddenMobile" style="padding-top: 25px; padding-left:10px;">
                                        <i class="fas fa-dollar-sign fa-2x" ></i>
                                    </div>
                                    <div class="col-sm-11 col-md-10">
                                        <div class="card-body">
                                            <h6 class="card-title">Office + Yard</h6>
                                            <p class="card-text">${{$totalOfficeYard}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-sm-1 col-md-2 text-center hiddenMobile" style="padding-top: 25px; padding-left:10px;">
                                        <i class="fas fa-dollar-sign fa-2x" ></i>
                                    </div>
                                    <div class="col-sm-11 col-md-10">
                                        <div class="card-body">
                                            <h6 class="card-title">Monthly Budget</h6>
                                            <p class="card-text">$50.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="container3" style="width: 100%; height:100%;">
                        <canvas id="myBarChart2" ></canvas>
                    </div>
                </div>
            </div>
          </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
    <br>

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <canvas id="myPieChart" ></canvas>
        </div>

        <div class="col-md-8 col-sm-12">
            <canvas id="mylineChart" ></canvas>
        </div>
    </div>

    <br>
    <div class="row" style="height: 35%;">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                  Projects
                </div>
                <div class="card-body">
                    <div class="container3" style="width: 100%; height:100%;">
                        <canvas id="myPieChart2" ></canvas>
                    </div>
                </div>
              </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                  Office
                </div>
                <div class="card-body">
                    <div class="container3" style="width: 100%; height:100%;">
                        <canvas id="myPieChart3" ></canvas>
                    </div>
                </div>
              </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                  Yard
                </div>
                <div class="card-body">
                    <div class="container3" style="width: 100%; height:100%;">
                        <canvas id="myPieChart4" ></canvas>
                    </div>
                </div>
              </div>
            
        </div>
    </div>
    
    
</div>
<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
    });   
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4',
    });
    $('#datepicker4').datepicker({
        uiLibrary: 'bootstrap4',
    });   
    /** EXPENSES PER MONTH - PRIMER GRÁFICO */
    const fechas = ['12/09/22','16/05/22'];
    const spent = ['456','578'];
    var myChart = document.getElementById('myBarChart');
    var chart = new Chart(myChart,{
        data: {
        datasets: [{
            type: 'bar',
            label: 'Expenses',
            data: [10, 20, 30, 40],
            borderWidth: 1, 
            borderColor: 'black',
            backgroundColor : ['#ff00d0','#006aff','#33ff00','#ff0000'],
            order: 2
        }, {
            type: 'scatter',
            label: 'Budget',
            data: [20, 10, 40, 50],
            backgroundColor : ['#000000','#000000','#000000','#000000'],
            order: 1
        }],
        labels: ['January', 'February', 'March', 'April']
    },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'black',
                        }
                        
                    },
                    font:{
                        size:15,
                        weight: 'bold',
                        backgroundColor:'white'
                    },
                }
            },
            maintainAspectRatio: false,
        },
    });

    /** OFFICE+YARD -BUDGET  - SEGUNDO GRÁFICO */
    const fechas2 = ['13/10/22','18/09/22'];
    const spent2 = ['300','792'];
    var myChart2 = document.getElementById('myBarChart2');
    var chart = new Chart(myChart2,{
        data: {
        datasets: [{
            type: 'bar',
            label: 'Expenses',
            data: [5, 8, 9, 10],
            borderWidth: 1, 
            borderColor: 'black',
            backgroundColor : ['#ff80d0','#906aff','#52ff0A','#fA8900'],
            order: 2
        }, {
            type: 'scatter',
            label: 'Budget',
            data: [9, 6, 8, 12],
            backgroundColor : ['#000000','#000000','#000000','#000000'],
            order: 1
        }],
        labels: ['January', 'February', 'March', 'April']
    },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'black',
                        }
                        
                    },
                    font:{
                        size:15,
                        weight: 'bold',
                        backgroundColor:'white'
                    },
                }
            },
            maintainAspectRatio: false,
        },
    });

    /** LINEAL CHART */
    const fechas3 = ['13/10/22','18/09/22'];
    const spent3 = ['300','792'];
    var myChart3 = document.getElementById('mylineChart');
    var chart = new Chart(myChart3,{
        data: {
        datasets: [{
            type: 'line',
            label: 'Expenses',
            data: [5, 8, 9, 10,5, 8, 9, 10,5, 8, 9, 10],
            borderWidth: 1, 
            borderColor: 'black',
            
            order: 2
        }, {
            type: 'line',
            label: 'Budget',
            data: [9, 6, 8, 12,9, 6, 8, 12,9, 6, 8, 12],
            borderWidth: 1, 
            borderColor: 'green',
            order: 1
        }],
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
    },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'black',
                        }
                        
                    },
                    font:{
                        size:15,
                        weight: 'bold',
                        backgroundColor:'white'
                    },
                }
            },
            maintainAspectRatio: false,
        },
    });

    /** PIE CHART */
    var categoryPieChart = @json($pieChartCategory);
    const categories = [];
    const spentCategory = [];
    const pieColor = [];
    categoryPieChart.forEach(element => categories.push(element.category));
    categoryPieChart.forEach(element => spentCategory.push(element.total));
    categoryPieChart.forEach(element => pieColor.push(element.color));
    var myChart4 = document.getElementById('myPieChart');
    var chart = new Chart(myChart4,{
        type:'pie',
        data:{
            labels:categories,
            datasets:[{
                label: categories,
                data:spentCategory,
                borderWidth: 1, 
                borderColor: '#ffffff',
                hoverBorderWidth: 3, 
                hoverBorderColor: '#ffffff',
                backgroundColor : pieColor
            }],
        },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'#ffffff'
                        }
                    },
                    font:{
                        size:13,
                        weight: 'bold',
                        backgroundColor:'#ffffff'
                    },
                    formatter: function(categories, myChart){
                        return myChart.chart.data.labels[myChart.dataIndex]+'\n'+'$'+categories; 
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    /** PIE CHART PROJECTS */
    var projectsPieChart = @json($projectPieChart);
    const categoriesProject = [];
    const spentCategoryProject = [];
    const pieColorProject = [];
    projectsPieChart.forEach(element => categoriesProject.push(element.categoryName));
    projectsPieChart.forEach(element => spentCategoryProject.push(element.total));
    projectsPieChart.forEach(element => pieColorProject.push(element.color));
    var myChart5 = document.getElementById('myPieChart2');
    var chart = new Chart(myChart5,{
        type:'pie',
        data:{
            labels:categoriesProject,
            datasets:[{
                label: categoriesProject,
                data:spentCategoryProject,
                borderWidth: 1, 
                borderColor: '#ffffff',
                hoverBorderWidth: 3, 
                hoverBorderColor: '#ffffff',
                backgroundColor : pieColorProject
            }],
        },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'#ffffff'
                        }
                    },
                    font:{
                        size:13,
                        weight: 'bold',
                        backgroundColor:'#ffffff'
                    },
                    formatter: function(categoriesProject, myChart5){
                        return myChart5.chart.data.labels[myChart5.dataIndex]+'\n'+'$'+categoriesProject; 
                    }
                },
                legend:{
                    labels:{
                        filter: (legendItem, data) => (typeof legendItem.text !== 'undefined')
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    /** PIE CHART OFFICE */
    var officePieChartJS = @json($officePieChart);
    const categoriesOffice = [];
    const totalOffice = [];
    const pieColorOffice = [];
    officePieChartJS.forEach(element => categoriesOffice.push(element.typeCategoryName));
    officePieChartJS.forEach(element => totalOffice.push(element.total));
    officePieChartJS.forEach(element => pieColorOffice.push(element.color));
    var myChart6 = document.getElementById('myPieChart3');
    var chart = new Chart(myChart6,{
        type:'pie',
        data:{
            labels:categoriesOffice,
            datasets:[{
                label: categoriesOffice,
                data:totalOffice,
                borderWidth: 1, 
                borderColor: '#ffffff',
                hoverBorderWidth: 3, 
                hoverBorderColor: '#ffffff',
                backgroundColor : pieColorOffice
            }],
        },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'#ffffff'
                        }
                    },
                    font:{
                        size:13,
                        weight: 'bold',
                        backgroundColor:'#ffffff'
                    },
                    formatter: function(categoriesOffice, myChart){
                        return myChart.chart.data.labels[myChart.dataIndex]+'\n'+'$'+categoriesOffice; 
                    }
                },
                legend:{
                    labels:{
                        filter: (legendItem, data) => (typeof legendItem.text !== 'undefined')
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    /** PIE CHART YARD */
    var yardPieChartJS = @json($yardPieChart);
    const categoriesYard = [];
    const totalYard = [];
    const pieColorYard = [];
    yardPieChartJS.forEach(element => categoriesYard.push(element.typeCategoryName));
    yardPieChartJS.forEach(element => totalYard.push(element.total));
    yardPieChartJS.forEach(element => pieColorYard.push(element.color));
    var myChart7 = document.getElementById('myPieChart4');
    var chart = new Chart(myChart7,{
        type:'pie',
        data:{
            labels:categoriesYard,
            datasets:[{
                label: categoriesYard,
                data:totalYard,
                borderWidth: 1, 
                borderColor: '#ffffff',
                hoverBorderWidth: 3, 
                hoverBorderColor: '#ffffff',
                backgroundColor : pieColorYard
            }],
        },
        options:{ 
            plugins:{
                datalabels:{
                    labels:{
                        value:{
                            color:'#ffffff'
                        }
                    },
                    font:{
                        size:13,
                        weight: 'bold',
                        backgroundColor:'#ffffff'
                    },
                    formatter: function(categoriesYard, myChart7){
                        return myChart7.chart.data.labels[myChart7.dataIndex]+'\n'+'$'+categoriesYard; 
                    }
                },
                legend:{
                    labels:{
                        filter: (legendItem, data) => (typeof legendItem.text !== 'undefined')
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
        }
    });

</script>
@stop


