 <? /* php post parameter $userfile=SELECT * FROM user   $userwork=SELECT * FROM userwork $userstudentid=SELECT * FROM userstudentid
    *$userfile   is php object  , attribute "userid" ,"username" ,"email","phone","address","phoneshow","addressshow" ,"autobiography","usercategory","image", "positionshow","employershow" 
    *$userwork   is php array ,element is php object ,attribute "userid","position","employer","state"   
    *$userstudentid   is php array ,element is php object ,attribute "userid","studentid" */ ?>
<?php 
	if($userwork!=null){
		$currentwork= array_pop($userwork);
	}else{
		$currentwork= (object) array('position' => '', 'employer' => '');
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
		font-size: 40px;
	}
</style>
	<div class="container">
		<!-- <legend>Edit User Profile</legend> -->
		<h1><?=htmlspecialchars($userfile->username)?> file</h1>


		<?php if(isset($error)){echo $error;}?>


		<?php echo form_open_multipart("user/editing");?>

		<input type="hidden" name="fileuserid" value="<?=$userfile->userid?>" />  
		<label class="control-label" for="inputphone">Photo</label>
		<img src="<?=base_url("/uploads/".$userfile->image)?>" alt="Personal photo">
		<input type="hidden" name="imgpath" value="<?=$userfile->image?>" /> 
		<input type="file" name="userfile" size="20" />


			<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			<input type="text" name="Email" value="<?=htmlspecialchars($userfile->email)?>">
			</div>
			<label class="control-label" for="inputaddress">Postal Address</label>
			<div class="controls">
			<input type="text" name="address" value="<?=htmlspecialchars($userfile->address)?>">
			<input type="checkbox" name="addressshow" value="1" <?php if ($userfile->addressshow==1){?>checked <?php } ?> >
			</div>

			
			<label class="control-label" for="inputphone">Phone</label>
			<div class="controls">
			<input type="text" name="phone" value="<?=htmlspecialchars($userfile->phone)?>">
			<input type="checkbox" name="phoneshow" value="1" <?php if ($userfile->phoneshow==1){?>checked <?php } ?> >
			</div>

			
			
			<div class="controls">	
			Current Postion
			<input type="text" name="position" value="<?=htmlspecialchars($currentwork->position)?>">
			<input type="checkbox" name="positionshow" value="1" <?php if($userfile->positionshow==1){ ?>checked <?php } ?> >
			Current employer
			<input type="text" name="employer" value="<?=htmlspecialchars($currentwork->employer)?>">
			<input type="checkbox" name="employershow" value="1" <?php if($userfile->employershow==1){ ?>checked <?php } ?> >
			</div>
			
			<div id='work_area'>

				<?php 
				if($userwork!=null){
				foreach ($userwork as $newwork) { ?>
				<div class="controls">
				Past Postion : 
				<span style='font-size:26px'><?=htmlspecialchars($newwork->position)?></span>
				Past employer : 
				<span style='font-size:26px'><?=htmlspecialchars($newwork->employer)?></span>
				</div>
				<?php }
				} ?> 
			</div>
			<div id='add_work' ><a herf=''>add more work</a></div>	
			<input type="hidden" name="addwork" value="0" />  
			<label class="control-label" for="studentid">StudentID</label>
			<div id='studentid_area'>
				<?php 
				if($userstudentid!=null){
				foreach ($userstudentid as $id) { ?>
				<div class="controls">
				<input type="text" name="studentid" value="<?=htmlspecialchars($id->studentid)?>">
				</div>
				<?php }
				} ?>
			</div> 
			<div id='add_studentid' ><a herf=''>add more student id</a></div>
			<input type="hidden" name="addid" value="0" />  
			<div class="control-group">
			<label class="control-label" for="inputautobiography">Autobiography</label>
			<div class="controls">
			<textarea class="input-block-level" name="autobiography" rows="10" >
				<?=htmlspecialchars($userfile->autobiography)?>
			</textarea>
			</div>

			</div>
			<button id='send_edit_data' class="btn btn-info" type="submit">Edit Confirm</div>
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
    <script src="<?=base_url("/js/bootstrap-carousel.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-typeahead.js")?>"></script>
    <script type="text/javascript">
    	$("#add_work").click(function(){
    		var last_v = $("#work_area").children(".controls").last().children("input").last().val();
    		if( last_v!="" ){
    			var text = '<div class="controls">Postion&nbsp;<input type="text" name="position" value="">&nbsp;employer&nbsp;<input type="text" name="employer" value=""></div>';

    			$("#work_area").append(text);
    			$("input[name=addwork]").val(1);
    			// console.log(last_v);
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