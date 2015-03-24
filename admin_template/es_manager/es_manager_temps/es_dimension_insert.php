<li id="dimension_<?php echo $id?>">
    <label>
		<input type="radio" name="dimension_status" onclick="es_dimension_status(this)" />
		<?php echo $es_dimension_title?>
    </label>
    <small onclick="es_dimension_delete(this)"></small>
    <span class="es_field_loader es_dimension_loader"></span>
    <input type="hidden" value="<?php echo $id?>" name="es_dimension_id" class="es_dimension_id" />
</li>

 