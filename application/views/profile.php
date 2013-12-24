<?php 
	if($userwork!=null){
		$currentwork= array_pop($userwork);
	}else{
		$currentwork= (object) array('position' => '', 'employer' => '','startyear'=>'');
	}
?>
<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?> 
<script type="text/javascript">
	$(document).ready(function() {
        nav_click("");
    });
</script>
<style type="text/css">
	.user_image {
		position: relative;
		/*left: 50px;*/
		top: 5%;
		margin: 10px;
	}
	.user_image > img {
		width: 400px;
		height: 350px;
	}
	.profileList {
		position: relative;
		/*right: 100px;*/
		/*top: 80px;*/
		float: right;
		width: 600px;
	}
	.user_autobiography {
		position: relative;
		/*left: 50px;*/
		top: 80px;
		/*margin: 10px;*/
		max-width: 1100px;
	}
	#editBtn {
		position: absolute;
		right: 0px;
		z-index: 1;
		/*top: 5%;*/
	}
	#issueList {
		position: absolute;
		width: 450px;
		top: 400px;

	}

</style>
<div class='container'>
	<div class='user_profile'>
		<?php 
			if($account == $profileID){
				echo '<button id="editBtn" type="button" onclick="location.href=\''.site_url("/user/edit").'\'" class="btn btn-success">Edit Profile</button>';
			}
		?>
		<table class='table profileList'>
			<tr>
				<td>Username</td>
				<td><?php echo $userfile->username;?></td>
				
			</tr>
			<tr>
				<td>Student ID</td>
				<td><?php 
					if($userstudentid!=null){
						foreach ($userstudentid as $id) { 
							echo "$id->studentid ";
						}
					}?>
			</tr>
			<?php if ( $userfile->addressshow == 1 ){ ?>
			<tr>
				<td>Address</td>
				<td><?php echo $userfile->address;?></td>
			</tr>
			<?php }?>
			<?php if ( $userfile->phoneshow == 1 ){ ?>
			<tr>
				<td>Phone</td>
				<td><?php echo $userfile->phone;?></td>
			</tr>
			<?php }?>
			<tr>
				<td>Email</td>
				<td><?php echo $userfile->email;?></td>
			</tr>
<!-- 			<tr>
				<td>Autobiography</td>
				<td><?php echo $userfile->autobiography;?></td>
			</tr> -->
			<tr>
				<td>User Type</td>
				<td><?php echo $userfile->usercategory;?></td>
			</tr>
			<tr>
				<td>Following Tags</td>
				<td>
					<?php if($tags!=null){
					foreach ($tags as $tag) { ?>
						<span class="label label-default"><?=htmlspecialchars($tag->tag)?></span>
						<!-- <span style='font-size:26px'><?=htmlspecialchars($tag->tag)?></span> -->
					<?php }
					} 
					else
						echo "none"
					?> 
				</td>
			</tr>	
			

			
			<?php if ($userfile->positionshow == 1 ){ ?>
			<tr>
				<td>Current Postion</td>
				<td><?php echo $currentwork->position; ?></td>
			</tr>
			<?php }?>
			<?php if($userfile->employershow==1){ ?>
			<tr>
				<td>Current employer</td>
				<td><?php  echo $currentwork->employer;?></td>
			</tr>
			<?php }?>
			<?php if ($userfile->positionshow == 1 ){ ?>
			<tr>
				<td>Startyear</td>
				<td><?php echo $currentwork->startyear; ?></td>
			</tr>
			<?php }?>

			<tr>
				<td>Autobiography</td>
				<td><?=nl2br(htmlspecialchars($userfile->autobiography))?></td>
			</tr>

		</table>
	</div>
	<div class='user_image'>
		<?php if(isset($error)){echo $error;}?>

		<img src="<?=base_url("/uploads/".$userfile->image)?>" alt="Personal photo">
	</div>
<!-- 	<div class='user_autobiography'>
		<p>Autobiography</p>
		<?=nl2br(htmlspecialchars($userfile->autobiography))?>
	</div> -->
	<div>
				<!--NEW ADDING FOR USER ISSUES -->
		<?php if(count($issues) == 0 ){ ?>  
                 
        <?php }else{ ?>  
		<table class="table" id="issueList">   
                <tr>  
                    <td>標題</td>   
                    <td>點閱次數</td>
                    <td>發表時間</td>   
                </tr>  
                <?php foreach ($issues as $article) {   ?>  
                <tr>  
                    <td>  
                        <a href="<?=site_url("issue/view/".$article->issueid)?>">  
                            <?=htmlspecialchars($article->title)?>  
                        </a>  
                    </td>   
                    <td>  
                        <?=htmlspecialchars($article->views)?>  
                    </td>
                    <td>  
                        <?=htmlspecialchars($article->timestamp)?>  
                    </td>    
                <?php }//endfor ?>  
            </table>  
         <?php }  //end else ?>  
		
	</div>
</div>