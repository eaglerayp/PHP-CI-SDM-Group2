<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?> 
<div class="container article-view">     
    <div class="content" >  
		<div id="title"><h1><?=htmlspecialchars($issue->title)?></h1></div>
		<div id="author">作者：<?=htmlspecialchars($issue->username)?><p class="text-right"><?=nl2br(htmlspecialchars($issue->timestamp))?></p></div>
		<div id="content"><p><?=nl2br(htmlspecialchars($issue->content))?></p></div>
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