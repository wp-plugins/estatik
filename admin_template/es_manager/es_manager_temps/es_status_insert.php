<?php if(isset($id)){ ?>
    <li id="status_<?php echo $id?>">
        <label><?php echo $es_status_title?></label>
        <small onclick="es_status_delete(this)"></small>
        <span class="es_field_loader es_status_loader"></span>
        <input type="hidden" value="<?php echo $id?>" name="es_status_id" class="es_status_id" />
    </li>
<?php } ?> 