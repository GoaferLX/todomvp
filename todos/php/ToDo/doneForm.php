<form method="post" action="notdone">
  <input type="hidden" name="currentlist" value="<?=$json??'';?>" />
  <input type="hidden" name="item" value="<?=$id??''; ?>" />
  <input class="uncomplete"
         type="submit"
         value="Mark not done '<?=$item??'';?>'" />
</form>
<form method="post" action="delete">
  <input type="hidden" name="currentlist" value="<?=$json??'';?>" />
  <input type="hidden" name="item" value="<?=$id??''; ?>" />
  <input class="delete"
         type="submit"
         value="Delete '<?=$item??'';?>'" />
</form>
