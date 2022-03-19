<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
        
            if(isset($_SESSION['add'])) //Checking wheather the session is set of not 
            {
                echo $_SESSION['add']; //Displayng session message
                unset($_SESSION['add']); //Remove session message
            }

        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php 
    // Process the value from Form and Save it in database

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button clicked
        // Button not clicked
        //$full_name = $_POST['full_name'];
        //$username = $_POST['username'];
        //$password = md5($_POST['password']); //password encryption with MD5
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // Executing Query and Salving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Check wehther the (Query is Executed) data is inserted or not and display appropiate message
        if($res==true)
        {
            //Data inserted
            //echo "Data inserted";
            //Create a session variable to display message
            $_SESSION['add'] = "Admin Added Successfully";
            //Redirect Page to admin manage
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to inserted data
            //echo "Failed to inserted Data";
            //Create a session variable to display message
            $_SESSION['add'] = "Failed to add admin";
            //Redirect Page to add admin manage
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>