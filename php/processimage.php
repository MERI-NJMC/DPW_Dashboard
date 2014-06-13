<?php
//Author: Ishan Patel
//Last Edited By: Jose Baez
//Last Modified: 12/9/2013 11:36AM
//This script uploads jpeg files into a specified folder. It resizes any photo with a height or width dimension greater than 800.
//max image size 800x800px


	ini_set("gd.jpeg_ignore_warning", 0);
	error_reporting(E_ALL);// Change to error_reporting(E_ALL) when testing to show errors and warnings.(0) to show none.
	if (!empty($_FILES["image"]) && $_FILES["image"]["error"]==0)
	{
		$again = false;
		$MAXSIZE= 800;
		$image=$_FILES["image"];
		$name = $image['name'];
		$size = $image['size'];
		if($_POST['bid'] != null) {
			$ID = $_POST['bid'];
		} else if($_POST['mid'] != null) {
			$ID = $_POST['mid'];
		} else {
			$ID = $_POST['oid'];
		}

		$target_path = "../images/" . $ID .".jpg"; //this path was for testing purposes. The final path may differ.
		
		$backup_path = "../images/backups/" . $ID .".jpg";
		$valid_formats = array("jpg","jpeg");
		$ext = explode(".", $name);
		if(in_array(strtolower(end($ext)),$valid_formats))
		{
			list($CurWidth,$CurHeight)=getimagesize($image['tmp_name']);
			if($CurWidth>800 || $CurHeight>800)
			{
				$newwidthratio = $CurWidth/800;
				$newheightratio = $CurHeight/800;
				$CreatedImage = imagecreatefromjpeg($image['tmp_name']);
				if($CreatedImage)
				{
					resizeImage(round(800*$newwidthratio),round(800*$newheightratio),$MAXSIZE,$target_path,$CreatedImage,$name,$target_path,$backup_path);
				}
				else
				{
					exit;
				}
				list($CurWidth,$CurHeight)=getimagesize($image['tmp_name']);
			}
			if($CurWidth<=800 && $CurHeight<=800)
			{
				$moved = false;
				if(file_exists($target_path))
				{
					$i=0;
					if(file_exists($backup_path."_0.jpg"))
					{
						while(file_exists($backup_path."_".$i.".jpg"))
						{
							$i++;
						}
						copy($target_path, $backup_path."_".$i.".jpg") or die("error");
					}
					else
					{
						copy($target_path, $backup_path."_".$i.".jpg") or die("error");
					}
					$moved = true;
				}
				if(!move_uploaded_file($image['tmp_name'], $target_path))
					if($moved==true)
						unlink($backup_path);
			}
		}
		if($again == true)
		{
			$PID = explode( '-', $_POST['ID']);
			$PID = $PID[0];
			$target_path2 = "../../images/property/PID/".$PID.".jpg";
			$backup_path = "../../images/property/HPID/".$PID;
			$moved = false;
			if(file_exists($target_path2))
			{
				$i=0;
				if(file_exists($backup_path."_0.jpg"))
				{
					while(file_exists($backup_path."_".$i.".jpg"))
					{
						$i++;
					}
					copy($target_path2, $backup_path."_".$i.".jpg") or die("error");
				}
				else
				{
					copy($target_path2, $backup_path."_".$i.".jpg") or die("error");
				}
				$moved = true;
			}
			if(!copy($target_path, $target_path2))
			{
				if($moved==true)
					unlink($backup_path);
			}
			else
			{
			}
		}
	}
	else
	{
		exit;
	}

header('Location: http://webmaps.njmeadowlands.gov/municipal/utilities/');
exit;
	
function resizeImage($CurWidth,$CurHeight,$MAXSIZE,$DestFolder,$SrcImage,$name,$target_path,$backup_path)
{
	//Construct a proportional size of new image
	$ImageScale = min($MAXSIZE/$CurWidth, $MAXSIZE/$CurHeight);
	$NewWidth = ceil($ImageScale*$CurWidth);
	$NewHeight = ceil($ImageScale*$CurHeight);
	$NewCanves = imagecreatetruecolor($NewWidth, $NewHeight);
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		if(file_exists($target_path))
		{
			$i=0;
			if(file_exists($backup_path."_0.jpg"))
			{
				while(file_exists($backup_path."_".$i.".jpg"))
				{
					$i++;
				}
				copy($target_path, $backup_path."_".$i.".jpg") or die("error");
			}
			else
			{
				copy($target_path, $backup_path."_".$i.".jpg") or die("error");
			}
			$moved = true;
		}

		imagejpeg($NewCanves,$DestFolder);
	}
	else
	{
		return false;
	}
	//Destroy image, frees up memory
	if(is_resource($NewCanves))
	{
		imagedestroy($NewCanves);
	}
	return true;
}
?>
