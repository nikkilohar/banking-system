<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

</head>

<body>
<?php
    
    $user_name = "root";
    $password = "";
    $database = "Banking";
    $host_name = "localhost"; 
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
    if(!$conn){
        die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
?>

<?php
  include 'navbar.php';
?>

<div class="container">
        <h1 class="pt-4 text-dark">Customer</h1>
        <br>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm">
                    <table class="table about table-hover table-sm  table-bordered">
                        <thead class="text-light bg-secondary">
                            <tr>   <!-- It create only table   -->
                            <th scope="col" class="text-center py-2 ">Id</th>
                            <th scope="col" class="text-center py-2 ">Name</th>
                            <th scope="col" class="text-center py-2 ">E-Mail</th>
                            <th scope="col" class="text-center py-2 ">Balance</th>
                            </tr>
                        </thead>

                        <!-- Start   -->
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr class="change">
                        <td class="py-2"><?php echo $rows['id'] ?></td>
                        <td class="py-2"><?php echo $rows['name']?></td>
                        <td class="py-2"><?php echo $rows['email']?></td>
                        <td class="py-2"><?php echo $rows['balance']?></td>
                    </tr>
                <?php
                    }
                ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div> 
         </div>
</body>
</html>
