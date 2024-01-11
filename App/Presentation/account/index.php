<h1><?= $title ?></h1>
<hr/>
<?php if(!isset($_SESSION["login"])): ?>
    <div>
    <form action="" method="post">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>

            <button type="submit">Aanmelden</button>
    </form>
    </div>
<?php endif;?>
<?php if(isset($_SESSION["login"])): ?>
    <div><a href="?uitloggen">Uitloggen</a></div>
<?php endif; ?>