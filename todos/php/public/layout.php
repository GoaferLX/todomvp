<!DOCTYPE html>
<html>
  <head>
    <title><?=$title??'';?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="static/todo.css">
  </head>
  <body>
    <h1><?=$title??'';?></h1>
    <section id="errors">
        <?=$errors??'';?>
    </section>
    <?=$content??'';?>
  </body>
</html>
