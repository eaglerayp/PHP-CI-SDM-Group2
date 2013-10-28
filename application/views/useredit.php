 <? /* php post parameter $userfile=SELECT * FROM user   $userwork=SELECT * FROM userwork $userstudentid=SELECT * FROM userstudentid
    *$userfile   is php object  , attribute "userid" ,"username" ,"email","phone","address","phoneshow","addressshow" ,"autobiography","usercategory","image"
    *$userwork   is php array ,element is php object ,attribute "userid","position","employer","state", "positionshow","employershow"    
    *$userstudentid   is php array ,element is php object ,attribute "userid","studentid" */ ?>
<?php 
	$currentwork= array_pop($userwork);
    $works = count ($userwork);
    $ids = count($userstudentid);
?>
<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?>
	<div class="container">
		<legend>Edit User Profile</legend>
		<h2><label><?=htmlspecialchars($userfile->username)?> file</label></h2>


		<?php if(isset($error)){echo $error;}?>


		<?php echo form_open_multipart("user/editing");?>

		<input type="hidden" name="userid" value="<?=$userfile->userid?>" />  
		<label class="control-label" for="inputphone">Photo</label>
		<img src="<?=base_url("/uploads/".$userfile->image)?>" alt="Personal photo">
		<input type="file" name="userfile" size="20" />


			<div class="control-group">
			<label class="control-label" for="inputEmail">Email</label>
			<div class="controls">
			<input type="text" name="Email" value="<?=htmlspecialchars($userfile->email)?>">
			</div>
			<?php if ($userfile->addressshow==1){?>
			<label class="control-label" for="inputaddress">Postal Address</label>
			<div class="controls">
			<input type="text" name="address" value="<?=htmlspecialchars($userfile->address)?>">
			</div>
			<?php } ?> 
			<?php if ($userfile->phoneshow==1){?>
			<label class="control-label" for="inputphone">Phone</label>
			<div class="controls">
			<input type="text" name="phone" value="<?=htmlspecialchars($userfile->phone)?>">
			</div>
			<?php } ?> 

			
			
			<div class="controls">
			<?php if($currentwork->positionshow==1){ ?>
			Current Postion
			<input type="text" name="position" value="<?=htmlspecialchars($currentwork->position)?>">
			<?php } ?> 
			<?php if($currentwork->employershow==1){ ?>
			Current employer
			<input type="text" name="employer" value="<?=htmlspecialchars($currentwork->employer)?>">
			<?php } ?> 
			</div>
			
			
			<?php foreach ($userwork as $newwork) { ?>
			<div class="controls">
			<?php if($newwork->positionshow==1){ ?>
			Past Postion
			<input type="text" name="position" value="<?=htmlspecialchars($newwork->position)?>">
			<?php } ?> 
			<?php if($newwork->employershow==1){ ?>
			Past employer
			<input type="text" name="employer" value="<?=htmlspecialchars($newwork->employer)?>">
			<?php } ?> 
			</div>
			<?php } ?> 

			<label class="control-label" for="studentid">StudentID</label>
			<?php foreach ($userstudentid as $id) { ?>
			<div class="controls">
			<input type="text" name="studentid" value="<?=htmlspecialchars($id->studentid)?>">
			</div>
			<?php } ?> 

			<div class="control-group">
			<label class="control-label" for="inputautobiography">Autobiography</label>
			<div class="controls">
			<textarea class="input-block-level" name="autobiography" rows="10" >
				<?=htmlspecialchars($userfile->autobiography)?>
			</textarea>
			</div>

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
    <script src="<?=base_url("/js/bootstrap-carousel.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-typeahead.js")?>"></script>
<?php include("_footer.php"); ?> 