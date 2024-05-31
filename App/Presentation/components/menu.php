<nav class="navbar navbar-expand-lg  bg-body-tertiary">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] === '/oefeningen/pizza/homeController.php'):?> active <?php endif; ?>" href="homeController.php">Home</a></li>
            <?php if(!isset($_SESSION["login"])): ?>
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] === '/oefeningen/pizza/accountController.php'):?> active <?php endif; ?>" href="accountController.php">Aanmelden</a></li>
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] === '/oefeningen/pizza/registrerenController.php'):?> active <?php endif; ?>" href="registrerenController.php">Registreren</a></li>
            <?php endif; ?>
            <?php if(isset($_SESSION["login"])):?>
                <li class="nav-item"><a class="nav-link <?php if($_SERVER['REQUEST_URI'] === '/oefeningen/pizza/accountController.php'):?> active <?php endif; ?>" href="accountController.php">Account</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
</nav>
