<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="<?= base_url('assets/css/error.css')?>">
<div class="frame">
  <div class="modal">
    <i class="fas fa-exclamation-triangle"></i>
	<p class="title">Oh snap!</p>
	<span class="error"><?= isset($error) ? $error : ''?></span>
	<a href="<?= isset($url) ? base_url($url) : base_url() ?>">Dismiss</a>
  </div>
</div>