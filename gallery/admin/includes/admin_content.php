
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

        <?php


$user = new User();

$user->username ="sia ";
$user->password = "logic";
$user->first_name = "sdkjhkjj";
$user->last_name = "jkdshgkj";

$user->create();


//$final = User::find_user_by_id(7);
//
//$final->username = "sia";
//
//
//$final->update();


//$user = User::find_user_by_id(3);
//
//$user->delete();



//$user = User::find_user_by_id(21);
//
//$user->username = "maheshbabu";
//
//$user->save();

//        $user = new User();
//
//        $user->username = "jhfjfjlu";
//
//        $user->save();

//
//


        ?>

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>