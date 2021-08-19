<?php 
    include('config.php');
    $sql="SELECT * FROM tbl_users";
    $result=mysqli_query($conn,$sql);
?>

<?php include('nav.php'); ?>

<!-- Transaction page starts here -->

<div class="transaction-amount">
    <div class="container">
        <h2 class="text-center" style="color: crimson;">Transaction</h2>
        
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                
            </tr>
            <?php 
                $from=$_GET['data-id'];
                $sql1="SELECT * FROM tbl_users where ID='$from'";
                $rec=mysqli_query($conn,$sql1);
                $ans=mysqli_fetch_array($rec);
            ?>
            
            <tr>
                <td><?php echo $ans['ID']; ?></td>
                <td><?php echo $ans['Name']; ?></td>
                <td><?php echo $ans['Email']; ?></td>
                <td><?php echo $ans['Balance']; ?></td>
                
            </tr>
        </table><br><br><br><br>

        <form action=" " method="post">
            <label><b>Transfer To:</b></label>
            <?php 
                $sql3="SELECT * FROM tbl_users";
                $rec=mysqli_query($conn,$sql3);
               
            ?>
            <select name="choose">
                <option value="">Select</option>
                <?php 
                     while( $ans=mysqli_fetch_array($rec)){
                    ?>

                    <option value="<?php echo $ans['Name']; ?>"><?php echo $ans['Name']; ?></option>
                    <?php
                    }
                    ?>
            </select><br><br><br>

            <label><b>Amount:</b></label>
            <input type="text" size="20" name="amt" value="">

            <button type="submit" name="submit">Transfer</button>
        </form>
    </div>
</div>

            
<?php
    if(isset($_POST['submit'])){
        $amount=$_POST['amt']; // Store the amount 
        $name=$_POST['choose']; 

        $from=$_GET['data-id'];
        $sql="SELECT * FROM tbl_users where id='$from'";
        $rec=mysqli_query($conn,$sql);
        $ans=mysqli_fetch_array($rec);
        

        $sql="SELECT * FROM tbl_users where Name='$name'";
        $rec=mysqli_query($conn,$sql);
        $ans2=mysqli_fetch_array($rec);
              
         
        if($amount<0){
            echo '<script>alert("Transfer failed")</script>';
        }
        else if($amount>$ans['Balance']){
            echo '<script>alert("Insufficient Balance")</script>';
        }
        else{
            // Reducing balance from the account of person who transferred
            $newBalance=$ans['Balance']-$amount;
            $query1="UPDATE tbl_users set Balance=$newBalance where id='$from'";
            mysqli_query($conn,$query1);
           
            // Adding amount to the account where it is transferred
            $newBalance2=$ans2['Balance']+$amount;
            $query2="UPDATE tbl_users set Balance=$newBalance2 where Name='$name'";
            mysqli_query($conn,$query2);
            
            // Inserting values in transaction history table
            $val=$ans['Name'];
            $sql5="INSERT INTO tbl_history(sender,receiver,amount) VALUES ('$val','$name','$amount')";
            if(mysqli_query($conn,$sql5)){
                echo '<script>alert("Transaction Successful")</script>';
            }
            else{
                echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
            }

            $newBalance=0;
            $amount=0;

            


        }
       
        
    }
?>

<!-- Transaction page ends here -->

<?php include('footer.php'); ?>


