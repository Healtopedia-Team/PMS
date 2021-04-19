<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Patient Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h4 class="auth-title" style="margin-top: -50px; font-size:3rem;">Sign Up</h4>
                    <p class="auth-subtitle mb-5">Be a part of the synergy</p>

                    <form class="form form-vertical" style="margin-top:-30px;" action="function.php" method="post">
                    <input type="hidden" name="command" value="ADD_USER">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="First name" id="first-name-icon" name="firstname" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Last name" id="last-name-icon" name="lastname" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Username" id="user-name-icon" name="username" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Email" id="email-id-icon" name="email" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="form-group">
                                        <select class="choices form-select" name="hospital" required>
                                            <option value="">Choose Hospital</option>
                                            <option value="McKay Medicare Center">McKay Medicare Center</option>
                                            <option value="KPJ Kedah Medical Centre">KPJ Kedah Medical Centre</option>
                                            <option value="Sunway TCM Centre">Sunway TCM Centre</option>
                                            <option value="Kuala Lumpur International Healthcare Centre">Kuala Lumpur International Healthcare Centre</option>
                                            <option value="Regen Rehab Hospital">Regen Rehab Hospital</option>
                                            <option value="Sunway Medical Centre">Sunway Medical Centre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                <div class="form-group">
                                        <select class="choices form-select" name="role" required>
                                            <option value="">Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="receptionist">Receptionist</option>
                                            <option value="financial manager">Financial Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Password" id="password-id-icon" name="password" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Repeat Password" id="password-id-icon" required >
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class='form-check'>
                                        <div class="checkbox mt-2">
                                            <input type="checkbox" id="remember-me-v" class='form-check-input' checked>
                                            <label for="remember-me-v">Remember Me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>