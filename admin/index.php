<?php
include("includes/navbar.php");
include("../middleware/adminMiddleware.php");
?>

<h3 class="text-center title"> Admin dashboard</h3>

<div class="row welcome">
    <div class="col-md-4">
        <div class="card text-center shadow my-2 text-white bg-warning">
            <div class="card-header" style="font-weight: bold;font-size:22px">
                Sign ups
            </div>
            <div class="card-body">
                <div class="text-right">
                    <strong>114</strong>
                    <p><b>+25% </b> from last month</p>
                </div>
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow my-2 text-white bg-success">
            <div class="card-header" style="font-weight: bold;font-size:22px">
                Revenue
            </div>
            <div class="card-body">
                <div class="text-right">
                    <strong> 25,541 EGP</strong>
                    <p><b>+17.5% </b> from last month</p>
                </div>
                <i class="fas fa-shopping-basket"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow my-2 text-white bg-danger">
            <div class="card-header" style="font-weight: bold;font-size:22px">
                Rates
            </div>
            <div class="card-body">
                <div class="text-right">
                    <strong>64%</strong>
                    <p>lorem ipsum</p>
                </div>
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-left shadow my-2">
            <div class="card-header">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <div class="doughnut" style="width:250px;height:250px;margin:auto">
                  <canvas id="doughnut1"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-left shadow my-2">
            <div class="card-header">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <div class="bar" style="width:auto;height:250px;margin:auto">
                <canvas id="mybarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("includes/footer.php");
?>