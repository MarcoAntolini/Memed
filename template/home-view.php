<?php
if (isset($templateParams["js"])) :
    echo '<section id="post-section"></section>';
    foreach ($templateParams["js"] as $script) :
?>
        <script src="<?php echo $script; ?>"></script>
<?php
    endforeach;
endif;
?>