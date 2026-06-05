<!DOCTYPE html>
<html lang="<?=app()->getLocale()?>" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$this->getSite()->getTitle()?></title>

  <?=$this->printCss()?>
</head>

<body class="min-h-screen bg-slate-950 text-white">
  <main class="min-h-screen flex items-center justify-center px-6">
    <?= $this->renderBody() ?>
  </main>
  <?=$this->printJs()?>
</body>

</html>