<?php 
	$currentwork= array_pop($userwork);
    $works = count ($userwork);
    $ids = count($userstudentid);
?>
<?php include("_header.php"); ?> 

		<table border='1'>
			<tr>
				<td>Username</td>
				<td><?php echo $userfile->username;?></td>
			</tr>
			<tr>
				<td>Student ID</td>
				<td><?php foreach ($userstudentid as $id) { 
					echo "$id->studentid ";
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
			<tr>
				<td>Autobiography</td>
				<td><?php echo $userfile->autobiography;?></td>
			</tr>
			<tr>
				<td>Usercategory</td>
				<td><?php echo $userfile->usercategory;?></td>
			</tr>
			<?php /*<tr>
				<td>Image</td>
				<td><?php echo $image;?></td>
			</tr>*/?>
			<?php if ( $currentwork->positionshow == 1 ){ ?>
			<tr>
				<td>Current Postion</td>
				<td><?php echo $currentwork->position; ?></td>
			</tr>
			<?php }?>
			<?php if(($currentwork->employershow==1)){ ?>
			<tr>
				<td>Current employer</td>
				<td><?php  echo $currentwork->employer;?></td>
			</tr>
			<?php }?>
		</table>
	<div>
		
	</div>