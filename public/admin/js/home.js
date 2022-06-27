$(function() {
    var elm = $('#pieChart'), pieChartCanvas = elm.get(0).getContext('2d'), 
    data = elm.data('statistic').split(',');
    data = data.map(function(item) {
        return parseInt(item);
    })
    var pieData = {
        labels: [
            'Trống',
            'Đã thuê',
            'Ngưng hoạt động',
            'Đã cọc',
        ],
        datasets: [{
            data: data,
            backgroundColor: ['#dc3545', '#198754', '#6c757d', '#ffc107'],
        }]
    };
    var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

})
$(function() {
    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
    var pieData2 = {
        labels: [
            'Còn hiệu lực',
            'Hết hiệu lực',
        ],
        datasets: [{
            data: [700, 500],
            backgroundColor: ['#f56954', '#00a65a'],
        }]
    };
    var pieOptions2 = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas2, {
        type: 'pie',
        data: pieData2,
        options: pieOptions2
    })

})