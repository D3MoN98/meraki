<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="<?= base_url('assets/css/msg.css')?>">
<div class="frame">
  <div class="modal">
	<i class="fas fa-check"></i>
	<p class="title">Great!</p>
	<p><?= isset($msg) ? $msg : ''?></p>
	<a href="<?= isset($url) ? base_url($url) : base_url() ?>">Go Back</a>
  </div>
</div>