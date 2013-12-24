<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?> 
<div class="container article-view">     
    <div class="content" >  
		<div id="title"><h1><?=htmlspecialchars($issue->title)?></h1></div>
		<div id="author">Author：<?=htmlspecialchars($issue->username)?><p class="text-right"><?=nl2br(htmlspecialchars($issue->timestamp))?></p></div>
		<form action="<?=site_url("issue/editing/".$issue->issueid)?>" method="post" > 
			<table>
				<tr>
					<td><input type="text" name="content" 
					value="<?=nl2br(htmlspecialchars($issue->content))?>" /></td>
				</tr>
				<tr>
					<td colspan="2"> 
						<input type="submit" class="btn" value="Edit" />
						<a class="btn" href="<?=site_url("issue/issuelist")?>">Cancel</a>
					</td>
				</tr>
			</table>
		</form>
    </div>  
</div>  
<style type="text/css">
	#title{
		margin-left:20px;
		padding:10px;
	}
	#author{
		margin-left:30px;
	}
	#content{
		margin-left:20px;
	}
</style>
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
<?php include("_footer.php"); ?> 