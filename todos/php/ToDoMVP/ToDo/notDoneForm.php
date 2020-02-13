<form method="post" action="done">
  <input type="hidden" name="currentlist" value="<?=$json??'';?>" />
  <input type="hidden" name="item" value="<?=$id??'';?>"/>
  <input class="complete"
         type="submit"
         value="Mark done '<?=$item??'';?>'" />
</form>
<form method="post" action="delete">
  <input type="hidden" name="currentlist" value="<?=$json??'';?>" />
  <input type="hidden" name="item" value="<?=$id??'';?>"/>
  <input class="delete"
         type="submit"
         value="Delete '<?=$item??'';?>'" />
</form>
