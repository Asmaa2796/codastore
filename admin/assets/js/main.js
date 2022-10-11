/*global $*/
$(function () {
    "use strict";
    $(document).on('click','.delete_category_btn',function(e){
        e.preventDefault();
        var id = $(this).val();
        // alert(id);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'category_id' : id,
                    'delete_category_btn' : true
                },
                success: function (response) {
                    console.log(response);
                    if(response == 200) {
                        swal("Success", "Category deleted successfully", "success");
                        $('#categories_table').load(location.href + " #categories_table");
                    }
                    else if (response == 500) {
                        swal("Error", "Something went wrong", "error");
                    }
                }
              });
            }
            // else {
            //   swal("Your imaginary file is safe!");
            // }
          });
    });
    $(document).on('click','.delete_product_btn',function(e){
        e.preventDefault();
        var id = $(this).val();
        // alert(id);
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'product_id' : id,
                    'delete_product_btn' : true
                },
                success: function (response) {
                    console.log(response);
                    if(response == 200) {
                        swal("Success", "Product deleted successfully", "success");
                        $('#products_table').load(location.href + " #products_table");
                    }
                    else if (response == 500) {
                        swal("Error", "Something went wrong", "error");
                    }
                }
              });
            }
            // else {
            //   swal("Your imaginary file is safe!");
            // }
          });
    });

    // doughnut 1
  var data = {
    labels: [
      'Sign ups',
      'Rates',
      'Revenue'
    ],
    datasets: [{
      label: '',
      data: [20, 40, 20],
      backgroundColor: [
        '#DC3545',
        '#27A243',
        '#FFC107'
      ],
      hoverOffset: 5
    }]
  };
  var options = {
    cutoutPercentage: 80
  };
  var config = {
    type: 'doughnut',
    data: data,
    options: options
  };

  var doughnut1 = new Chart(
    document.getElementById('doughnut1'),
    config
  );
  // bar

  var ctx = document.getElementById("mybarChart").getContext("2d");

var mybarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['1', '2', '3'],
    datasets: [{
      label: 'lorem 1',
      backgroundColor: "#DC3545",
      data: [90,0,0]
    }, {
      label: 'lorem 2',
      backgroundColor: "#27A243",
      data: [0,70,0]
    }, {
      label: 'lorem 3',
      backgroundColor: "#FFC107",
      data: [0,0,45]
    }]
  },

  options: {
    legend: {
      display: true,
      position: 'top',
      labels: {
        fontColor: "#333",
      }
    },
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
