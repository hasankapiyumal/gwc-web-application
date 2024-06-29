
<!DOCTYPE html>
<html>

<head>
    <title>GWC Computers Admin login</title>
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
            <div class="col-12" style="background-color: #1C1C1C;">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3 mt-2 text-warning logo">
                        GWC computers
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h1 class="offset-lg-1 col-lg-10 text-lg-center mt-3  col-12">Welocome to gwc computers Admin</h1>
            </div>


            <div class="col-12 p-5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background "></div>
                    <div class="col-12 col-lg-6 offset-lg-3 d-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="fs-2">Sign In To Your Account.</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control " type="email" id="e" />
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-outline-warning" onclick="adminverification();">Send Verification
                                    Code to Login</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <a href="index.php" class="btn btn-outline-danger">Back to Home Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Addmin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification Code you got by an Email...</label>
                            <input type="text" class="form-control" id="v" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="Verify();">Verify</button>
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