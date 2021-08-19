<?php 
    include('config.php');
    $sql="SELECT * FROM tbl_users";
    $result=mysqli_query($conn,$sql);
?>
<?php include('nav.php'); ?>

<!-- Customers page starts here-->
<div class="customers">
    <div class="container">
        <h2 class="text-center" style="color: crimson;">Customers</h2>
        <table class="tbl-full">
            <tr>
                <th>ID </th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
            <?php

                while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Balance']; ?></td>
                        <td><a href="transaction.php?data-id=<?php echo $row['ID']; ?>" class="btn" >Transfer</a></td>
                    </tr>
                <?php
                }
                ?>

            
        </table>
    </div>
</div>

<!-- Customers page ends here -->

<?php include('footer.php'); ?>

