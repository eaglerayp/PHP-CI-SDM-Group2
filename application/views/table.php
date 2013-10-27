<?php include("_header.php"); ?> 
    <div class="container">
    	<table border=1> 
    		<tr>
    			<td>Name</td>
    			<td>StudentID</td>
    		</tr>
    		
    		<?php foreach ($text as $element):?>
    		<tr>
    			<td><a href= "<?=site_url("user/profile?userID=".$element->userid)?>"> <?php echo $element->username;?></a></td>
    			<td><?php echo $element->studentid;?></td>
    		</tr>
    		<?php endforeach;?>
    	</table>    
    </div>
