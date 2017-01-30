<?php
class Core {

	// Function to validate the post data
	function validate_post($data)
	{
		// Counter variable
		$counter = 0;

		// Validate the hostname
		if(isset($data['hostname']) AND !empty($data['hostname'])) {
			$counter++;
		}
		// Validate the username
		if(isset($data['db_user']) AND !empty($data['db_user'])) {
			$counter++;
		}
		// Validate the password
		if(isset($data['db_password']) AND !empty($data['db_password'])) {
		  // pass
		}
		// Validate the database
		if(isset($data['db_name']) AND !empty($data['db_name'])) {
			$counter++;
		}
		
		
		// Check if all the required fields have been entered
		if($counter == '3') {
			return true;
		}
		else {
			return false;
		}
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) {

		// Config path
		$template_path 	= 'config/database.php';
		$output_path 	= '../application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['db_user'],$new);
		$new  = str_replace("%PASSWORD%",$data['db_password'],$new);
		$new  = str_replace("%DATABASE%",$data['db_name'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0755);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}
}