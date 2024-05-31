<h2>Winkelwagen</h2>
<div class="container">
<?php if(!empty($_SESSION['winkelwagen'])): ?>
    <ul class="list-group list-group-flush list-group-numbered">
        <?php $totaalSom = 0; ?>
        <?php foreach ($_SESSION['winkelwagen'] as $index => $artikel): ?>
            <li class="list-group-item">
                <?php echo $artikel['hoeveelheid'] . 'x ' . $artikel['pizza']; ?>
                <?php $ingredienten = []; ?>
                <?php if (!empty($artikel['extras'])): ?>
                    (<?php foreach($artikel['extras'] as $extra): ?>
                        <?php echo $extra . " "; ?>
                        <?php array_push($ingredienten, $extra); ?>
                    <?php endforeach; ?>)
                <?php endif; ?>
                <?php $pizzaPrijs = $winkelwagenService->berekenPrijsPizza(
                        (int) $artikel['hoeveelheid'], 
                         $artikel['pizza'], 
                         $ingredienten, 
                         $ingelogd
                        )?>
                <?php echo "€ " . $pizzaPrijs;?>
                <?php $totaalSom += $pizzaPrijs;?>
                <a href="?verwijder=<?php echo $index; ?>" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Verwijder</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <label for="totaalSom">Totaal = € </label>
    <?php echo $totaalSom; ?>
    <a href="?leegmaken" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Winkelwagen leegmaken</a>
<?php else: ?>
    <p>Uw winkelwagen is leeg.</p>
<?php endif; ?>
</div>