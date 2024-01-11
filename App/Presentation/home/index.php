<h1><?= $title ?></h1>
<hr/>
<div>
    <div>
        <h2>Pizza menu</h2>
        <table>
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Beschrijving</th>
                    <th>Prijs</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pizzaLijst as $pizza):?>
                    <tr>
                        <td><?php echo $pizza->getNaam(); ?></td>
                        <td><?php echo $pizza->getBeschrijving(); ?></td>
                        <td><?php echo $pizza->getPrijs(); ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>    
    </div>
    <br/>
    <div>
        <h2>Pizza Keuze</h2>
        <form action="homeController.php" method="POST">
            <label for="pizza">Maak uw keuze:</label>
            <select name="pizza" id="pizza">
                <?php foreach($pizzaLijst as $pizza):?>
                    <option value="<?php echo $pizza->getNaam() ?>"><?php echo $pizza->getNaam() ?></option>
                <?php endforeach;?>
            </select>
            <label for="hoeveelheid">Hoeveelheid:</label>
            <input type="number" name="hoeveelheid" id="hoeveelheid" value="1" min="1" required>
            <h3>Extra's</h3>
            <?php foreach($ingredientLijst as $ingredient):?>
                <input type ="checkbox" id="<?php echo $ingredient->getNaam();?>" name="extras[]"
                    value="<?php echo $ingredient->getNaam(); ?>"/>
                <label for="<?php echo $ingredient->getNaam();?>"><?php echo $ingredient->getNaam() . " - € " . $ingredient->getPrijs();?></label>
                <br/>
            <?php endforeach;?>
            <br/>
            <input type="submit" name="toevoegenAanWinkelwagen" value="toevoegen"/>
        </form>
        <hr/>   
    </div>
    <?php require_once $winkelwagen; ?>
    <?php if(!empty($_SESSION['winkelwagen'])): ?>
        <div>
            <a href="afrekenenController.php">Afrekenen</a>
        </dv>
    <?php endif; ?>
</div>