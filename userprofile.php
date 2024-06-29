<!DOCTYPE html>
<html>

<head>
    <title>gwc computers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/onlinelogomaker-110321-1822-7532-2000-transparent.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <?php  require "header.php" ?>
                <?php
if(isset($_SESSION["user"])){
?>
            </div>
            <div class="col-12">
                <div class="row">
                    <!-- user profile -->
                    <div class="col-md-4 col-12 col-lg-4 border-end">
                        <div class="d-flex  flex-column align-items-center text-center p-3 py-5">



                            <?php
                             
                $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $_SESSION['user']['email'] . "';");
                $pn = $profileimg->num_rows;

                if ($pn == 1) {
                    $p = $profileimg->fetch_assoc();
                ?>
                            <img class="rounded-circle mt-5" class="card-img-top" width="150px"
                                src="<?php echo $p["code"]; ?>">

                            <?php
                } else {
                ?>
                            <image class="rounded mt-5" width="150px" src="resources/demoProfileImg.jpg" />
                            <?php


                }
                ?>




                              
                            <span
                                class="font-weight-bold"><?php echo $_SESSION["user"]['fname']." ".$_SESSION["user"]["lname"];?>
                            </span>
                            <span class="text-black-50"><?php echo $_SESSION["user"]['email']; ?></span>

                            <input class="d-none" type="file" id="profileimg" accept="img/" />
                            <label class="btn btn-outline-primary mt-3 col-6" for="profileimg">Update Profile
                                Image</label>
                            <label class="btn btn-outline-danger mt-2 col-6" onclick="signOut();">Sign out</label>
                        </div>

                    </div>


                    <!-- user profile close -->
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="row">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control"
                                          placeholder="first name"  value="<?php echo $_SESSION['user']['fname']; ?>" id="first_name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control"
                                        placeholder="last name"  value="<?php echo $_SESSION['user']['lname']; ?>" id="last_name" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control"
                                        placeholder="Enter Phone Number"  value="<?php  echo $_SESSION['user']['mobile']; ?>" id="mobile_number" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control"
                                           disabled value="<?php echo $_SESSION['user']['password']; ?>" id="password" />
                                    </div>
                                </div>
                                <?php
                                    $email=$_SESSION['user']['email'];
                                   $zero="0";
                                       $data =database::search("SELECT * FROM  `user` WHERE  `address_id`='".$zero."' AND `email`='".$email."'");
                                      $rows=$data->num_rows;

                                      $city_data=Database::search("SELECT * FROM  `city` ");
                                      $city_rows=$city_data->num_rows;

                                      if($rows==1){
                                     
                                    $details=$data->fetch_assoc();
                                     ?>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control"
                                          disabled  value="<?php echo $_SESSION['user']['email']; ?>" id="email" />


                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Address Line 01</label>
                                        <input type="text" class="form-control" placeholder="Address Line 01"
                                            id="line1" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Address Line 02</label>
                                        <input type="text" class="form-control" placeholder="Addres Line 02"
                                            id="line2" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <Select id="city" class="form-control">
                                            <?php
                                      

                                        for($x=0;$x<$city_rows;$x++){
                                            $city=$city_data->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $city["id_city"]; ?>"><?php echo $city["name"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        </Select>


                                    </div>
                                </div>
                                <?php
                                      }else{
                                        // $id=database::search("SELECT * FROM `user` WHERE  `email`='".$email."' ");
                                        // $id_data=$id->fetch_assoc();
                                        $user_address_id=$_SESSION['user']['address_id'];
                                        $user_data=database::search("SELECT * FROM `address` INNER JOIN `city` ON `address`.`city_id`=`city`.`id_city` WHERE `address`.`id`='".$user_address_id."'");
                                        $user_data_details=$user_data->fetch_assoc();

                                       ?>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="text" class="form-control"
                                          disabled  value="<?php echo $_SESSION['user']['email']; ?>" id="email" />


                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Address Line 01</label>
                                        <input type="text" class="form-control" placeholder="last name" id="line1"
                                            value="<?php echo $user_data_details["line1"] ; ?>" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Address Line 02</label>
                                        <input type="text" class="form-control" placeholder="first name" id="line2"
                                            value="<?php echo $user_data_details["line2"]; ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <Select id="city" class="form-control">
                                            <option value="<?php echo $user_data_details["id_city"] ?>">
                                                <?php echo $user_data_details["name"]; ?></option>
                                            <?php
                                        for($x=0;$x<$city_rows;$x++){
                                            $city=$city_data->fetch_assoc();
                                            ?>

                                            <option value="<?php echo $city["id_city"]; ?>"><?php echo $city["name"]; ?>
                                            </option>
                                            <?php
                                             }
                                            ?>
                                        </Select>
                                    </div>

                                </div>
                                <?php
                                      }

                                ?>
                                <!-- button -->
                                <div class="d-d-grid mt-5 col-4 offset-4 text-center">
                                    <button class="btn btn-outline-success" onclick="updateProfile();">Update
                                        Profile</button>
                                </div>
                                <!-- button  close-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php    
}else{
?>
<script>
window.location = "index.php";
</script>
<?php
}
?>