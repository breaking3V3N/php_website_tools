<?php

require_once "Theatre_Connection.php";

$theatre_name = $theatre_pass = $confirm_theatre_pass = "";
$theatre_name_err = '';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST['']))){
        $theatre_name_err = "Please enter a Theatre Name.";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $theatre_name_err = "Theatre Name can only contain letters, numbers, and underscores.";)
    }else{
            // Prepare a select statement
            $sql = "SELECT id FROM theatres WHERE 'theatre_name' = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_theatre_name = trim($_POST["Theatre name"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This Theatre Name is already taken.";
                    } else{
                        $theatre_name = trim($_POST["Theatre Name"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }


}


?>


<!DOCTYPE html>
<html lang="en-UK">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Theatre Name</label>
                <input type="text" name="Theatre name" class="form-control <?php echo (!empty($theatre_name)) ? 'is-invalid' : ''; ?>" value="<?php echo $theatre_name_err; ?>">
                <span class="invalid-feedback"><?php echo $theatre_name_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
</html>