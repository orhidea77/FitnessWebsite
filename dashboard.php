
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="db.css">

	<title>Dashboard</title>
</head>
<body>
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">First We Lift</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="create.php">
					<span class="text">Add Client</span>
				</a>
			</li>
			
		<ul class="side-menu">
			<li>
				<a href="#" class="logout">
					<span class="text">Log Out</span>
				</a>
			</li>
		</ul>
	</section>

	<section id="content">

		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>

			<ul class="box-info"></ul>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Clients</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Number</th>
								<th>Data</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$servername = "localhost";
							$username = "root";
							$password = "";
							$database = "clients";

							$connection = new mysqli($servername, $username, $password, $database);

							if($connection->connect_error){
								die("Connection failed: " . $connection->connect_error);
							}

							$sql = "SELECT * FROM clients";
							$result = $connection->query($sql);

							if(!$result){
								die("Invalid query: " . $connection->error);
							}

							while($row = $result->fetch_assoc()){
								echo "
								<tr>
									<td>$row[id]</td>
									<td>$row[name]</td>
									<td>$row[email]</td>
									<td>$row[number]</td>
									<td>$row[dataa]</td>
									<td>
										<a class='btn' href='Edit.php?id=$row[id]'>Edit</a>
										<a class='btn' href='Delete.php?$row[id]'>Delete</a>
									</td>
								</tr>
								";
							}
							?>
	<script src="script.js"></script>
</body>
</html>