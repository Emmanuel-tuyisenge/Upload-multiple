<?php

if (!empty($_FILES['avatar']['name'])) {
    $picture = $_FILES[ 'avatar'];

    //$pictureName = $_FILES['avatar']['name'];
    $uploaded = [];
    $allowed = array('jpg', 'png', 'gif');

    //$pictureType = $_FILES['type']['$key'];

    foreach ($picture['name'] as $key => $pictureName) {

        $pictureTmpName = $picture['tmp_name'][$key];
        $pictureSize = $picture['size'][$key];
        $pictureError = $picture['error'][$key];

        $pictureExtension = explode('.', $pictureName);
        $pictureActualExtension = strtolower(end($pictureExtension));

        if (in_array($pictureActualExtension, $allowed)) {
            if ($pictureError === 0) {
                if ($pictureSize <= 1000000) {
                    $pictureNameNew = uniqid('', true) . '.' . $pictureActualExtension;
                    $pictureDestination = 'uploads/' . $pictureNameNew;
                    move_uploaded_file($pictureTmpName, $pictureDestination);
                      $uploaded[$key] = $pictureDestination;
                    //header("Location: index.php?uploadsuccess");
                } else {
                    $pictureError[$key] =  "[{$pictureName}] est gros!!";
                }
            } else {
                echo "Une erreur s'est produite lors du téléchargement de votre fichier ! ";
            }
        } else {
            echo "You can not upload files of this type!";
        }
    }
    if(!empty($uploaded)) {
        var_dump($uploaded);
    }

}

$it = new FilesystemIterator('uploads/');
foreach ($it as $fileinfo) {?>
    <form method="post" action="upload.php">
        <img src="../uploads/<?php  echo $fileinfo->getFilename() ?>" alt="..." "> <br />
        <button type="submit" value="<?php  echo $fileinfo->getFilename() ?>" name="delete">Delete</button>
    </form>

    <?php
    echo $fileinfo->getFilename() . "\n";
}
if (isset($_POST['delete'])){
    $filePath='uploads/'.$_POST['delete'];
    if(file_exists ( $filePath)){
        unlink($filePath);
    }
}