<div class="card">
    <h3 class="card-header">Profil adatok frissítése</h3>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Vezetéknév</label>
                    <input type="text" name="vezeteknev" class="form-control" value="<?=$_SESSION['user']['vezeteknev']?>">
                </div>
                <div class="col-md-6">
                    <label for="">Keresztnév</label>
                    <input type="text" name="keresztnev" class="form-control" value="<?=$_SESSION['user']['keresztnev']?>">
                </div>

                <div class="col-md-6">
                    <label for="">E-mail*</label>
                    <input type="email" name="email" class="form-control" required value="<?=$_SESSION['user']['email']?>">
                </div>
                <div class="col-md-6">
                    <label for="">Felhasználónév*</label>
                    <input type="text" name="felhasznalonev" class="form-control" required value="<?=$_SESSION['user']['felhasznalonev']?>">
                </div>

                <div class="col-md-6">
                    <label for="">Jelszó*</label>
                    <input type="password" name="jelszo" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Jelszó újra*</label>
                    <input type="password" name="jelszoujra" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Neme</label>
                    
                    <input type="radio" name="neme" class="form-check-input" value="Férfi" checked id="neme-ferfi" >
                    <label for="neme-ferfi" class="form-check-label">Férfi</label>

                    <input type="radio" name="neme" class="form-check-input" value="Nő" id="neme-no" <?=($_SESSION['user']['neme']=='Nő')? 'checked' : null ?> >
                    <label for="neme-no" class="form-check-label">Nő</label>
                    
                </div>
                <div class="col-md-6">
                    <label for="">Születési év*</label>
                    <select name="szuletesiev" id="" class="form-select" required>
                        <option value="">-- Választás --</option>
                        <?php
                        /**
                         * for(ciklusvaltozo;feltetel;cvleptetese)
                         * {
                         * 
                         * }
                         * for(ciklusvaltozo;feltetel;cvleptetese):
                         * 
                         * 
                         * endfor;
                         * $
                         * print - echo - <?=?>
                         */
                            for($i=(date('Y')-90);$i<=(date('Y')-10);$i++):
                        ?>
                            <option value="<?=$i?>" <?=($_SESSION['user']['szuletesiev']==$i)? 'selected' : null ?>>
                                <?=$i?>
                            </option>
                        <?php endfor ?>
                    </select>
                </div>
                <div class="col-md-6">

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="hirlevel" name="hirlevel" value="1" <?=($_SESSION['user']['hirlevel']=='1')? 'checked' : null ?>>
                    <label class="form-check-label" for="hirlevel">Hírlevél</label>
                </div>
            
                </div>
                <div class="col-md-6">
                    <label for="">Leírás</label>
                    <textarea name="leiras" class="form-control" placeholder="Leírás szövege"><?=$_SESSION['user']['vezeteknev']?></textarea>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary">Frissírés</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    //teljes DOM betoltesenek kivarasa
    $(function(){

        //urlap submit esemenye
        $('form').on('submit',function(e){
            //szinkron mukodes letiltasa
            e.preventDefault();
            $.ajax({
                url:        'controllers/profil.php',
                method:     'POST',
                dataType:   'JSON',
                data:       $('form').serialize()
            }).done(function(adat){
                
                $('#uzenet').text(adat.uzenet).removeClass().addClass(adat.class);

            }).fail(function(){
                alert('Sikertelen AJAX művelet!');
            });
        });

    });
    
</script>
<div></div>