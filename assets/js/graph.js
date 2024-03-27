document.addEventListener('DOMContentLoaded', function() {
    var ctx1 = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Inscrits', 'En attente'],
            datasets: [{
                label: 'Utilisateurs',
                data: [nombre_d_inscrits, nombre_d_inscrits_en_attente],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    var ctx2 = document.getElementById('statChart').getContext('2d');
    var statChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Vue sur le Site',
                data: dataValues,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

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
