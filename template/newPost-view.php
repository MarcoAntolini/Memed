<form action="processa-post.php" method="POST" enctype="multipart/form-data">
            <h2>Gestisci Articolo</h2>
            <ul>
                <li>
                    <label for="testopost">Testo post:</label><textarea id="testopost" name="testopost"></textarea>
                </li>
                <li>
                    <label for="imgpost">Immagine post</label><input type="file" name="imgpost" id="imgpost" />
                </li>
                <li>
                    <?php foreach($templateParams["categorie"] as $categoria): ?>
                    <input type="checkbox" id="<?php echo $categoria["idcategoria"]; ?>" name="categoria_<?php echo $categoria["idcategoria"]; ?>"  />
                    <label for="<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nome"]; ?></label>
                    <?php endforeach; ?>
                </li>
                <li>
                    <input type="submit" name="submit" value="pubblica post" />
                    <a href="login.php">Annulla</a>
                </li>
            </ul>
</form>