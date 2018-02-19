<?php

/*
* Author : Ajay Halthor
* Title : Photo Cropper Backend
* Description : Accessed from photo_crop.html
* Extra : Just make sure the directory in which we need to upload photos is 755 ot 777 
*/
function uploadImageFile() { // Note: GD library is required for this function
    $path_to_image_directory = 'images/';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $iWidth = $iHeight = 200; // desired image result dimensions
        $iJpgQuality = 90;
        if ($_FILES) {
            // if no errors and size less than 500kb
            if (! $_FILES['image_file']['error'] && $_FILES['image_file']['size'] < 500 * 1024) {
                if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {


                    /* We can change this to the required path. 
                    * For users, it can be "user/".$log_username
                    * or something like that
                    */

                    $sTempFileName = 'profile';

                    // new unique filename
                   //$sTempFileName = md5(time().rand());

                    /* We will delete the files/photos in the directory that have the 
                    * same name (though different extensions). This ensures that the jpg and
                    * png files are BOTH removed before upload. 
                    * So, when we access the image, we just need to look for the name. 
                    * Who cares about the extension.
                    */
                    $mask = $path_to_image_directory.$sTempFileName.'.*';
                    array_map('unlink', glob($mask));

                    /* The following 2 if blocks are an alternative the above 2 lines.
                    * Clearly, the 2 lines are better 
                    */

                   /* if(file_exists($path_to_image_directory.$sTempFileName.'.jpg')){
                        unlink($path_to_image_directory.$sTempFileName.'.jpg');
                    }

                    if(file_exists($path_to_image_directory.$sTempFileName.'.png')){
                        unlink($path_to_image_directory.$sTempFileName.'.png');
                    }*/

                    

                    // move uploaded file into cache folder
                    move_uploaded_file($_FILES['image_file']['tmp_name'], $sTempFileName);

                    // change file permission to 644
                    @chmod($sTempFileName, 0644);

                    if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                        $aSize = getimagesize($sTempFileName); // try to obtain image info
                        if (!$aSize) {
                            @unlink($sTempFileName);
                            return;
                        }

                        // check for image type
                        switch($aSize[2]) {
                            case IMAGETYPE_JPEG:
                                $sExt = '.jpg';

                                // create a new image from file 
                                $vImg = @imagecreatefromjpeg($sTempFileName);
                                break;
                            case IMAGETYPE_PNG:
                                $sExt = '.png';

                                // create a new image from file 
                                $vImg = @imagecreatefrompng($sTempFileName);
                                break;
                            default:
                                @unlink($sTempFileName);
                                return;
                        }

                        // create a new true color image
                        $vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );

                       $dim = $_POST['filedim'];
                        $arr = explode("x",$dim);
                        $w = $arr[0];
                        $h = $arr[1];

                        /* We can pass the width of container from the main photo_crop.html*/
                        $container_width = intval($_POST['max-width']);
                        //$container_width = 600;

                        if($w > $container_width){
                            // copy and resize part of an image with resampling
                             imagecopyresampled($vDstImg, $vImg, 0, 0, (int)($_POST['x1'] * $w/$container_width), (int)($_POST['y1'] * $w/$container_width), $iWidth, $iHeight, (int)($_POST['w'] * $w/$container_width), (int)($_POST['h'] * $w/$container_width));
                        }else{
                             imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$_POST['x1'], (int)$_POST['y1'] , $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);
                        }


                        // define a result image filename
                        $sResultFileName = $path_to_image_directory . $sTempFileName . $sExt;

                        // output image to file
                        imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                        @unlink($sTempFileName);

                        return $sResultFileName;
                    }
                }
            }else{
                echo 'File should be less than  500kb';
            }
        }
    }
}

$sImage = uploadImageFile();
echo '<img src="'.$sImage.'" />';
?>
