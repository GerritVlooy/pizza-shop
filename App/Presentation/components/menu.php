<nav>
    <ul>
        <li><a href="homeController.php">Home</a></li>
        <?php if(!isset($_SESSION["login"])): ?>
        <li><a href="accountController.php">Aanmelden</a></li>
        <li><a href="registrerenController.php">Registreren</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION["login"])):?>
        <li><a href="accountController.php">Account</a></li>
        <?php endif; ?>
        
    </ul>
</nav>