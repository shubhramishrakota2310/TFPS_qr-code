<?php 
include('config.php');
	session_start(); 

	if ($_SESSION['user']['role']!='A') {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../enter/door.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../index.html");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Members | TFPS</title>
</head>
<body>
<?php 
     	$q = "SELECT * FROM users ORDER BY id asc";
		$result = mysqli_query($conn,$q);
?>
<?php if (mysqli_num_rows($result) !='0') : ?>
		<div>
			<h3 style="margin-left: 20px; display: inline-block;">Members</h3>
			<input style="display: inline-block; float: right; margin: 12px;" type="text" id="myInput" onkeyup="myFunction1()" placeholder="&nbsp;Search Member">
		</div>
		<div style="overflow-x:auto; margin-top: 8px;">
		    <table style="border-collapse: collapse;border: 1px solid black;" id="myTable">
		      <thead>
		      <tr>
		      <th><strong>Member Image</strong></th>
		      <th><strong>Member Name</strong></th>
		      <th><strong>Contact Number</strong></th>
		      <th><strong>Email</strong></th>
		      <th><strong>Year</strong></th>
		      <th><strong>Delete</strong></th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php
		      while($row = mysqli_fetch_assoc($result)) { ?>
		      <tr>
		      <td align="center">
		      	<img src="../../users/<?php if(empty($row["image"])!='1') { echo $row["image"]; } else { echo "userlogo.png"; } ?>" style="height: 114px; width: 124px;"/>
      		  </td>
		      <td align="center"><?php echo $row["name"]; ?></td>
		      <td align="center"><?php echo $row["mobile"]; ?></strong>&nbsp;<a href="https://wa.me/91<?php echo $row["mobile"]; ?>?text=Hi <?php echo $row["name"]; ?>"><i class="fa fa-whatsapp fa-2x" style="color: green;" aria-hidden="true"></i></a></td>
		      <td align="center"><?php echo $row["email"]; ?></td>
		      <td align="center"><?php echo $row["batch"]; ?></td>
		      <td align="center"><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
		      </tr>
		      <?php } ?>
		    </tbody>
		    </table>
 		 </div>
<?php endif ?>
<?php if (mysqli_num_rows($result) =='0') : ?>
		<h4>No Members yet.</h4>
<?php endif ?>
     <script>
        function myFunction1() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
	</script>
<br><br>
<a href="../dashboard.php"><h4>Back to Dashboard</h4></a>
<br><br>
<a style="color: red;" href="logout.php">Logout</a>
</body>
</html>