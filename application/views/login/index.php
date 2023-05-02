        <div class="w-100 vh-100" style="background-color: #202B46;">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content ">
                <div class="container ">
                    <div class="row ">
                        <div class="col-md-4 col-sm-6 mx-auto col-md-offset-4 col-sm-offset-3">
                            <form action="<?=base_url()?>auth/auth_login" method="post">
                                <div id="bg-login" class="card card-login my-10 shadow-lg">
                                    <div class="card-header text-center d-flex justify-content-center">
                                        <h2 class="card-title fs-1 fw-bold">Login Dashboard</h2>
                                    </div>
                                    <div class="card-content">
                                        <div class="input-group mx-auto py-5">
                                            <div class="form-group mx-auto label-floating">
                                                <label class="control-label">Username</label>
                                                <div class="d-flex justify-content-start">
                                                    <input type="text" name="uname"  class="form-control" required>
                                                    <i class="far fa-eye position-relative d-none"  id="togglePassword" style="cursor: pointer">
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mx-auto py-2">
                                            <div class="form-group mx-auto label-floating ps-3">
                                                <label class="control-label">Password</label>
                                                <div class="d-flex align-items-center justify-content-start position-relative">
                                                    <!-- <input type="password" name="pass" class="form-control">
                                                    <i class="far fa-eye position-relative"  id="togglePassword" style="cursor: pointer"
                                                        toggle="#password">
                                                    </i> -->
                                                    <input id="text-secret" type="password" name="pass" class="form-control" required>
                                                    <i id="eye-toggle" class="far fa-eye-slash position-relative" style="cursor: pointer"></i>
                                                </div>
                                            </div>
                                            <?php
                                            echo @$_SESSION["error"];?>
                                        </div>
                                    </div>
                                    <div class="footer text-center my-5">
                                        <button type="submit" class="btn btn-letsgo ">Let's go</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>