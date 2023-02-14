<div class="explore-section">
    <form action="#" method="post" class="d-flex gap-3 align-items-center">
        <?php foreach ($templateParams["categorie"] as $categoria) : ?>
            <button type="submit" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria" value="<?php echo $categoria["idcategoria"]; ?>" class="category btn btn-outline-primary" /><?php echo $categoria["nome"]; ?></button>
        <?php endforeach; ?>
        <button type="submit" id="0" name="categoria" value="0" class="category btn btn-outline-primary" />Tutti</button>
    </form>
    <?php
    if (isset($templateParams["js"])) {
        echo '<div id="post-section"></div>';
    }
    ?>
</div>