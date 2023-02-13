<div class="explore-section">
    <form action="#" method="post" class="d-flex gap-3 align-items-center">
        <?php foreach ($templateParams["categorie"] as $categoria) : ?>
            <div class="category">
                <input type="radio" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria" value="<?php echo $categoria["idcategoria"]; ?>" />
                <label for="<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nome"]; ?></label>
            </div>
        <?php endforeach; ?>
        <div class="category">
            <input type="radio" id="0" name="categoria" value="0" />
            <label for="0">Tutte</label>
        </div>
        <button type="submit" class="btn btn-primary">Filtra</button>
    </form>
    <?php
    if (isset($templateParams["js"])) {
        echo '<div id="post-section"></div>';
    }
    ?>
</div>