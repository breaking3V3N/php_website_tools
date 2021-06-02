<?php


// intiialize sesion 

session_start();

// check whether user is loggin or not:
    //if user logged in, redirect the user to the welcome page. 

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
        header("location: welcome.php");
        exit;
    }

//include the connection file:

require_once 'Connection.php';

//initialize and define username and password with null values. 

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER['REQUEST_METHOD']== 'POST')
{
    if(empty(trim($_POST['username'])))
    {
        $username_err = "please enter a username";
    }
    else
    {
        $username = trim($_POST["username"]);
    }
    
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    //need to validate credentials.
    if(empty($username_err) && empty($password_err))
    {
        //preparing sql statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        //the sql command above gathers the id,l username , and password, based of the given username. 
        

        //need to lool into
        if ($stmt = mysqli_prepare($link,$sql))
        {
            //binding variables. look into
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            //set parameters. 
            $param_username = $username;
            


            

            //Attempt to execute the sql prepared statement(the variables are binded and the parameters are set)\
            if(mysqli_stmt_execute($stmt))
            {
                //if the preparted sql statement executes, store the result
                mysqli_stmt_store_result($stmt);
            

            //We now need to see whether the username exists or not. 
                if (mysqli_stmt_num_rows($stmt) == 1)
                {
                    /*we now need to bind the result variables:
                        (1) ID
                        (2) Username 
                        (3) hashed password 
                        */  
                
                    //binding the result variables 
                    mysqli_stmt_bind_result($stmt,$id,$username,$password);
                    if (mysqli_stmt_fetch($stmt))
                    {
                        if (password_verify($password,$hashedpassword))
                        {
                            //if the password is correct, we then need to start a new session
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id; 
                            $_Session['username'] = $username; 

                            //We then need to redirect the user to the welcome page 
                            header("location: Welcome.php");
                        }   
                        
                        else
                        {
                            $login_err = "Invalid username or password";
                        }

                    }
                    
                    else
                    {
                        $login_err = "Invalid username or password.";
                    }
                }
                
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            //look into closing the statement
            mysqli_stmt_close($stmt);           
       }

    }
    //close conection for databse querying
    
    mysqli_close($stmt);
}
?>