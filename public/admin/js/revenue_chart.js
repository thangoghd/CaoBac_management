
// Shorten the amount of VND
function formatValue(value) {
    if (value >= 1000000) {
        return (value / 1000000).toFixed(2) + 'M';
    } else {
        return value;
    }
}

function getRandomColor() {
    // Generate a random color using the hex system
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}


function getScatterLineChartData()
{
    $.ajax({
        url: '/scatter-line-chart-data',
        method: 'GET',
        dataType: 'json',
        data:{
            'year': $('#year').val(),
            'from': $('#from').val(),
            'to': $('#to').val(),
        },
        success:function(data){
            // Insert chart into the canvas tag
            var ctx = document.getElementById('scatterLineChart').getContext('2d');

            // Declare the chart
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: "Kiểm được",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        //Push data into the line chart
                        data: data.map(item => item.total_payment_amount),
                    }],
                },
                
                options: {
                    maintainAspectRatio: true,
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
                            display: true,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value) {
                                return formatValue(value);
                            }
                        },
                            gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [10],
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
                            label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + formatValue(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function getAcountSouresData()
{
    $.ajax({
        url: '/doughnut-chart-data',
        method: 'GET',
        dataType: 'json',
        data:{},

        success: function(data) {
            const ctx = document.getElementById('doughnutChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: data.map(item => item.count), 
                        backgroundColor: data.map(() => getRandomColor()),
                    }],
                    labels: data.map(item => item.name),
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value*100 / sum).toFixed(2)+"%";
                                return percentage;                            
                            },
                            color: '#fff',
                        }
                    }
                }
            });
            
        },
        error: function(error) {
            console.error('Error fetching doughnut chart data:', error);
        }
    });
}



$(document).ready(function() {
    getScatterLineChartData();
    getAcountSouresData()
});
