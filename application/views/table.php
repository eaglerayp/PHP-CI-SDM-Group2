<?php include("_header.php"); ?> 
    <div class="container">
    	<table class="table table-hover"> 
    		<tr>
    			<td>Name</td>
    			<td>StudentID</td>
    		</tr>
    		
    		<?php foreach ($text as $element):?>
    		<tr>
    			<td><a href= "<?=site_url("user/profile?=")?>"> <?php echo $element->username;?></a></td>
    			<td><?php echo $element->studentid;?></td>
    		</tr>
    		<?php endforeach;?>
    	</table>    
    </div>
