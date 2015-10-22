          
<li id="appliance_<?php echo $appliance_id?>">
    <label>
    <?php if($prop_appliance==1) { ?>
        <input type="checkbox" name="es_prop_appliance[]" value="<?php echo $appliance_id?>" />
    <?php } ?>
    <?php echo $es_appliance_title?></label>
    <small onclick="es_appliance_delete(this)"></small>
    <span class="es_field_loader es_appliance_loader"></span>
    <input type="hidden" value="<?php echo $appliance_id?>" name="es_appliance_id" class="es_appliance_id" />
</li>
 