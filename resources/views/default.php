<!DOCTYPE html>
<html lang="<?=app()->getLocale()?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$this->getSite()->getTitle()?></title>
  <?=$this->printCss()?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="<?=host()?>"><?=config('app.name', 'Yuga')?></a>
    <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <?=$this->printMenu()?>
    </div>
  </nav>
  <div class="container">
    <?=$this->renderBody()?>
  </div>
  <?=$this->printJs()?>
</body>

</html>