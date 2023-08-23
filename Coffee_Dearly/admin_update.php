<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
    if($update_image_size > 2000000){
        $message[] = 'image file size is too large';
    }else{
        mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
        move_uploaded_file($update_image_tmp_name, $update_folder);
unlink('uploaded_img/'.$update_old_image);
        }
    }

    header('location:admin_products.php');

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    if(isset($_GET['update'])){
        $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
        <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
            placeholder="enter product name">
        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box"
            required placeholder="enter product price">
        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp">
        <input type="submit" value="update" name="update_product" class="btn">
        <input type="reset" value="cancel" id="close-update" class="option-btn">
    </form>
    <?php
        }
    }
    }else{
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
?>
</body>

</html>