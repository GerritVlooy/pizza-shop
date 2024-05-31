<div class="container">
<h1><?= $title ?></h1>
<br/>
<div>
    <div>
        <h2>Pizza menu</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Beschrijving</th>
                    <th>Prijs</th>
                    <th>Promo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pizzaLijst as $pizza):?>
                    <tr>
                        <td><?php echo $pizza->getNaam(); ?></td>
                        <td><?php echo $pizza->getBeschrijving(); ?></td>
                        <td><?php echo $pizza->getPrijs(); ?></td>
                        <td>
                            <?php if($pizzaService->getPromoPrijsForPizza($pizza, $klantHomeId) !== null): ?>
                                <?php echo $pizzaService->getPromoPrijsForPizza($pizza, $klantHomeId) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>    
    </div>
    <br/>
    <div>
        <h2>Pizza Keuze</h2>
        <form action="homeController.php" method="POST">
            <div class="input-group">
                <div class="row">
                    <label for="pizza" class="form-label col-6">Maak uw keuze:</label>
                    <select name="pizza" id="pizza" class="dropdown-toggle col">
                        <?php foreach($pizzaLijst as $pizza):?>
                            <option value="<?php echo $pizza->getNaam() ?>" class="dropdown-item"><?php echo $pizza->getNaam() ?></option>
                        <?php endforeach;?>
                    </select>
                 </div>
            </div>
            <br/>
            <br/>
            <div class="input-group row justify-content-start">
                <div class="col-4 row">
                    <div class="col">
                    <label for="hoeveelheid" class="form-label">Hoeveelheid:</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" name="hoeveelheid" id="hoeveelheid" value="1" min="1" required>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <h3>Extra's</h3>
            <ul class="list-group group-item-action">
            <?php foreach($ingredientLijst as $ingredient):?>
                <li class="list-group-item list-group-item-action">
                    <input class="form-check-input" type ="checkbox" id="<?php echo $ingredient->getNaam();?>" name="extras[]"
                    value="<?php echo $ingredient->getNaam(); ?>"/>
                    <label for="<?php echo $ingredient->getNaam();?>" class="form-label"><?php echo $ingredient->getNaam() . " - € " . $ingredient->getPrijs();?></label>
                </li>
                
            <?php endforeach;?>
            </ul>
            <br/>
            <input class="btn btn-primary" type="submit" name="toevoegenAanWinkelwagen" value="toevoegen"/>
        </form>
        <hr/>   
    </div>
    <?php require_once $winkelwagen; ?>
    <?php if(!empty($_SESSION['winkelwagen'])): ?>
        <br/>
        <div class="container">
            <a href="afrekenenController.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Afrekenen</a>
        </div>
    <?php endif; ?>
    </div>
        <br/>
</div>
