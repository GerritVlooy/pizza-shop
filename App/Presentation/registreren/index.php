<div class="container">
<h1><?= $title ?></h1>
<br/>
<div>
    <form action="" method="post">
        <div <?php if(isset($updateGegevens)): ?> <?php echo "hidden" ?> <?php endif; ?>>
            <div class="form-outline mb-4">
                <label for="email" class="form-label">E-mailadres:</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>" class="form-control">
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="wachtwoord" class="form-label">Wachtwoord:</label>
                <input type="password" id="wachtwoord" name="wachtwoord" class="form-control">
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="wachtwoordCheck" class="form-label">Wachtwoord herhalen:</label>
                <input type="password" id="wachtwoordCheck" name="wachtwoordCheck" class="form-control">
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="voornaam" class="form-label">Voornaam:</label>
                <input type="text" id="voornaam" name="voornaam" value="<?php echo $voornaam ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="naam" class="form-label">Naam:</label>
                <input type="text" id="naam" name="naam" value="<?php echo $naam ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="telefoonGSM" class="form-label">Telefoon of GSM:</label>
                <input type="tel" id="telefoonGSM" name="telefoonGSM" value="<?php echo $telefoonGSM ?>" class="form-control" required>
            </div>
        </div>
        <div>
            <div class="form-outline mb-4">
                <label for="straat" class="form-label">Straat:</label>
                <input type="text" id="straat" name="straat" value="<?php echo $straat ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="huisnummer" class="form-label">Huisnummer:</label>
                <input type="text" id="huisnummer" name="huisnummer" value="<?php echo $huisnummer ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="number" id="postcode" name="postcode" value="<?php echo $postcode ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
            <div class="form-outline mb-4">
                <label for="woonplaats" class="form-label">Woonplaats:</label>
                <input type="text" id="woonplaats" name="woonplaats" value="<?php echo $woonplaats ?>" class="form-control" required>
            </div>
            <br/>
            <br/>
        </div>
        <div <?php if(!isset($checkbox)): ?>
                <?php echo "hidden" ?>
            <?php endif; ?>>
            <div class="form-outline mb-4">
                <label for="accountcheck" class="form-label">Account maken</label>
                <input type ="checkbox" id="accountCheck" name="accountCheck" class="form-control"> 
            </div>
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
</div>