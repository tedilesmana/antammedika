<style>
    .bg-login {
        position: absolute; 
        top: 0;
        width: 100%;
        z-index: -5;
    }
</style>
<main>
    <img src="/assets/img/bg-login.png" alt="" class="bg-login">
    <section id="form-login">
        <div class="row reset">
            <div class="col-7"></div>
            <div class="col-5 px-5">
                <form class="p-5 card shadow" action="/" method="post">
                    <br>
                    <center>
                        <img src="/assets/img/logo-login.png" alt="">
                    </center>
                    <div class="py-5">
                        <div class="form-group">
                            <label for="email">Enter Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Your Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <br>
                        <center>
                            <p class="reset">Anda Belum Mempunyai Akun ?</p>
                            <a href="<?= base_url('register'); ?>" class="size-small">Silahkan Mendaftar Disini</a>
                        </center>
                        <br>
                        <br>
                        <center>
                            <button type="submit" class="btn badge-pill bg-primary-1 w-50 text-white">Login</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>