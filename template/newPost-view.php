<div class="notice-section container-fluid d-flex justify-content-center">
    <form action="uploadPost.php" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-3">
            <input class="form-control" type="file" id="image-input" accept="image/png, image/jpg, image/jpeg, image/gif" name="image-input">
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="description-input" name="description-input"></textarea>
            <label for="description-input">Descrizione</label>
        </div>
        <?php foreach ($templateParams["categorie"] as $categoria) : ?>
            <input type="checkbox" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria_<?php echo $categoria["idcategoria"]; ?>" />
            <label for="<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nome"]; ?></label>
        <?php endforeach; ?>
        <button type="button" class="btn btn-info float-start" data-bs-toggle="modal" data-bs-target=".preview">Anteprima</button>
        <button type="submit" name="submit" class="btn btn-primary float-end">Pubblica</button>
    </form>
    <div class="preview modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div id="preview" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anteprima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-preview"></div>
                    <p id="description-preview"></p>
                </div>
            </div>
        </div>
    </div>
</div>