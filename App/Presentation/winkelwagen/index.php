<h2>Winkelwagen</h2>
<div>
<?php if(!empty($_SESSION['winkelwagen'])): ?>
    <ul>
        <?php $totaalSom = 0; ?>
        <?php foreach ($_SESSION['winkelwagen'] as $index => $artikel): ?>
            <li>
                <?php echo $artikel['hoeveelheid'] . 'x ' . $artikel['pizza']; ?>
                <?php $array = []; ?>
                <?php if (!empty($artikel['extras'])): ?>
                    (<?php foreach($artikel['extras'] as $extra): ?>
                        <?php echo $extra . " "; ?>
                        <?php array_push($array, $extra); ?>
                    <?php endforeach; ?>)
                <?php endif; ?>
                <?php $pizzaPrijs = $winkelwagenService->berekenPrijsPizza((int) $artikel['hoeveelheid'], 
                   $artikel['pizza'], $array)?>
                <?php echo "€ " . $pizzaPrijs;?>
                <?php $totaalSom += $pizzaPrijs;?>
                <a href="?verwijder=<?php echo $index; ?>">Verwijder</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <label for="totaalSom">Totaal = € </label>
    <?php echo $totaalSom; ?>
    <a href="?leegmaken">Winkelwagen leegmaken</a>
<?php else: ?>
    <p>Uw winkelwagen is leeg.</p>
<?php endif; ?>
</div>