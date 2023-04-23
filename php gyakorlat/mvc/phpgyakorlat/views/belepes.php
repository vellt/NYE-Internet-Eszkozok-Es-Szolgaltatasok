<div class="row mt-3 justify-content-md-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">Belépés</div>
            <div class="card-body">
                <form action="controllers/belepes.php" method="post">
                    <?php if(isset($_GET['redirect'])): ?>
                        <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>">
                    <?php endif ?>
                    <div class="mb-3">
                        <label for="">Felhasználónév vagy email</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Jelszó</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember_me" id="remember_me" class="form-check-input" value="1">
                        <label for="remember_me" class="form-check-label">Emlékezz rám</label>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary">Belépés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>