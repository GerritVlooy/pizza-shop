<footer>
    <?php if($bericht !== []):?>
        <div>
            <ul>
                <?php foreach($bericht as $melding):?>
                    <li><?php echo $melding ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</footer>