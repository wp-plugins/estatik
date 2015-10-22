<?php if(isset($id)){ ?>

    <li id="cat_<?php echo $id?>">
        <label><?php echo $es_cat_title?></label>
        <small onclick="es_category_delete(this)"></small>
        <span class="es_field_loader es_category_loader"></span>
        <input type="hidden" value="<?php echo $id?>" name="es_cat_id" class="es_cat_id" />
    </li>

<?php } ?> 