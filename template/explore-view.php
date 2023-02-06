<script type="text/javascript" src="../public/assets/js/search.js"></script>

<div class="container d-flex gap-2">
    <!-- TODO: categorie per filtrare -->
    <!-- <input type="checkbox" name="" id="">
        <label for=""></label> -->
</div>
<?php
if (isset($emplateParams["js"])) :
    echo '<div id="post-section"></div>';
    foreach ($templateParams["js"] as $script) :
?>
        <script src="<?php echo $script; ?>"></script>
<?php
    endforeach;
endif;
?>