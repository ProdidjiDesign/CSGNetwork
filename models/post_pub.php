<?php
function uploadFiles(){

            $images = array();
            if(isset($_FILES['photos'])){
                for($a = 0; $a<count($_FILES['photos']['name']); $a++){
                    $target = '../uploads/';
                    $extensions = array('jpg','gif','png','jpeg');
                    $ext  = pathinfo($_FILES['photos']['name'][$a], PATHINFO_EXTENSION);
                                
                        if (in_array(strtolower($ext),$extensions)){
                            if(isset($_FILES['photos']['error'][$a]) && UPLOAD_ERR_OK === $_FILES['photos']['error'][$a]){
                                $img_name = md5(uniqid()) .'.'. $ext;
                                switch (strtolower($ext)) {
                                    case 'jpg':
                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
                                        break;
                                    case 'jpeg':
                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
                                        break;
                                    case 'png':
                                        $img = imagecreatefrompng($_FILES['photos']['tmp_name'][$a]);
                                        break;
                                    case 'gif':
                                        $img = imagecreatefromgif($_FILES['photos']['tmp_name'][$a]);
                                    break;
                                    default:
                                        $img = imagecreatefromjpeg($_FILES['photos']['tmp_name'][$a]);
                                    }

                                $width = imagesx($img);
                                $height = imagesy($img);

                                $new_width = 900;
                                $new_height = floor($height * ( 900 / $width ));

                                $tmp_img = imagecreatetruecolor($new_width, $new_height);

                                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                                $pathToImage = $target.$img_name;
            
                                
                                switch (strtolower($ext)) {
                                    case 'jpg':
                                        imagejpeg($tmp_img, $pathToImage);
                                        break;
                                    case 'jpeg':
                                        imagejpeg($tmp_img, $pathToImage);
                                        break;
                                    case 'png':
                                        imagepng($tmp_img, $pathToImage);
                                        break;
                                    case 'gif':
                                        imagegif($tmp_img, $pathToImage);
                                    break;
                                    default:
                                        imagejpeg($tmp_img, $pathToImage);
                                    }
                                    $result = $pathToImage;
                                if($result && $a>0){
                                    $images[$a] = " <div class='mosaicflow__item'><img src = '".substr($pathToImage,1)."' /></div>";
                                }
                                else{
                                    $images[$a] = "<img src = '".substr($pathToImage,1)."' />";
                                }
                            }
                        }
                }
                return $images;
            }
            else{
                return false;
            }
}

function insertPost($content, $dest, $level,  $bdd){


        $new_post = $bdd->prepare('INSERT INTO `posts`(`id`, `author`, `pub_date`, `content`, `level`, `dest`, `sticky`) VALUES (NULL, :author, NOW(), :content, :level, :dest, "");');
        $new_post->execute(array(

            'author' => $_SESSION['co_elements']['first']." ".$_SESSION['co_elements']['name'],
            'content' => $content,
            'level' => $level,
            'dest' => $dest

        ));

        $new_post -> closeCursor();

        return true;

    }

?>