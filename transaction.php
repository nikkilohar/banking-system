
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    </style>
</head>

<body>
 
<?php
  include 'navbar.php';
?>
<div>

	<div class="container">
        <h1 class="pt-4 text-dark">Transaction</h1>
                <?php
    
                  $user_name = "root";
                  $password = "";
                  $database = "Banking";
                  $host_name = "localhost"; 
                  $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
                 if(!$conn){
                 die("Could not connect to the database due to the following error --> ".mysqli_connect_error());
                 }

                $select=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$select";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>

            <form method="post" name="tcredit" class="tabletext"><br>
        <div>
            <table class="table table-bordered">
                <tr class="text-dark">
                    <th >ID : </th>
                    <td class="text-left"><?php echo $rows['id'] ?></td>
                </tr>
                <tr class="text-dark">
                    <th>Name : </th>
                    <td class="text-left"><?php echo $rows['name'] ?></td>
                </tr>
                <tr class="text-dark">
                    <th>Email : </th>
                    <td class="text-left"><?php echo $rows['email'] ?></td>
                </tr>
                <tr class="text-dark">
                    <th>Balance :</th>
                    <td class="text-left"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>

        <label class="font-weight-bold">Transfer To:</label>
        <select name="to" class="form-control" required>
            <option>Choose</option><!--value="" disabled selected-->
            
            <?php
         
             $user_name = "root";
             $password = "";
             $database = "Banking";
             $host_name = "localhost"; 
             $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
             if(!$conn){
             die("Error Could not connect to the database  --> ".mysqli_connect_error()); }


                $select=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$select";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
        </select>
        <br>
        <br>
            <label class="font-weight-bold">Amount:</label>
            <input type="number" class="form-control" name="amount" required>  
            <br><br>
                <div class="text-center" >
                <button class="btn mt-3 bg-primary text-white"
                 name="submit" type="submit" id="myBtn">Transfer</button>
                </div>
            </form>

    </div>
</div>    

</body>
</html>



<?php
    
    $user_name = "root";
    $password = "";
    $database = "Banking";
    $host_name = "localhost"; 
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
    if(!$conn){
        die("Error Could not connect the database --> ".mysqli_connect_error());
    }


if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

     if($amount == 0){                 
         echo "<script type='text/javascript'>";
         echo "alert('Value cannot be zero')";
         echo "</script>";
     }
     


    else {
        
                // sender
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                // reciever
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transactionhistory(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);
                   if($query)
                     if($query){
                      echo "<script> 
                                     window.location='transactionsuccessfull.php';
                            </script>";
                          
                       }
                 

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
