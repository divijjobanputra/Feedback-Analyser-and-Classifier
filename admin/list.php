<?php
session_start();
if(!isset($_SESSION['email']))
{
  header("Location: index.html");
}
include "database.php";
$con = connect();
$sql = "SELECT * FROM `feedback`";
$result = mysqli_query($con,$sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
                        <li class="nav-item active">
                          <a class="nav-link" href="#">List Review</a>
                        </li>
						<li class="nav-item">
						  <a class="nav-link" href="visulize.php">Visualise</a>
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
           
            <div class="container p-4">
              <div class="row p-2" style="float:right">
				<a href="/FAAC/tweepy/getNewData.php"><button class="btn btn-primary"id="sync">Sync</button></a>
              </div>
              <div class="row">
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Review</th>
                      <th scope="col">Sentiment</th>
                      <th scope="col">Department</th>
					  <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $i=1;
                    while($data = mysqli_fetch_assoc($result))
                    {
                        extract($data);
                    ?>
                    <tr>
                      <th scope="row"><?php echo $i;?></th>
                      <td><?php echo $text;?></td>
                      <td><?php echo $sentiment;?></td>
                      <td><?php echo $department;?></td>
					  <td><a href="deleteFeedback.php?fid=<?php echo $fid;?>">Delete</a></td>
                    </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	 <script>
            $('#sync').click(function(event){
                $.ajax
                ({ 
                    url: '/FAAC/tweepy/getNewData.php',
                    success: function()
                    {
						location.reload();
                    },
                    error: function(xhr, status, error) {
                      alert("Error in syncing");
                    }
                });
            });
        </script>
  </body>
</html>