<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
header('location:login_form.php');
}

if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];
mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$delete_id'") or die('query failed');
header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="users">

        <h2 class="title"> User accounts </h2>

        <div class="box-container">
            <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `user_form`") or die('query failed');
        while($fetch_users = mysqli_fetch_assoc($select_users)){
    ?>
            <div class="box">
                <table class="box-table">
                    <thead>
                        <tr>
                            <td>
                                <p><span><?php echo $fetch_users['id']; ?></span></p>
                            </td>
                            <td>
                                <p><span><?php echo $fetch_users['name']; ?></span></p>
                            </td>
                            <td>
                                <p><span><?php echo $fetch_users['email']; ?></span></p>
                            </td>
                            <td>
                                <p><span
                                        style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--blue)'; } ?>"><?php echo $fetch_users['user_type']; ?></span>
                                </p>
                            </td>
                            <td>
                                <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>"
                                    onclick="return confirm('Delete this user?');" class="delete-btn">Delete user</a>
                            </td>
                        </tr>
                    </thead>

                </table>
            </div>
            <?php
        };
    ?>
        </div>

    </section>


    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>