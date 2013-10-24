<html>
<head>
<title>Upload Form</title>
</head>
<body>
<?php /*$upload_data = array , keyname=attributes have 'file_name'  file_type is_image image_width image_heigth image_type   using as $upload_data['filename'] 
reference: http://www.codeigniter.org.tw/user_guide/libraries/file_uploading.html
*/?>
<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<img src="<?=base_url("/uploads/".$upload_data['file_name'])?>" alt="personal photo">
<p><?php echo anchor('upload','Upload Another File!'); ?></p>

</body>
</html>