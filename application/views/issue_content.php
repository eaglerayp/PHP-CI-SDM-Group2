
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
		background-color: #ffffff;
		position: absolute;
		/*top: 0%;*/
		/*height: 100%;*/
		left: 10%;
		width: 70%;
		/*box-shadow:4px 4px 3px rgba(20%,20%,40%,0.5);*/
		/*overflow: auto;*/
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 10%;
		margin-top: 20px;
	}
	#reply{
		position: fixed;
		bottom: 0%;
		left: 10%;
		width: 80%;
		background-color: #f5f5f5;
	}
	#comment{
		width: 90%;
		position:relative;
		left: 5%;
	}
    #comment_textarea {
    	position: relative;
    	left: -50px;

    }
</style>

	<div id="mainframe">
		<div class="page-header col-md-offset-1 col-md-9">
			<?php
				echo "<h1>". $issue->title . "  <small> by " . $author . "</small></h1> ";
				echo "<h3><small> " . $issue->timestamp ."</small></h3>";
				echo "<h3><small> ";
				if($tagArray!=null){
					echo "tag: ";
					foreach($tagArray as $tag){
						echo $tag;
						echo " ";
					}
				}
				echo "</small></h3>";
			?>
		</div>
		
		<div id="issue" class="col-md-offset-1  col-lg-10">
			<p>
				<?php
					echo nl2br(htmlspecialchars($issue->content));
					// echo str_replace("\n", '<\ br>', $issue->content);
				?>
			</p>
		</div>


		<?php 
			if($replyList!=null){
				foreach ($replyList as $reply) { 
					echo "<div class='comment col-md-offset-2 col-md-9'>";
					echo "	<hr />";
					echo "	<p>";
					echo nl2br(htmlspecialchars($reply->replycontent));
					echo "	</p>";
					echo "	<h5 class='text-right'>" . $authorName[$reply->userid] . "&nbsp&nbsp<small>" . $reply->timestamp ."</small></h5> ";
					echo "</div>";
				}
			}
		?>
	</div>


	
	<div id="reply" class="comment">
			<!-- <label class="col-lg-2 control-label">Your name:</label> -->
		    <!-- <div class="col-lg-10"> -->
		      	<!-- <input type="text" id="name" class="form-control"> -->
		    <!-- </div> -->
			<label class="col-lg-2 control-label">Comment:</label>
		    <div class="col-lg-10" id='comment_textarea'>
		      	<textarea class="form-control" id="comment" rows="2"></textarea>
		    </div>
			<?php echo "<input type='hidden' id='name' value= '". $_SESSION["user"]->username ."''>" ?>
		    
		    <?php echo "<input type='hidden' id='issue_id' value= '". $issue->issueid ."''>" ?>
			<div class="form-group">
			    <div class="col-lg-offset-2 col-lg-11">
			      	<button id="submitBtn" class="btn btn-default">Submit</button>
			    </div>
			</div>
	</div>
	
<?php include("_footer.php"); ?> 