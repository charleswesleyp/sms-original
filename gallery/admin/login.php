
<?php require_once("includes/header.php"); ?>

<?php

$message = "";

if($session->is_signed_in()){
    $session->redirect("index.php");
}

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

//Method to check user in database

    $user_in_database = User::verify_user($username, $password);

    if($user_in_database){
        $session->login($user_in_database);
        $session->redirect("index.php");
    }else{
        $message = "Username or password is incorrect";
    }
}else{
    $username = "";
    $password = "";
}

   ?>


<div class="col-md-4 col-md-offset-3">

    <h4 class="bg-danger">
        <?php echo $message ; ?>
    </h4>

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>


</div>
