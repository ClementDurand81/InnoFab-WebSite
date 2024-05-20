document.addEventListener('DOMContentLoaded', function() {
    var ctx3 = document.getElementById('blogChart').getContext('2d');
    var blogChart = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: dataLabelsBlogs,
            datasets: [{
                label: 'Vues par Blog',
                data: dataValuesBlogs,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx4 = document.getElementById('machineChart').getContext('2d');
    var machineChart = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: dataLabelsMachines,
            datasets: [{
                label: 'Vues par Machine',
                data: dataValuesMachines,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
