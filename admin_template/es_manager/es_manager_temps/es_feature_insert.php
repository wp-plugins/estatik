<li id="feature_<?php echo $feature_id?>">
    <label>
    <?php if($prop_feature==1) { ?>
    <input type="checkbox" name="es_prop_feature[]" value="<?php echo $feature_id?>" />
    <?php } ?>
    <?php echo $es_feature_title?></label>
    <small onclick="es_feature_delete(this)"></small>
    <span class="es_field_loader es_feature_loader"></span>
    <input type="hidden" value="<?php echo $feature_id?>" name="es_feature_id[]" class="es_feature_id" />
</li>
 