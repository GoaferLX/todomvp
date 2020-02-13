<section class="new-todo">
  <form method="POST">
    <input type="hidden" name="currentlist" value="<?=$json??'';?>" />
    <input type="text"
           id="new-item"
           name="item"
           pattern=".{3,}"
           required
           aria-label="Write a new todo item"
           title="3 characters minimum" />
    <input type="submit"
           value="Add new item"
           id="add-new-item"/>
  </form>
</section>
