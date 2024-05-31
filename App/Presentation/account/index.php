<div class="container">
<h1><?= $title ?></h1>
<br/>
<?php if(!isset($_SESSION["login"])): ?>
    <div>
    <form action="" method="post">
        <div class="form-outline mb-4">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" class="form-control" required>
        </div>

        <div class="form-outline mb-4">
            <label for="wachtwoord" class="form-label">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" class="form-control" required>
        </div>

            <button type="submit" class="btn btn-primary brn-block mb-4">Aanmelden</button>
    </form>
    </div>
<?php endif;?>
<?php if(isset($_SESSION["login"])): ?>
    <div><a href="updateAdresController.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Gegevens Bijwerken</a></div>
    <div><a href="?uitloggen" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Uitloggen</a></div>
<?php endif; ?>
</div>
