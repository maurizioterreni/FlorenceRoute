<?php   //funziona  è quello bono non usare formDBart
include 'libs/ConDB.php';
   
// $image_name - The relative path to an existent image from the script
// $thumb_width - The width of the thumbnail
// $thumb_height - the height of the thumbnail
// $prefix - a prefix to be added to the beginning of the name of the original
//    file in order to obtain the name that will be given to the thumbnail
// $prefix = "upload/"
// $image_name = $_FILES['file_1']['name']

create_cropped_thumbnail($_FILES['file_thb']['name'],$_FILES["file_thb"]["type"], $_FILES["file_thb"]["size"],$_FILES["file_thb"]["error"], $_FILES["file_thb"]["tmp_name"],100, 100, 300 , 300);

   
create_cropped_thumbnail($_FILES['file_1']['name'],$_FILES["file_1"]["type"], $_FILES["file_1"]["size"],$_FILES["file_1"]["error"], $_FILES["file_1"]["tmp_name"],100, 100, 300 , 300);


create_cropped_thumbnail($_FILES['file_2']['name'],$_FILES["file_2"]["type"], $_FILES["file_2"]["size"], $_FILES["file_2"]["error"], $_FILES["file_2"]["tmp_name"],100, 100, 300 , 300);

create_cropped_thumbnail($_FILES['file_3']['name'],$_FILES["file_3"]["type"], $_FILES["file_3"]["size"], $_FILES["file_3"]["error"],$_FILES["file_3"]["tmp_name"],100, 100, 300 , 300);


 
 $name=( htmlspecialchars (  $_POST['name'] , ENT_QUOTES ,'ISO-8859-15')); 
 $description=( htmlspecialchars (  $_POST['description'] , ENT_QUOTES ,'ISO-8859-15' ));
  $address=( htmlspecialchars (  $_POST['address'] , ENT_QUOTES ,'ISO-8859-15' ));
  $Tel= $_POST['tel'];
  $Web = $_POST['web'];
  $lat = $_POST['lat'];
  
  $lon = $_POST['lon'];
  $prezzo = $_POST['pr'];
  $orario = $_POST['hours_open']." - ".$_POST['hours_close'];

 $sql = "INSERT INTO Monument (ID, Nome, ID_Fs, Lat, Lon, Text, Url_Img, Apertura, Prezzo, Web_site, Tel) VALUES (NULL, '$name', '', '$lat', '$lon', '$description', 'img/$name', '$orario', '$prezzo', '$Web', '$Tel');";
			
			//'img/$name','$_POST[hours_open]' - '$_POST[hours_close]','$Web','$Tel')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
else echo "1 record added";

mysqli_close($con);


// $image_name - The relative path to an existent image from the script
// $thumb_width - The width of the thumbnail
// $thumb_height - the height of the thumbnail
// $prefix - a prefix to be added to the beginning of the name of the original
//    file in order to obtain the name that will be given to the thumbnail
// $prefix = "upload/"
// $image_name = $_FILES['file_1']['name']

function create_cropped_thumbnail( $image_name, $image_type, $image_size, $image_error, $tmp_name, $thumb_width, $thumb_height, $thumb_width_2 , $thumb_height_2 ) {

     $allowedExts = array("gif", "jpeg", "jpg", "png");
     $temp = explode(".", $image_name);   //serve per vedere che tipo di estensione ha(prende il nome dopo il                                                         punto)
     $extension = end($temp);                             //serve per vedere che tipo di estensione ha(setta il puntatore di un                                                      array all'ultimo elemento)

echo "typeeeeeee ".$image_type;
echo "sizeeeeeeee " .$image_size;

if ((($image_type == "image/gif")
|| ($image_type == "image/jpeg")
|| ($image_type == "image/jpg")
|| ($image_type == "image/pjpeg")
|| ($image_type == "image/x-png")
|| ($image_type == "image/png"))
&& ($image_size < 2000000) // 2 Mb
&& in_array($extension, $allowedExts))
  {
  
  if ($image_error > 0)
    {
    echo "Return Code: " . $image_error . "<br>";
    }
	
  else
    {
		
    echo "Upload: " . $image_name . "<br>";
    echo "Type: " . $image_type. "<br>";
    echo "Size: " . ($image_size / 1024) . " kB<br>";
    echo "Temp file: " . $tmp_name . "<br>";

    if (file_exists("upload/".$image_name)&& file_exists( "upload/thumb_" . $image_name) && file_exists( "upload/thumb_2_" . $image_name))
      {
      echo $image_name.  " ALREADY EXIST. ";
      }
    else
      {
               $resize =  'upload/'; 
             
                   switch ($extension) {
                       case "jpg":
                       case "jpeg":
                           $source_image = imagecreatefromjpeg($tmp_name);
                           break;
                       case "gif":
                           $source_image = imagecreatefromgif($tmp_name);
                           break;
                       case "png":
                           $source_image = imagecreatefrompng($tmp_name);
                           break;
                       default:
                           echo" ATTENZIONE FORMATO NON SUPPORTATO ";
                           break;
                   }

                   $source_width = imagesx($source_image);
                   $source_height = imagesy($source_image);
                    // per l'immagine con thumb_width e thumb_heigth
                   if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
                       $source_x = 0;
                       $source_y = 0;
                   }

                   if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
                       $source_y = 0;
                       $temp_width = $source_height * $thumb_width / $thumb_height;
                       $source_x = ($source_width - $temp_width) / 2;
                       $source_width = $temp_width;
                   }

                   if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
                       $source_x = 0;
                       $temp_height = $source_width * $thumb_height / $thumb_width;
                       $source_y = ($source_height - $temp_height) / 2;
                       $source_height = $temp_height;
                   }
				   
				
                   $tmp_image = imagecreatetruecolor($thumb_width, $thumb_height);

                   imagecopyresampled($tmp_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height,                $source_width, $source_height);

                   switch ($extension) {
                       case "jpg":
                       case "jpeg":
                           imagejpeg($tmp_image, "upload/thumb_"  . $image_name, 95);
                           break;
                       case "gif":
                           imagegif($tmp_image, "upload/thumb_"   . $image_name);
                           break;
                       case "png":
                           imagepng($tmp_image, "upload/thumb_"   . $image_name,1);
                           break;
                       default:
                           echo" thumb non creata! ";
                           break;
                   }

                   //imagedestroy($tmp_image);
                   //imagedestroy($source_image);
				   
				   
				   // per la seconda
				   
				        $source_width_2 = imagesx($source_image);
                        $source_height_2= imagesy($source_image);
						
				      if (($source_width_2 / $source_height_2) == ($thumb_width_2 / $thumb_height_2)) {
                       $source_x_2 = 0;
                       $source_y_2 = 0;
                   }

                   if (($source_width_2 / $source_height_2) > ($thumb_width_2 / $thumb_height_2)) {
                       $source_y_2 = 0;
                       $temp_width_2 = $source_height_2 * $thumb_width_2 / $thumb_height_2;
                       $source_x_2 = ($source_width_2 - $temp_width_2) / 2;
                       $source_width_2 = $temp_width_2;
                   }

                   if (($source_width_2 / $source_height_2) < ($thumb_width_2 / $thumb_height_2)) {
                       $source_x_2 = 0;
                       $temp_height_2 = $source_width_2 * $thumb_height_2 / $thumb_width_2;
                       $source_y_2 = ($source_height_2 - $temp_height_2) / 2;
                       $source_height_2 = $temp_height_2;
                   }
				   
				
                   $tmp_image_2 = imagecreatetruecolor($thumb_width_2, $thumb_height_2);

                   imagecopyresampled($tmp_image_2, $source_image, 0, 0, $source_x_2, $source_y_2, $thumb_width_2, $thumb_height_2, $source_width_2, $source_height_2);

                   switch ($extension) {
                       case "jpg":
                       case "jpeg":
                           imagejpeg($tmp_image_2, "upload/thumb_2_" . $image_name, 95);
                           break;
                       case "gif":
                           imagegif($tmp_image_2, "upload/thumb_2_"  . $image_name);
                           break;
                       case "png":
                           imagepng($tmp_image_2, "upload/thumb_2_"  . $image_name,1);
                           break;
                       default:
                           echo" thumb non creata! ";
                           break;
                   }

                
  echo " Stored in: " . "upload/" . $image_name ."</br></br>";
      }
	  move_uploaded_file($tmp_name, "img/" . $image_name);
    }
  }
  else
  { echo " INVALID FILE!</br></br> ";
  }
	 
}//fine funzione
?>