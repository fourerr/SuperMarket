<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="positions.css" />
		<link rel="stylesheet" href="pageTransition.css" />
		<link rel="stylesheet" href="dropdown.css"/>
		<!-- TODO : change title tag to the name
		of the query displayed in the page -->
		<title>Delivery Collision details</title>

		<div class="dropdown-menu">

			<div class="dropdown">
				<button class="dropbtn">workers</button>
				<div class="workers-content">
					<a href="http://localhost/myapp/insert_new_worker.php">add new worker</a>
					<a href="http://localhost/myapp/remove_worker.php">remove worker</a>
					<a href="http://localhost/myapp/edit_worker.php">edit worker</a>
					<a href="http://localhost/myapp/select_all_table_worker.php">workers full table</a>
					<a href="http://localhost/myapp/number of COVID19 workers.php">covid19 workers</a>
					<a href="http://localhost/myapp/average_salary.php">avg salary</a>
					<a href="http://localhost/myapp/count_of_workers_according_to_all_positions.php">all workers count</a>
					<a href="http://localhost/myapp/count_of_workers_per_position.php">number of workers in position</a>
					<a href="http://localhost/myapp/count_workers_by_positions.php">workers count by position</a>
					<a href="http://localhost/myapp/details_of_employees_worker_more_than_160_hours.php">best employees</a>
					<a href="http://localhost/myapp/happy_birthday_by_branches.php">employees' birthdays by branches</a>
					<a href="http://localhost/myapp/happy_birthday.php">all employees' birthdays</a>
					<a href="http://localhost/myapp/Total_salary.php">total salary</a>
					<a href="http://localhost/myapp/Worker's_deliveries.php">worker's deliveries</a>
					<a href="http://localhost/myapp/worker with most deliveries.php">best shipping worker</a>
					<a href="http://localhost/myapp/select_all_table_positions.php">position full table</a>
					<!-- <a href="http://localhost/myapp/positions.php">positions details</a> -->
				</div>
			</div>
			<div class="dropdown2">
				<button class="dropbtn2">deliveries</button>
				<div class="del-content">
					<a href="http://localhost/myapp/select_all_table_finished_deliveries.php">finished deliveries full table</a>
					<a href="http://localhost/myapp/select_all_table_deliveris.php">deliveries full table</a>
					<a href="http://localhost/myapp/select_all_table_deliver_schedueling.php">scheduling full table</a>
					<a href="http://localhost/myapp/numbers_of_deliveries_today.php">number of deliveries today</a>
					<a href="http://localhost/myapp/number_of_deliveries_to_area.php">number of deliveries to area</a>
					<a href="http://localhost/myapp/old_deliveries_not_scheduled.php">urgent deliveries</a>
					<a href="http://localhost/myapp/getDelievery.php">get delivery</a>
					<a href="http://localhost/myapp/Number_of_deliveries_and_workers_to_area.php">number of deliveries and workers to area</a>
					<a href="http://localhost/myapp/need_of_more_schedueling.php">any deliveries left to schedule?</a>
					<a href="http://localhost/myapp/deliveries_stats.php">deliveries stats</a>
					<a href="http://localhost/myapp/GetAboveAvgDeliveries.php">above avg deliveries</a>
					<a href="http://localhost/myapp/collision_of_deliveries-count.php">deliveries collision count</a>
					<a href="http://localhost/myapp/collision_of_deliveries-details.php">deliveries collision details</a>
					<a href="http://localhost/myapp/deliveries_by_branch.php">deliveries by branch</a>
					<a href="http://localhost/myapp/need cooling but not scheduled.php">unschedulaed deliveries need cooling</a>

				</div>
			</div>
			<div class="dropdown3">
				<button class="dropbtn3">vehicles</button>
				<div class="vehicles-content">
					<a href="http://localhost/myapp/has A or C license.php">employees with A or C license</a>
					<a href="http://localhost/myapp/workers_and_vehicles_available_for_delivery.php">workers and vehicles available for delivery</a>
					<a href="http://localhost/myapp/FitVehiclesForDelivery.php">vehicles for delivery</a>
					<a href="http://localhost/myapp/select_all_table_vehicles.php">vehicles full table</a>
					<a href="http://localhost/myapp/vehicles_need_maintenance.php">vehicles need maintenance</a>
				</div>
			</div>
			<div class="dropdown4">
				<button class="dropbtn4">branches</button>
				<div class="branches-content">
					<a href="http://localhost/myapp/select_all_table_branches.php">branches full table</a>
					<a href="http://localhost/myapp/most profitable branch in the last week.php">best branch this week</a>
					<a href="http://localhost/myapp/profit_by_branch_for_last_week.php">last weeks profits by branch</a>
					<a href="http://localhost/myapp/branch_with_most_deliveries.php">branches with most deliveries</a>
				</div>
			</div>
		</div>

	</head>

		<body>

			<div class="card">

			<!-- TODO : change title inside h tag -->
			<h1>
				COLLISION OF DELIVERIES - DETAILS
			</h1>

			<?php
				//open connection to mysql db
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "supermarket";

				$connection = new mysqli($servername, $username, $password, $dbname);

				// let me know if connection failed
				if($connection -> connect_error) {
					die("Connection failed: " . $connection->connect_error);
				}

				// COPY QUERY FROM XAMPP
				//fetch table rows from mysql db
				$sql = "select
							D1.Id_deliever AS id1,
							D1.Order_shipping_time AS date1,
							D1.Start_shipping AS start1,
							D1.End_shipping AS end1,
							D2.Id_deliever AS id2,
							D2.Order_shipping_time AS date2,
							D2.Start_shipping AS start2,
							D2.End_shipping AS end2 ,
							D1.Area AS Area
							from delievers D1, delievers D2
						where
							D1.Id_deliever <> D2.Id_deliever AND
							D1.Area = D2.Area AND
							D1.Order_shipping_time= D2.Order_shipping_time AND
							D1.Start_shipping=D2.Start_shipping
						group by D1.Area" ;

				// store the result of the query in a temp var
				$result = $connection -> query($sql);

				// make sure we have something to print
                if ($result -> num_rows > 0) {

					// please make sure to write each attribute
					// in a seperate line to make the code as readable as possible
					//     vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
					// print table with headers
					// header can be defined by us, no syntex needed

					echo "<table>
                            <tr>

							<th>	id1                  </th>
							<th>	date1         </th>
							<th>	start1            </th>
							<th>	end1                </th>
							<th>	id2                </th>
							<th>	date2         </th>
							<th>	start2            </th>
							<th>	end2                </th>
							<th>	Area                         </th>


                            </tr>";

					// please make sure to write each attribute
					// in a seperate line to make the code as readable as possible
					//     vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
					// print each result in a seperate line, then br (new line)
					// syntax is important here, make sure not to have spelling mistakes
					while ($row = $result -> fetch_assoc()) {
						echo "
						<tr>

							<td>".$row["number of collision"]."</td>
							<td>".$row["Area"].	"</td>


							<td>".$row["id1"].	"</td>
							<td>".$row["date1"].	"</td>
							<td>".$row["start1"].	"</td>
							<td>".$row["end1"].	"</td>
							<td>".$row["id2"].	"</td>
							<td>".$row["date2"].	"</td>
							<td>".$row["start2"].	"</td>
							<td>".$row["end2"].	"</td>
							<td>".$row["Area"].	"</td>

							<br>

						</tr>";
					}
				}
				// if no data can be found, print error message to the user
				else{
					echo "<h5> Can't find data </h5>";
				}

				//close the db connection
				$connection->close();
				?>

		</div>

	</body>

</html>
