<?php 
    //include constants page
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) //either use "&&" or "AND"
    {
        //process to delete
       
        //get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the image if available
        //check whether the image is available or not and delete only if available
        if($image_name != "")
        {
            //it has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //check whether the image is remove or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the proccess to deleting food
                die();
            }
        }

        //delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message resprectively
        //redirect to manage food with session message
        if($res==true)
        {
            //food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        //redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>unauthorized access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>