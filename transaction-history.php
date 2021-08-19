<?php 
    include('config.php');
    $sql="SELECT * FROM tbl_history";
    $result=mysqli_query($conn,$sql);
?>

<?php
    include('nav.php');
?>

<!-- Transaction History Page starts here --> 
<div class="history">
    <div class="container">
        <h2 class="text-center" style="color: crimson;">Transaction History</h2>
        <table class="tbl-full">
            <tr>
                <th>Transferred From</th>
                <th>Transferred To</th>
                <th>Amount</th>
            </tr>
           
            <?php 
                $query="SELECT * FROM tbl_history";
                $rec=mysqli_query($conn,$query);
                    
                while($value=mysqli_fetch_array($rec)){
                ?>
                <tr>
                    <td><?php echo $value['sender']; ?></td>
                    <td><?php echo $value['receiver']; ?></td>
                    <td><?php echo $value['amount']; ?></td>
                </tr>
                <?php
                }
                ?>
            
            
            </table>
                
<!-- Transaction History Page ends here --> 

<?php include('footer.php'); ?>