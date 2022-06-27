@extends('admin.layouts.master')
@section('title', 'Dashboard')
@push('css')
<style>
    .chart-area canvas {
        height: 300px !important;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="row p-2">
        <div class="col-12">
            <a class="btn btn-success text-uppercase" style="width: 100%">
                BÁO CÁO TỶ LỆ LẤP ĐẦY</a>
        </div>
        <div class="col-12 col-sm-6 text-center">
            <canvas id="pieChart" data-statistic="{{ implode(',', $marco) }}"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <div class="pt-3"></div>
            <a class="btn btn-white">Tỷ lệ lấp đầy</a>
        </div>
        <div class="col-12 col-sm-6 text-center">
            <canvas id="pieChart2"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            <div class="pt-3"></div>
            <a class="btn btn-white">Tỷ lệ hợp đồng</a>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-12">
            <a class="btn btn-success text-uppercase" style="width: 100%">
                THỐNG KÊ DOANH THU MỖI TÒA NHÀ HÀNG THÁNG</a>
        </div>
        <div class="col-12 chart-area shadow bg-white">
            <canvas id="statisticBuilding"></canvas>
        </div>
    </div>
    <div class="pt-5"></div>
    <div class="row p-2">
        <div class="col-md-9">
          <div>
              <a class="btn btn-success text-uppercase" style="width: 100%">
                  THỐNG KÊ DOANH THU HÀNG THÁNG</a>
          </div>
          <div class="chart-area shadow bg-white">
              <canvas id="statisticAll"></canvas>
          </div>
        </div>
        <div class="col-md-3">
          <div>
              <a class="btn btn-success text-uppercase" style="width: 100%">
                  THỐNG KÊ DOANH THU MỖI QUÝ</a>
          </div>
          <div class="chart-area shadow bg-white">
              <canvas id="statisticsQuarterly"></canvas>
          </div>
        </div>
    </div>
    <div class="pt-5"></div>
</div>

@endsection
@push('script')
<script src="{{ asset('public/admin/js/home.js') }}"></script>
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    // Area Chart Example
    var ctx = document.getElementById("statisticBuilding");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
            ],
            datasets: [
                @foreach($statistic_building as $key => $value) {
                    label: "{{ $value['name'] }}",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "#009c7e",
                    pointRadius: 3,
                    pointBackgroundColor: "#009c7e",
                    pointBorderColor: "#009c7e",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "#dc3545",
                    pointHoverBorderColor: "#dc3545",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: @json($value['invoices']),
                },
                @endforeach
            ],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + ' VNĐ';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VNĐ';
                    }
                }
            }
        }
    });

    // Area Chart Example
    var ctx = document.getElementById("statisticAll");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
            ],
            datasets: [{
                label: "Doanh thu hàng tháng",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "#009c7e",
                pointRadius: 3,
                pointBackgroundColor: "#009c7e",
                pointBorderColor: "#009c7e",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "#dc3545",
                pointHoverBorderColor: "#dc3545",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: @json($statistic_all),
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + ' VNĐ';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VNĐ';
                    }
                }
            }
        }
    });


    var ctx = document.getElementById("statisticsQuarterly");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Quý 1", "Quý 2", "Quý 3", "Quý 4"],
    datasets: [{
      data: @json($statistics_quarterly),
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'dc3545'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'dc3545'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
          label: function (tooltipItem, chart) {
            console.log(tooltipItem);
              var datasetLabel = chart.labels[tooltipItem.index] || '';
              return datasetLabel + ': ' + number_format(chart.datasets[0].data[tooltipItem.index]) + ' VNĐ';
          }
      }
    },
    legend: {
      display: true
    },
    cutoutPercentage: 80,
  },
});
</script>
@endpush
