<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body>

<?php
  include 'navbar.php';
?>

	<div class="container ">
        <h1 class="pt-4 text-dark">Transaction History</h1>
        
       <br>
       <div class="table-responsive-sm">
    <table class="table about table-hover  table-bordered">
        <thead class="bg-secondary text-light">
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
    
             $user_name = "root";
             $password = "";
             $database = "Banking";
             $host_name = "localhost"; 
             $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
             if(!$conn){
             die("Error Could not able to connect the database --> ".mysqli_connect_error());
            }


            $sql ="select * from transactionhistory";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime'];?> </td>
            </tr>    
        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>
</body>
</html>