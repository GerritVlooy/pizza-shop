<h1><?= $title ?></h1>
<hr/>
<div>
    <form action="" method="post">
        <div  <?php if(isset($updateGegevens)): ?> <?php echo "hidden" ?> <?php endif; ?>>
            <label for="email">E-mailadres:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>">
            <br/>
            <br/>
            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord">
            <br/>
            <br/>
            <label for="wachtwoordCheck">Wachtwoord herhalen:</label>
            <input type="password" id="wachtwoordCheck" name="wachtwoordCheck">
            <br/>
            <br/>
            <label for="voornaam">Voornaam:</label>
            <input type="text" id="voornaam" name="voornaam" value="<?php echo $voornaam ?>" required>
            <br/>
            <br/>
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam" value="<?php echo $naam ?>" required>
            <br/>
            <br/>
            <label for="telefoonGSM">Telefoon of GSM:</label>
            <input type="tel" id="telefoonGSM" name="telefoonGSM" value="<?php echo $telefoonGSM ?>" required>
            </div>
        <div>
            <label for="straat">Straat:</label>
            <input type="text" id="straat" name="straat" value="<?php echo $straat ?>" required>
            <br/>
            <br/>
            <label for="huisnummer">Huisnummer:</label>
            <input type="text" id="huisnummer" name="huisnummer" value="<?php echo $huisnummer ?>" required>
            <br/>
            <br/>
            <label for="postcode">Postcode:</label>
            <input type="number" id="postcode" name="postcode" value="<?php echo $postcode ?>" required>
            <br/>
            <br/>
            <label for="woonplaats">Woonplaats:</label>
            <input type="text" id="woonplaats" name="woonplaats" value="<?php echo $woonplaats ?>" required>
            <br/>
            <br/>
        </div>
        <div <?php if(!isset($checkbox)): ?>
                <?php echo "hidden" ?>
            <?php endif; ?>>
            <label for="accountcheck">Account maken</label>
            <input type ="checkbox" id="accountCheck" name="accountCheck" 
                <?php if(!isset($checkbox)): ?>
                    <?php echo "checked"?>
                <?php endif; ?> />
        </div>
        
        
        <button type="submit">verzenden</button>
    </form>
    <br/>
    <?php if(isset($updateGegevens)): ?>
        <div>
            <a href="homecontroller.php">Bestelling bijwerken</a>
            <a href="afrekenenController.php">Terug naar afrekenen</a>
        </div>
    <?php endif; ?>
</div>