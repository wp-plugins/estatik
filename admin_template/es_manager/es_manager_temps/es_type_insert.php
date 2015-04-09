<?php if(isset($id)){ ?>
    <li id="type_<?php echo $id?>">
        <label><?php echo $es_type_title?></label>
        <small onclick="es_type_delete(this)"></small>
        <span class="es_field_loader es_type_loader"></span>
        <input type="hidden" value="<?php echo $id?>" name="es_type_id" class="es_type_id" />
    </li>
<?php } ?> 
 