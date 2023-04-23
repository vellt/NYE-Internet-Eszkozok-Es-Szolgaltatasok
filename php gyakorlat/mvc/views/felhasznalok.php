<?php

    if(isset($_POST['user_id'])){
        // sql injeckió elleni védelem!
        // user_id csak szám karaktert tartalmazhat is_ függvények
        // is_numeric vizsgálja a paramétert, ha csak szám karaktereket tartalmaz, akkor true
        // [is_int erre nem jó, mert típust is vizsgál, minden form adat a PHP-ban string típusként jelenik meg]
        if(is_numeric($_POST['user_id'])){
            // az sql injektióhoz számokon kívül betúk is kellek ezért már védve vagyunk itt a lehetséges támadásoktól
            // törlés
            $sql ="DELETE FROM users WHERE id='{$_POST['user_id']}'";
            $mydb->query($sql);
        }


    }

    // lekérni a users tábla adatait

    $sql = "SELECT * FROM users";

    $query= $mydb->query($sql);

    // while ciklussal bejárjuk a lekért rekordokat 

?>


<table id="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Név</th>
            <th>Email</th>
            <th>Felhasználónév</th>
            <th>Neme</th>
            <th>Szül. dátum</th>
            <th>Hírlevél</th>
            <th>Leírás</th>
            <th>Reg. dátum</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php while($result=$query->fetch_assoc()): ?>
            <tr>
                <td><?=$result['id']?></td>
                <td><?=$result['vezeteknev']?> <?=$result['keresztnev']?></td>
                <td><?=$result['email']?></td>
                <td><?=$result['felhasznalonev']?></td>
                <td><?=$result['neme']?></td>
                <td><?=$result['szuletesiev']?></td>
                <td><?=($result['hirlevel'])?'Igen':'Nem'?></td>
                <td><?=$result['leiras']?></td>
                <td><?=$result['created_at']?></td>
                <td>
                    <?php if($_SESSION['user']['id']!=$result['id']):?>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?=$result['id']?>">
                        <button class="btn btn-danger" onclick="return confirm('Valóban törölni szeretné a felhasználót?')">Törlés</button>
                    </form>
                    <?php endif ?>
                </td>
            </tr>
        <?php endwhile ?>
    </tbody>
</table>
<script>
    let table = new DataTable('#user-table');
</script>