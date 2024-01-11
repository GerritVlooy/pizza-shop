<h1><?= $title ?></h1>
<hr/>
<div>
    <form action="" method="post">
        <label for="voornaam">Voornaam:</label>
        <input type="text" id="voornaam" name="voornaam" value="<?php echo $voornaam ?>" required>

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" value="<?php echo $naam ?>" required>

        <label for="straat">Straat:</label>
        <input type="text" id="straat" name="straat" value="<?php echo $straat ?>" required>

        <label for="huisnummer">Huisnummer:</label>
        <input type="text" id="huisnummer" name="huisnummer" value="<?php echo $huisnummer ?>" required>

        <label for="postcode">Postcode:</label>
        <input type="number" id="postcode" name="postcode" value="<?php echo $postcode ?>" required>

        <label for="woonplaats">Woonplaats:</label>
        <input type="text" id="woonplaats" name="woonplaats" value="<?php echo $woonplaats ?>" required>

        <label for="telefoonGSM">Telefoon of GSM:</label>
        <input type="tel" id="telefoonGSM" name="telefoonGSM" value="<?php echo $telefoonGSM ?>" required>

        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" value="<?php echo $email ?>" required>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>

        <label for="wachtwoordCheck">Wachtwoord herhalen:</label>
        <input type="password" id="wachtwoordCheck" name="wachtwoordCheck" required>

        <button type="submit">Registreren</button>
    </form>
</div>