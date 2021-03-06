<tr>
	<td colspan="8" id="num_rows">Total <?= count($seller)?> results found</td>
</tr>
<?php foreach ($seller as $key) {?>
<tr <?= ($key->status !=1) ? 'style="background-color: #F5F5F5"' : '' ?>>
	<td><?= $key->seller_id ?></td>
	<td><?= $key->name ?></td>
	<td><?= $key->email ?></td>
	<td><?= $key->contact_no ?></td>
	<td><?= $key->dob ?></td>
	<td><?= $key->date_created ?></td>
	<td><?= ($key->status !=1) ? 'off' : 'on' ?></td>
	<td>
		<button class="fas fas fa-pencil-alt seller" value="<?= $key->seller_id ?>"></button>
		<button class="fas fa-trash-alt seller" value="<?= $key->seller_id ?>"></button>
		<button class="fas fa-power-off seller" <?= ($key->status !=1) ? 'style="color: red"' : '' ?> value="<?= $key->seller_id ?>"></button>
	</td>
</tr>
<?php } ?>
