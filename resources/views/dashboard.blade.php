<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ trans('general.dashboard') }}"></x-page-heading>
        <x-alert></x-alert>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ trans('general.quarterly_product_sales') }}</h6>
                        <div id="quarterlyProdutSales"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ trans('general.yearly_sales') }}</h6>
                        <div id="yearlySales"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ trans('general.product_category_wise') }}</h6>
                        <div id="productWiseChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ trans('general.product_supplier_wise') }}</h6>
                        <div id="productWiseSupplier"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/apexcharts.js') }}"></script>
        <script>
            $(document).ready(function(){
                lineChart('quarterlyProdutSales');
                barChart('yearlySales');
                donutChart('productWiseChart');
                pieChart('productWiseSupplier');
            });

            function lineChart(chartId)
            {
                // Apex Line chart start
                var options = {
                    chart: {
                    height: 300,
                    type: "line",
                    parentHeightOffset: 0
                    },
                    colors: ["#f77eb9", "#7ee5e5","#4d8af0"],
                    grid: {
                    borderColor: "rgba(77, 138, 240, .1)",
                    padding: {
                        bottom: -6
                    }
                    },
                    series: [
                    {
                        name: "Product A",
                        data: [45, 52, 38, 45]
                    },
                    {
                        name: "Product B",
                        data: [12, 42, 68, 33]
                    },
                    {
                        name:
                        "Product C",
                        data: [8, 32, 48, 53]
                    }
                    ],
                    xaxis: {
                    type: "datetime",
                    categories: ["2015", "2016", "2017", "2018"]
                    },
                    markers: {
                    size: 0
                    },
                    stroke: {
                    width: 3,
                    curve: "smooth",
                    lineCap: "round"
                    },
                    legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'left',
                    containerMargin: {
                        top: 30
                    }
                    },
                    responsive: [
                    {
                        breakpoint: 500,
                        options: {
                        legend: {
                            fontSize: "11px"
                        }
                        }
                    }
                    ]
                };
                var apexLineChart = new ApexCharts(document.querySelector("#"+chartId), options);
                apexLineChart.render()
            }

            function barChart(chartId)
            {
                // Apex Bar chart start
                var options = {
                    chart: {
                    type: 'bar',
                    height: '320',
                    parentHeightOffset: 0
                    },
                    colors: ["#f77eb9"],
                    grid: {
                    borderColor: "rgba(77, 138, 240, .1)",
                    padding: {
                        bottom: -6
                    }
                    },
                    series: [{
                    name: 'sales',
                    data: [30,40,45,50,49,60,70,91,125]
                    }],
                    xaxis: {
                    type: 'datetime',
                    categories: ['01/01/1991','01/01/1992','01/01/1993','01/01/1994','01/01/1995','01/01/1996','01/01/1997', '01/01/1998','01/01/1999']
                    }
                }

                var apexBarChart = new ApexCharts(document.querySelector("#"+chartId), options);

                apexBarChart.render();
            }

            function donutChart(chartId){
                var options = {
                                chart: {
                                height: 300,
                                type: "donut"
                                },
                                stroke: {
                                colors: ['rgba(0,0,0,0)']
                                },
                                colors: ["#f77eb9", "#7ee5e5","#4d8af0","#fbbc06"],
                                legend: {
                                position: 'top',
                                horizontalAlign: 'center'
                                },
                                dataLabels: {
                                enabled: false
                                },
                                series: [44, 55, 13, 33]
                            };

                var chart = new ApexCharts(document.querySelector("#"+chartId), options);

                chart.render();
            }

            function pieChart(chartId)
            {
                // Apex Pie chart end
                var options = {
                    chart: {
                    height: 300,
                    type: "pie"
                    },
                    colors: ["#f77eb9", "#7ee5e5","#4d8af0","#fbbc06"],
                    legend: {
                    position: 'top',
                    horizontalAlign: 'center'
                    },
                    stroke: {
                    colors: ['rgba(0,0,0,0)']
                    },
                    dataLabels: {
                    enabled: false
                    },
                    series: [44, 55, 13, 33]
                };

                var chart = new ApexCharts(document.querySelector("#"+chartId), options);

                chart.render();
            }


        </script>
    @endpush
</x-app-layout>
