<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?>
<style type="text/css">
	input {
		width:1000px;
	}
	textarea {
		width: 1000px;
	}
</style>
<div class="container">
	<div class="content">
		<form action="<?=site_url("issue/posting")?>" method="post" > 
			<?php if(isset($errorMessage)){ ?>
			<div class="alert alert-error"><?=$errorMessage?></div>
			<?php } ?>
			<table>
				<tr>
					<td>Title</td>
					<?php if(isset($title)){ ?>
						<td><input type="text" name="title" 
							value="<?=htmlspecialchars($title)?>" /></td>
					<?php }else{ ?>
						<td><input type="text" name="title" /></td>
					<?php } ?>
				</tr>
				<tr>
					<td>Tag</td>
					<td><input type="text" name="tag" />請在Tag前加上# 可支援多tag e.g.,#HASH #TAG  </td> 
				</tr>
				<tr>
					<td> Content </td>
					<td><textarea name="content" rows="10" cols="60"><?php 
						if(isset($content)){
							echo $content;
						}
					?></textarea></td>
				</tr>
				<tr>
					<td colspan="2"> 
						<input type="submit" class="btn" value="Send" />
						<a class="btn" href="<?=site_url("/")?>">Cancel</a>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>