require('./bootstrap');

Chart.defaults.global.defaultFontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"';
Chart.defaults.global.defaultFontColor = '#6a737d';

var ctx = document.getElementById('trafficChart');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: window.chartData.labels,
        datasets: [{
            yAxisID: 'count-y-axis',
            label: 'Count',
            lineTension: 0,
            data: window.chartData.count,
            borderColor: '#28a745',
            borderWidth: 2,
            fill: false,
            pointBackgroundColor: '#28a745',
            pointHoverBackgroundColor: '#28a745',
            pointBorderColor: '#fff',
            pointHoverBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 4
        },{
            yAxisID: 'uniques-y-axis',
            label: 'Uniques',
            lineTension: 0,
            data: window.chartData.uniques,
            borderColor: '#005cc5',
            borderWidth: 2,
            fill: false,
            pointBackgroundColor: '#005cc5',
            pointHoverBackgroundColor: '#005cc5',
            pointBorderColor: '#fff',
            pointHoverBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 4
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            backgroundColor: 'rgba(0,0,0,0.8)',
            titleFontSize: 12,
            titleFontStyle: 'bold',
            titleFontColor: '#959da5',
            titleMarginBottom: 13,
            bodyFontSize: 12,
            bodyFontColor: '#959da5',
            xPadding: 10,
            yPadding: 10,
            cornerRadius: 3
        },
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit: 'day',
                    tooltipFormat: 'dddd, MMMM D, YYYY',
                    displayFormats: {
                        day: 'M/D'
                    }
                },
                ticks: {
                    source: 'auto',
                    fontSize: 10,
                    padding: 7
                },
                gridLines: {
                    display: true,
                    color: 'rgba(27,31,35,0.1)',
                    drawBorder: false,
                    tickMarkLength: 6
                }
            }],
            yAxes: [{
                id: 'count-y-axis',
                position: 'left',
                ticks: {
                    padding: 5,
                    beginAtZero: true,
                    stepSize: 10,
                    fontSize: 10,
                    suggestedMax: chartData.ticksMax
                },
                gridLines: {
                    display: true,
                    drawOnChartArea: false,
                    drawTicks: true,
                    tickMarkLength: 5,
                    lineWidth: 2,
                    color: '#28a745',
                    zeroLineWidth: 2,
                    zeroLineColor: '#28a745',
                    borderDashOffset: 1
                }
            },{
                id: 'uniques-y-axis',
                position: 'right',
                ticks: {
                    padding: 5,
                    beginAtZero: true,
                    stepSize: 10,
                    fontSize: 10,
                    suggestedMax: chartData.ticksMax
                },
                gridLines: {
                    display: true,
                    drawOnChartArea: false,
                    drawTicks: true,
                    tickMarkLength: 5,
                    lineWidth: 2,
                    color: '#005cc5',
                    zeroLineWidth: 2,
                    zeroLineColor: '#005cc5',
                    borderDashOffset: 1
                }
            }]
        }
    }
});

$(function() {

    function onRangeChange(start, end) {
        var start = 'start=' + start.format('YYYY-MM-DD');
        var end = 'end=' + end.format('YYYY-MM-DD');
        window.location = window.location.href.replace( /[\?#].*|$/, '?' + start + '&' + end );
    }

    $('#dateRange').daterangepicker({
        startDate: moment(chartData.dateRange.startDate),
        endDate: moment(chartData.dateRange.endDate),
        minDate: moment(chartData.dateRange.minDate),
        maxDate: moment(chartData.dateRange.maxDate),
        alwaysShowCalendars: true,
        opens: 'center',
        ranges: {
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, onRangeChange);

});