<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?> 
	<div id="mainframe">
		<?php
			// $link_ID = mysql_connect("localhost", "root", "root") or die('Error with MySQL connection' . mysql_error());
			$link_ID = mysqli_connect("140.112.106.48", "R02725004", "julia0514", "R02725004") or die('Error with MySQL connection' . mysql_error());
			mysqli_query($link_ID, "SET CHARACTER SET UTF8;"); 
			$query = "SELECT * FROM `Issues` WHERE 1";
			$result = mysqli_query($link_ID, $query);
			// $issue = mysqli_fetch_array($result);
			// $query = "SELECT * FROM `Comments` WHERE issue_id=" . $issue["issue_id"];
			// $result = mysqli_query($link_ID, $query);

			
			mysqli_close($link_ID);
		?>
		<!-- <div>
			<div class="col-md-offset-1 col-md-9">
				<h1>Discussion</h1>	
			</div>
			<div class="col-md-offset-9 col-md-3">
				<h5>Author</h5>
			</div>
		</div> -->
		<div class="page-header col-md-offset-1 col-md-9">
			<?php
				echo "<h1>Discussion Board</h1>"
			?>
		</div>
		

		<?php
			while ($record = mysqli_fetch_array($result)){
				echo "<div class='comment col-md-offset-2 col-md-9'>";
				// echo "	<hr />";
				echo "<a href='" . site_url("/issue/get_content") . "?id=" . $record["issue_id"] . "'>";

				echo $record["title"];
				// echo "	<p>";
				// echo $record["title"];
				// echo "	</p>";
				// echo "	<h5 class='text-right'>" . $record["author"] . "&nbsp&nbsp<small>" . $record["time"] ."</small></h5> ";
				echo "</a>";
				echo "	<div class='text-right' style='float:right'>" . $record["author"] . "&nbsp&nbsp<small>" . $record["launch_time"] ."</small></div> ";
				echo "</div>";

				// echo "<div class='col-md-offset-2'>";


			}
		?>
	</div>

