<style>
    .bg-register {
        position: absolute;
        top: 0;
        width: 100%;
        z-index: -5;
    }
</style>
<main>
    <img src="/assets/img/bg-register.png" alt="" class="bg-register">
    <section id="form-register">
        <div class="row reset">
            <div class="col-7"></div>
            <div class="col-5 px-5">
                <form class="p-5 card shadow" action="/profile" method="post">
                    <br>
                    <center>
                        <h4 class="font-weight-bold color-primary-1">UPDATE PROFILE</h4>
                    </center>
                    <div class="pt-5">
                        <div class="form-group">
                            <label for="firstname">Enter Your First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your text with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="lastname">Enter Your Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('firstname', $user['lastname']) ?>">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your text with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="email">Enter Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= $user['email'] ?>" readonly>
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="password">Enter Your Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Confirm Your Password</label>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                        </div>
                        <br>
                        <center>
                            <p class="reset">Anda Belum Mempunyai Akun ?</p>
                            <a href="<?= base_url('/'); ?>" class="size-small">Silahkan Masuk Disini</a>
                        </center>
                        <br>
                        <center>
                            <button type="submit" class="btn badge-pill bg-primary-1 w-50 text-white">Update</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
