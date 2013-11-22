


	<?php include("_header.php"); ?> 
	<?php include("_navbar.php"); ?> 

<script type="text/javascript">
	$(document).ready(function () {
	   $('#submitBtn').click(function (){
	         $.ajax({
	         url: "<?=site_url("/issue/submit_reply")?>",
	         cache: false,
	         dataType: 'html',
	             type:'POST',
	         data: { name: $('#name').val(), content: $('#comment').val(), issue_id: $('#issue_id').val()},
	         error: function(xhr) {
	           alert('Ajax request 發生錯誤');
	         },
	         success: function(response) {
	            $('#mainframe').append(response);
	           // $('#msg').fadeIn();
	            var objDiv = document.getElementById("mainframe");
	            objDiv.scrollTop = objDiv.scrollHeight;
	            // $('#mainframe').scrollTop = document.getElementById("mainframe").scrollHeight;
	         }
	     });
	  });
	});
</script>

<style type="text/css">
	#mainframe{
		/*background-color: #ffffff;*/
		position: absolute;
		/*top: 0%;*/
		/*height: 100%;*/
		left: 10%;
		width: 80%;
		/*box-shadow:4px 4px 3px rgba(20%,20%,40%,0.5);*/
		/*overflow: auto;*/
		/*padding-bottom: 13%;*/
	}

</style>

	<div id="mainframe">
		<?php
			// $link_ID = mysql_connect("localhost", "root", "root") or die('Error with MySQL connection' . mysql_error());
			$link_ID = mysqli_connect("140.112.106.48", "R02725004", "julia0514", "R02725004") or die('Error with MySQL connection' . mysql_error());
			mysqli_query($link_ID, "SET CHARACTER SET UTF8;"); 
			$query = "SELECT * FROM `Issues` WHERE issue_id=" . $id;
			$result = mysqli_query($link_ID, $query);
			$issue = mysqli_fetch_array($result);
			$query = "SELECT * FROM `Comments` WHERE issue_id=" . $issue["issue_id"];
			$result = mysqli_query($link_ID, $query);

			
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
				echo "<h1>". $issue["title"] . "  <small> by " . $issue["author"] . "</small></h1>"
			?>
		</div>
		
		<div id="issue" class="col-md-offset-1  col-lg-10">
			<p>
				<?php
					echo $issue["content"];
				?>
			<!-- Hello,

			First i'd like to thanks for all your (freebsd FreeBSD folks) recent valuable help. I've learned a lot already, but still is much to do. I've some problems with running Nginx + PHP-FPM. I can't run any .php scripts using a web browser. Instead of running index.php the web browser just downloads this script. 

			PHP-FPM is started and listening on port 9000. -->
			</p>
		</div>


		<?php
			while ($record = mysqli_fetch_array($result)){
				echo "<div class='comment col-md-offset-2 col-md-9'>";
				echo "	<hr />";
				echo "	<p>";
				echo $record["content"];
				echo "	</p>";
				echo "	<h5 class='text-right'>" . $record["author"] . "&nbsp&nbsp<small>" . $record["time"] ."</small></h5> ";
				echo "</div>";
				// echo "<div class='col-md-offset-2'>";


			}
		?>



	</div>
	<div id="reply" class="comment">
		<!-- <form> -->
			<label class="col-lg-2 control-label">Your name:</label>
		    <div class="col-lg-10">
		      	<input type="text" id="name" class="form-control">
		    </div>
			<label class="col-lg-2 control-label">Comment:</label>
		    <div class="col-lg-10">
		      	<textarea class="form-control" id="comment" rows="2"></textarea>
		    </div>
		    <?php echo "<input type='hidden' id='issue_id' value= '". $issue["issue_id"] ."''>" ?>
			<!-- <input type="text" class="col-lg-2 control-label" id="inputbox">
			<input type="button" id="submit" value="submit"> -->
			<div class="form-group">
			    <div class="col-lg-offset-2 col-lg-11">
			      	<button id="submitBtn" class="btn btn-default">Submit</button>
			    </div>
			</div>
		<!-- </form> -->
	</div>
<?php include("_footer.php"); ?> 