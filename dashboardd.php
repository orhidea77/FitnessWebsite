<?php
require 'database.php';
$sql = 'SELECT * FROM clients';


if(isset($_GET['delid'])){

  $id = intval($GET['delid']);
  $sql = mysqli_query($conn, "DELETE FROM clients WHERE id = '$$id'");
  echo "<script>alert('Client deleted successfully');</script>";
  echo "<script>window.location='dashboardd.php';</script>";
}
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="d.css"/>
  </head>
  <body>
  <form method="POST">
    <div class="tabela">
      <div class="tab-header">
        <p>Clients</p>
      <div>
      <input placeholder="clients">
      <a class="add" a href="createe.php">
			<span class="text">Add Client</span>
		</a></button>
      </div>
      </div>
      <div class="tab-section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "database.php";
                $sql = mysqli_query($conn, "SELECT * FROM clients");
                $count = 1;
                $row = mysqli_num_rows($sql);
                if($row > 0){
                    while($row = mysqli_fetch_array($sql)){
                ?>

                <tr>
                  <td><?php echo $count;?></td>
                  <td><?php echo $row['name'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['phone'];?></td>

                  <td>
                    <a href="edit.php?editid=<?php echo htmlentities($row['id']);?>" class="btn">Edit</a>
                    <a href="dashboardd.php?delid=<?php echo htmlentities($row['id']);?>" onClick = "return confirm('Are you sure u want to delete this client?');" class="btn">Delete</a>
                  </td>
                </tr>
                <?php
                $count = $count+1;
                }
            }
                ?>
            </tbody>
            </form>
        </table>
      </div>
    </div>
  </body>
</html>