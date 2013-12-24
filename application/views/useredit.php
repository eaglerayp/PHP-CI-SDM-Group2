 <? /* php post parameter $userfile=SELECT * FROM user   $userwork=SELECT * FROM userwork $userstudentid=SELECT * FROM userstudentid
    *$userfile   is php object  , attribute "userid" ,"username" ,"email","phone","address","phoneshow","addressshow" ,"autobiography","usercategory","image", "positionshow","employershow" 
    *$userwork   is php array ,element is php object ,attribute "userid","position","employer","state"   
    *$userstudentid   is php array ,element is php object ,attribute "userid","studentid" */ ?>
<?php 
	if($userwork!=null){
		$currentwork= array_pop($userwork);
	}else{
		$currentwork= (object) array('position' => '', 'employer' => '','state'=>'','startyear'=>'');
	}
?>
<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?>
<script type="text/javascript">
	$(document).ready(function() {
        nav_click("nav_edit");
    });
</script>
<style type="text/css">
	#add_work {
		cursor: pointer;
		/*text-decoration: underline;*/
		width: 100px;
		max-width: 200px;
	}
	#add_studentid {
		cursor: pointer;
		/*text-decoration: underline;*/
		width: 130px;
		max-width: 200px;
	}
	h1 {
		position: relative;
		left: 3%;
		font-size: 40px;
	}
	img {
		width: 400px;
		height: 300px;
		
	}
/*	.img {
		position: absolute;
		right: 0%;
		text-align : center;
	}*/
	#tagDiv {
		max-height: 200px;
		overflow: auto;
		/*width:200px;*/
	}
	.control-label {
		.h1;
	}
/*	.controls input {
		position: relative;
		left: 5%;
	}*/
	.table {
		position: relative;
		left: 3%;
		width: 90%;
	}
	.worktable td{
		border-top: 0px;
	}
</style>
	<div class="container">
		<!-- <legend>Edit User Profile</legend> -->
		<h1><?=htmlspecialchars($userfile->username)?>'s Profile</h1>


		<?php if(isset($error)&&$error!=""){echo $error;}?>


		<?php echo form_open_multipart("user/editing");?>

		<input type="hidden" name="fileuserid" value="<?=$userfile->userid?>" />  
		<!-- <label class="control-label" for="inputphone">Photo</label> -->
		

			<table class="table">
				<tr>
					<td>
						<label class="control-label" for="inputImage">Image</label>
					</td>
					<td>
						<div class="img">
								<img src="<?=base_url("/uploads/".$userfile->image)?>" alt="Personal photo">
								<input type="hidden" name="imgpath" value="<?=$userfile->image?>" /> 
								<input type="file" name="userfile" size="20" />
						</div>
					</td>
				<tr>
			<!-- <div class="control-group"> -->
					<td>
						<label class="control-label" for="inputEmail">Email</label>
					</td>
					<td>
			<!-- <div class="controls"> -->
						<input type="text" name="email" value="<?=htmlspecialchars($userfile->email)?>">
					</td>
			<!-- </div> -->
				</tr>
				<tr>
					<td>
						<label class="control-label" for="inputaddress">Postal Address</label>
					</td>
			<!-- <div class="controls"> -->
					<td>
						<input type="text" name="address" value="<?=htmlspecialchars($userfile->address)?>">
						<input type="checkbox" name="addressshow" value="1" <?php if ($userfile->addressshow==1){?>checked <?php } ?> >
					</td>
				</tr>
			<!-- </div> -->

				<tr>
					<td>
						<label class="control-label" for="inputphone">Phone</label>
			<!-- <div class="controls"> -->
					</td>
					<td>
						<input type="text" name="phone" value="<?=htmlspecialchars($userfile->phone)?>">
						<input type="checkbox" name="phoneshow" value="1" <?php if ($userfile->phoneshow==1){?>checked <?php } ?> >
					</td>
				</tr>
			<!-- </div> -->
<!-- TAG NEW WORK 
input parameter $tag as php array  object $tag->tag ,followid
-->

				<tr>
					<td>
						<label class="control-label" for="controlTags">Tag</label>
					</td>
					<td>
						<div id='add_tag' ><a herf=''>add more tag</a></div>
						<input type="hidden" name="addid" value="0" /> 
						<div id='tagarea'>
						</div>
						<div class="tagDiv"> 
						<table class="worktable" id="tagtable">
						<?php if($tags!=null){
								foreach ($tags as $tag) { 
										echo "<tr>";
								?>
								<td id="<?=$tag->followid?>" style='font-size:26px'><?=htmlspecialchars($tag->tag)?></td>
								<td><a id="<?=$tag->followid?>" href="<?=site_url("user/deleteTag/".$tag->followid)?>">Delete</a></td>
								<?php 
										echo "</tr>";
								}
							} ?> 
						</table>
						</div>


					</td>
				</tr>
				<input type="hidden" name="currentstate" value="<?=$currentwork->state?>" /> 
				<tr>
					<td>
			<!-- </div> -->
			
			<!-- <div class="controls">	 -->
						<label class="control-label" for="workexperience">Work Experience</label>
						

						
					</td>
					<td>
												<label class="control-label" for="currentPosition">Current Workplace</label>
						<span style='font-size:26px'><?=htmlspecialchars($currentwork->position)?></span>
						<input type="checkbox" name="positionshow" value="1" <?php if($userfile->positionshow==1){ ?>checked <?php } ?> >
			<!-- 		</td>
				</tr>
				<tr>
					<td>
						<label class="control-label" for="currentEmployee">Current employer</label>
						
					</td>
					<td> -->
						<label class="control-label" for="currentState">Current State</label>
						<span style='font-size:26px'><?=htmlspecialchars($currentwork->employer)?></span>
						<input type="checkbox" name="employershow" value="1" <?php if($userfile->employershow==1){ ?>checked <?php } ?> >
						<label class="control-label" for="currentStartYear">Start Year</label>
						<span style='font-size:26px'><?=htmlspecialchars($currentwork->startyear)?></span>

						<div id='work_area'>
						<table class="worktable" id='worktable'>
							<tr>
								<td>Past Workplace : </td><td>Past Position :</td><td>Start Year : </td>
							</tr>
						<?php 
						if($userwork!=null){
						foreach ($userwork as $newwork) { ?>
						<tr>
						
						<td style='font-size:26px'><?=htmlspecialchars($newwork->position)?></td>
						 
						<td style='font-size:26px'><?=htmlspecialchars($newwork->employer)?></td>
						
						<td style='font-size:26px'><?=htmlspecialchars($newwork->startyear)?></td>

						</tr>
						<?php }
						} ?> 
						</table>
						</div>
						<div id='add_work' ><a herf=''>add more work</a></div>	
						<input type="hidden" name="addwork" value="0" />  
					</td>
				</tr>
				<tr>
					<td>
						<label class="control-label" for="studentid">StudentID</label>
					</td>
					<td>
						<div id='studentid_area'>
						<?php 
						if($userstudentid!=null){
						foreach ($userstudentid as $id) { ?>
						<div class="controls">
						<span style='font-size:26px' name="studentid" ><?=htmlspecialchars($id->studentid)?></span>
						</div>
						<?php }
						} ?>
						</div> 
						<div id='add_studentid' ><a herf=''>add more student id</a></div>
						<input type="hidden" name="addid" value="0" />   
					</td>
				</tr>
			
			<!-- </div> -->
			
			
				<tr>
			<!-- <div class="control-group"> -->
					<td>
						<label class="control-label" for="inputautobiography">Autobiography</label>
					</td>
					<td>
			<!-- <div class="controls"> -->
						<textarea class="input-block-level" name="autobiography" rows="10" >
						<?=htmlspecialchars($userfile->autobiography)?>
						</textarea>
					</td>
				</tr>
			<!-- </div> -->
				<tr>
					</td>
					<td>
						<button id='send_edit_data' class="btn btn-info" type="submit">Edit Confirm</div>
					</td>
				</tr>
			</table>
			
			</div>
			
		</form>
		
	</div>
	<script src="<?=base_url("/js/jquery.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-transition.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-alert.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-modal.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-dropdown.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-scrollspy.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-tab.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-tooltip.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-popover.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-button.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-collapse.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-typeahead.js")?>"></script>
    <script type="text/javascript">
    	$("#add_tag").click(function(){
    			var last_v = $("#tagarea").children(".controls").last().children("input").last().val();
    			if( last_v!="" ){
	    			var text ='<div class="controls">Tag&nbsp;<input type="text" id="Tag" value=""><a id="add_tagsubmit" herf="">submit</a></div>';
	    			$("#tagarea").append(text);
	    			$("input[name=addtag]").val(1);
    			}
    	 	$("#add_tagsubmit").click(function(){
    		 var tag = $("#Tag").val();
    		 $.ajax({
             url: "<?=site_url("/user/addfollowtag")?>",
             type:'POST',
	         data: { tag: $("#Tag").val()},
             error: function(xhr) {
             alert('Ajax request 發生錯誤');
             },
             success: function(response) {
 				$('#tagtable').append(response);
	           // $('#msg').fadeIn();
	            var objDiv = document.getElementById("#tagtable");
	            objDiv.scrollTop = objDiv.scrollHeight;
             }
         });
    	});
    	})
    	$("#add_work").click(function(){
    		var last_v = $("#work_area").children(".controls").last().children("input").last().val();
    		if( last_v!="" ){
    			var text = '<div class="controls">Workplace&nbsp;<input type="text" id="Workplace" value="">&nbsp;Position&nbsp;<input type="text" id="Position" value="">StartYear&nbsp;<input type="text" id="Startyear" value=""><a id="add_worksubmit" herf="">submit</a></div>';
    			$("#work_area").append(text);
    			$("input[name=addwork]").val(1);
    			// console.log(last_v);
    			$("#add_worksubmit").click(function(){
    				console.log($("#Startyear").val())
	    		 $.ajax({
	             url: "<?=site_url("/user/addwork")?>",
	             type:'POST',
		         data: { Workplace: $("#Workplace").val(),Position: $("#Position").val(),Startyear: $("#Startyear").val()},
	             error: function(xhr) {
	             alert('Ajax request 發生錯誤');
	             },
	             success: function(response) {
 				$('#worktable').append(response);
	           // $('#msg').fadeIn();
	            var objDiv = document.getElementById("#worktable");
	            objDiv.scrollTop = objDiv.scrollHeight;
             }
         });
    	});
    		}
    		// console.log(last_v);
    		// console.log("click!");
    	})
 		$("#add_studentid").click(function(){
    		var last_v = $("#studentid_area").children(".controls").last().children("input").last().val();
    		if( last_v!="" ){
    			var text = '<div class="controls"><input type="text" name="studentid" value=""></div>';

    			$("#studentid_area").append(text);
    			$("input[name=addid]").val(1);
    			// console.log(last_v);
    		}
    		// console.log(last_v);
    		// console.log("click!");
    	})

    </script>
<?php include("_footer.php"); ?> 