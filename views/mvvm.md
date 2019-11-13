---
description: Views in this pattern are basically the front-end of your ViewModels logic
---

# MVVM

Views contain the HTML served by your application and separate your ViewModel code-behind logic from your presentation logic. Views are saved in the `resources/views/templates` directory. A simple view would look like this:

```php
<div class="containers">
    <?=$htmlForm?>
</div>
```

Every View in a view-model extends a given layout by default and the layout markup looks like so:

```php
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
```

The `$this->renderBody()` section is where a basic view of a `view-model` is rendered, the layout can be structured in anyway as your application requires, since it's just markup.

#### How to include a given ViewModel in view \(with its data\)

When it comes to managing view-model segments in your application, yuga is very smart, it will not include the layout on a given view-model if it's included in a view like so:

```php
<div>
    <?=$this->viewModel(new App\ViewModels\Test)?>
</div>
```

When the Test view-model is viewed on its own, it will include the default layout, but when included in a view as a view-model, the layout is left out.

#### Including a given snippet \(not a view-model\)

All that is needed in this case is as below:

```php
<div>
    <?=$this->display('snippets.user', ['name' => 'Hamnaj'])?>
</div>
```

The display method in a view will include a given snippet where ever it's saved and pass the data to that snippet since it's not a view-model on its own.

