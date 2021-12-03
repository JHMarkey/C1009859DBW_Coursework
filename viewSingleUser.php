<?php require("Header.php");
	include_once("viewSingleUserSQL.php");
    $user = getUsers();
    $uID =  $user[0]['UserID'];
?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2 class = "title">View User</h2><br>
				<div class="row">
            <div class="col-10">
                <table class="table table-striped">
                    <thead>   
                        <td>Action</td>                    
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Password</td>
                        <td>Postcode</td>
                        <td>DOB</td>
                        <td>Telephone</td>
                        <td>Product ID</td>
                        <td>Status</td>                        
                    </thead>                                               
                    <tr>  
                        <td><a href="updateUser.php?uid=<?php echo $uID; ?>">Update</a>
                        <?php if($user[$i]['UserStatus'] == "Withdrawn"){?>
                            | <a href="DeleteUser.php?uid=<?php echo $uID; ?>">Delete</a>
                        <?php ;}?>
                        </td>          
                        <td><?php echo $user[$i]['UserFirstName']?></td>
                        <td><?php echo $user[$i]['UserLastName']?></td>
                        <td><?php echo $user[$i]['UserPassword']?></td>
                        <td><?php echo $user[$i]['UserPostcode']?></td>
                        <td><?php echo $user[$i]['UserDOB']?></td>
                        <td><?php echo $user[$i]['UserTele']?></td>
                        <td><?php echo $user[$i]['ProductID']?></td>
                        <td><?php echo $user[$i]['UserStatus']?></td>						
                    </tr>
                    
                </table>    
            </div>
        </div>	  
   </main>
</div>

<?php require("Footer.php");?>