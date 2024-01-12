<h1><?= $title ?></h1>
<hr/>
<div>
    <a href="updateAdresController.php">Adres bijwerken</a>
    <a href="homecontroller.php">Bestelling bijwerken</a>
</div>
<div>
    <?php require_once $winkelwagen; ?>
</div>
<div>
    <form action="" method="POST">
        <label for="opmerkingen">opmerkingen:</label>
        <input type="text" id="opmerkingen" name="opmerkingen" value="<?php echo $opmerkingen ?>">

        <input type="submit" name="knop" value="Opmerking opslaan"/>
    </form>
</div>
<div>
    <a href="bestellingPlaatsenController.php?afrekenen">Bestelling Plaatsen </a>
</div>
<hr/>
<div>
    <table>
        <thead>
            <tr>
                <th colspan=4 class="hoofdtabel"><h2>Leveradres</h2></th>
            </tr>
            <tr>
                <th>Straat</th>
                <th>Huisnummer</th>
                <th>Postcode</th>
                <th>Woonplaats</th>
            </tr>
        </thead>
        <tbody>
            <td><?php echo $klantGegevens->getAdres()->getStraat(); ?></td>
            <td><?php echo $klantGegevens->getAdres()->getHuisnummer(); ?></td>
            <td><?php echo $klantGegevens->getAdres()->getWoonplaats()->getPostcode(); ?></td>
            <td><?php echo $klantGegevens->getAdres()->getWoonplaats()->getNaam(); ?></td>
        </tbody>
    </table>
</div>