// admin_graph.js
$(document).ready(function() {
    // Fetch data using AJAX
    $.ajax({
      url: 'fetch_data.php', // Create a PHP file (fetch_data.php) to handle data retrieval
      method: 'GET',
      dataType: 'json',
      success: function(data) {
        createChart(data);
      },
      error: function(err) {
        console.error('Error fetching data:', err);
      }
    });
  
    // Function to create a chart
    function createChart(data) {
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar', // Choose the chart type (e.g., bar, line, pie)
        data: {
          labels: data.labels, // An array of labels (e.g., months)
          datasets: [{
            label: 'Total Sales',
            data: data.values, // An array of data values
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  });
  