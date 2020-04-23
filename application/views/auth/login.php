    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center text-dark">
                                        <h1 class="h3 font-weight-bolder mb-4">Halaman Login</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" nama="username" placeholder="Masukkan Username Anda...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password Anda">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block mb-5">
                                            Login
                                        </button>

                                    </form>
                                    <div class="p-4"></div>
                                    <hr>
                                    <div class="text-center text-dark">

                                        <div class="medium font-weight-bold">Belum Punya Akun?</div>

                                    </div>
                                    <div class="text-center">
                                        <a class="medium" href="<?= base_url('auth/registrasi'); ?>">Silahkan Registrasi!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>