<div class="container d-flex gap-2">
    <form action="#" method="post" class="d-flex gap-2">
        <?php foreach ($templateParams["categorie"] as $categoria) : ?>
            <input type="radio" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria" value="<?php echo $categoria["idcategoria"]; ?>" />
            <label for="<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nome"]; ?></label>
        <?php endforeach; ?>
        <input type="radio" id="0" name="categoria" value="0" />
        <label for="0">tutte</label>
        <button type="submit" class="btn btn-primary">Filtra</button>
</div>
<?php
if (isset($templateParams["js"])) {
    echo '<div id="post-section"></div>';
}
?>