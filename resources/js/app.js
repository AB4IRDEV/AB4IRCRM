import 'bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';


window.Alpine = Alpine;

Alpine.start();
// polar chart
var ctx = document.getElementById('myPolarChart').getContext('2d');
    var myPolarChart = new Chart(ctx, {
        type: 'polarArea', // Polar Area Chart type
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'My Polar Area Chart',
                data: [11, 16, 7, 4, 5, 8], // Data values
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false // This disables the legend
                }
            },
            responsive: true,
            scale: {
                ticks: {
                    beginAtZero: true
                }
            }
        }
    });

// total employee bar chart

const Toemp = document.getElementById('toEmployeeBar').getContext('2d');

const myBarChart = new Chart(Toemp, {
  type: 'bar',  // Type of chart
  data: {
    labels: ['January', 'February', 'March', 'April', 'May'], // X-axis labels
    datasets: [{
      label: 'Monthly Sales',  // Label for the dataset
      data: [65, 59, 80, 81, 56], // Data points for each month
      backgroundColor: 'rgba(54, 162, 235, 0.2)', // Bar color
      borderColor: 'rgba(54, 162, 235, 1)', // Border color
      borderWidth: 1 // Border width for bars
    }]
  },
  options: {
    responsive: true, // Makes the chart responsive
    scales: {
      y: {
        beginAtZero: true // Starts the Y-axis from 0
      }
    }
  }
});

