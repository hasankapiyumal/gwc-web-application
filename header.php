<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="row">
        <div class="col-12  mt-0" style="height: 5px; background-color: red;"></div>
        <div class="col-12 " style="background-color: black;">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-12 text-primary text-warning logo">
                          <a style="text-decoration: none;" href="index.php"> gwc computers </a> 
                        </div>
                    </div>
                </div>
                <div class="offset-lg-3 offset-md-0 col-md-6 col-lg-3 col-12 offset-0 text-white mt-lg-3 mt-md-3 ">
                    <?php
                                 if(isset($_SESSION['user'])){
                                   
                                   $user=$_SESSION['user'];
                                   ?>
                    <i class="bi bi-door-open-fill"></i><a class="fs-5 text-white" style="text-decoration: none; " href="userprofile.php"><?php echo $user["fname"] ." ".  $user["lname"];  ?>
                                 </a> | <i class="bi bi-cart-fill fs-5" onclick=" goToCart();"></i>  | <i class="bi bi-heart-fill" onclick="goToWatchList();"></i>
                    <?php 
                                 }else{
                                 ?>
                    <i class="bi bi-door-open-fill"></i><label onclick="signin();" class="fs-5">login/register</label> |<i class="bi bi-cart-fill fs-5" ></i> | <i class="bi bi-heart-fill"></i>
                    <?php
                                 }
                                 ?>

                </div>
                <!-- <div class="col-12">
                    <div class="row">

                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="single" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title text-primary align-content-center fs-2" id="title1">Sign in</h5>
                    <h5 class="modal-title text-primary align-content-center fs-2 d-none" id="title2">Sign up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 d-none " id="signupbox">
                            <div class="row">
                            <div class="row g-3">
                            <div class="col-12">
                               <p class="title2"> Create a new Account</p>
                               <p class="text-danger" id="messageSignup"></p>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname"/>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname"/>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"/>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password"/>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Conform Password</label>
                                <input type="password" class="form-control" id="repassword"/>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile"/>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender">

                                <?php
                                    require "connection.php";

                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;
                                    for($x=0;$x<$n;$x++) {
                                        $d = $r->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $d['id']; ?>"><?php echo $d['gender']; ?></option>
                                        <?php
                                    }
                                  ?>

                                </select>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary " onclick="signUp();">Sign up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger " onclick="changeView();">Sign in</button>
                            </div>

                        </div>
                            </div>
                        </div>
                        <div class="col-12 " id="signinbox">
                            <div class="row">
                                <div class="col-12">
                                <?php

$e = "" ;
$p = "" ;

if(isset($_COOKIE["e"])){
    $e = $_COOKIE["e"];
}
if(isset($_COOKIE["p"])){
    $p = $_COOKIE["p"];
}


?>
                                <p class="text-danger" id="messegesignin"></p>
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $e; ?>" id="email2" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">password</label>
                                    <input type="password" class="form-control" value="<?php echo $p; ?>" id="password2" />
                                </div>
                                <div class="col-6">
                                    <div class="form-checkbox">
                                        <input class="form-check-input" type="checkbox" value="1" id="remember" />
                                        <label class="form-check-label">Remember Me</label>
                                    </div>

                                    <div class="col-12">
                                        <a href="#" class="link-primary" onclick="forgotPassword();">Forgot
                                            Password?</a>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary col-5" onclick="signIn();">Sign in</button>
                                        <button class="btn btn-danger col-5" onclick="changeView();">Sign up</button>
                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
                  
<!-- Modal -->
<div class="modal fade" tabindex="-1" id="forgetPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">     
                                    <div class="col-6">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group mb-3 "> 
                                            <input  class="form-control" type="password" id="np"/>
                                            <button class="btn btn-primary" type=button id="npb" onclick="showPassword1();">Show</button>
                                            </div>
                                        
                                    </div>
                                    <div class="col-6">
                                            <label class="form-label">Re type Password</label>
                                            <div class="input-group mb-3 "> 
                                            <input  class="form-control" type="password" id="rnp"/>
                                            <button class="btn btn-primary" type=button id="rnpb" onclick="showPassword2();">Show</button>
                                            </div>
                                    </div>
                                        <div class="col-12">
                                            <label class="form-label">Verification Code</label>
                                            <input type="text" class="form-control" id="vc"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"onclick="resetPassword();">Reset</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    </div>
            <!-- modal close -->
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>