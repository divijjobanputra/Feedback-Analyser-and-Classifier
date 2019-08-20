<?php
session_start();
if(!isset($_SESSION['email']))
{
  header("Location: index.html");
}
include "database.php";
$con = connect();
$sql = "SELECT Department, Count(sentiment) as 'count' FROM `feedback` WHERE sentiment='N' GROUP BY department";
$negDept = mysqli_query($con,$sql);
$sql = "SELECT Department, Count(sentiment) as 'count' FROM `feedback` WHERE sentiment='P' GROUP BY department";
$posDept = mysqli_query($con,$sql);
$sql = "SELECT count(*) AS 'total' From `feedback`";
$tot = mysqli_query($con, $sql);
extract(mysqli_fetch_assoc($tot));

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {            
      title:{
        text: "Positive and Negative Feedbacks of the deparment"              
      },

      data: [       
      {     
       type: "column",
       name: "Negative",
       dataPoints: [
        <?php 
            while($data = mysqli_fetch_assoc($negDept))
            {
                extract($data);
                ?>
       { label: "<?php echo $Department;?>", y: <?php echo ($count/$total)*100;?> },
            <?php
            }
            ?>
       ]
     },
     { 

      type: "column",
      name: "Positive",                
      dataPoints: [
        <?php 
            while($data = mysqli_fetch_assoc($posDept))
            {
                extract($data);
                ?>
       { label: "<?php echo $Department;?>", y: <?php echo ($count/$total)*100;?> },
            <?php
            }
            ?>
      ]
    }
    ]
  });

    chart.render();
  }
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
                <a class="navbar-brand" href="home.php">FAAC Admin</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation"></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">Add User</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="list.php">List Review</a>
                        </li>
						<li class="nav-item active">
						  <a class="nav-link" href="#">Visualise</a>
						</li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="process.php?action=logout">Sign Out</a>
                    </li>
                  </ul>
                </div>
            </nav>
           
        <div class="container p-5">
            <div id="chartContainer" style="height: 300px; width: 100%;">
            </div> 
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>