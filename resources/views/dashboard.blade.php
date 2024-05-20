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
                        <h6 class="card-title">{{ trans('general.top_product_supplier_wise') }}</h6>
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
                var processedSalesData = @json($processedSalesData);
                lineChart('quarterlyProdutSales', processedSalesData);
                var yearlySalesData = @json($filledSales);
                barChart('yearlySales', yearlySalesData);

                var TopfiveSalesProduct = @json($formattedData);
                donutChart('productWiseChart',TopfiveSalesProduct);
                var data = @json($data);
                pieChart('productWiseSupplier', data);
            });

            function lineChart(chartId, data)
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
                    series: data,
                    xaxis: {
                    type: "datetime",
                    categories: ["Q1", "Q2", "Q3", "Q4"]
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

            function barChart(chartId, data)
            {
                var years = data.map(function(item) {
                    return '01/01/'+item.year;
                });

                var totalSales = data.map(function(item) {
                    return item.total_sales;
                });

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
                    data: totalSales
                    }],
                    xaxis: {
                    type: 'datetime',
                    categories: years
                    }
                }

                var apexBarChart = new ApexCharts(document.querySelector("#"+chartId), options);

                apexBarChart.render();
            }

            function donutChart(chartId, data)
            {
                var productName = data.map(function(item) {
                    return item.product_name;
                });

                var totalQuantity = data.map(function(item) {
                    return item.total_quantity;
                });

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
                                series: totalQuantity,
                                labels: productName

                            };

                var chart = new ApexCharts(document.querySelector("#"+chartId), options);

                chart.render();
            }

            function pieChart(chartId, data)
            {
                var supplierNames = data.map(function(item) {
                    return item.supplier_name;
                });

                var productCounts = data.map(function(item) {
                    return item.product_count;
                });

                var options = {
                    chart: {
                        height: 300,
                        type: "pie"
                    },
                    colors: ["#f77eb9", "#7ee5e5","#4d8af0","#fbbc06", "#d3272f"],
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center'
                    },
                    stroke: {
                        colors: ['rgba(0,0,0,0)']
                    },
                    series: productCounts,
                    labels: supplierNames
                };


                var chart = new ApexCharts(document.querySelector("#"+chartId), options);

                chart.render();
            }


        </script>
    @endpush
</x-app-layout>
