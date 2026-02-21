<?php
$config = [
		'admin/add_article'=>[
									['field'=>'title',
									'label'=>'Title',
									'rules'=>'required'		
									],
									['field'=>'article',
									'label'=>'Article',
									'rules'=>'required|min_length[15]|max_length[200]'		
									]
							],		
		'login/admin_login'=>[
									['field'=>'username',
									'label'=>'User Name',
									'rules'=>'required|alpha|trim'		
									],
									['field'=>'password',
									'label'=>'Password',
									'rules'=>'required'		
									]					
						]					
									
		]
?>