<table>
	<thead> 
		<tr>
			<th>#</th>
			<th>Img</th>
			<th>Porduct Name</th>
			<th>Size</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Delevery Date</th>
			<th>Delevered Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="tbody">
	<?php foreach ($order_details as $key) { ?>
		<tr>
			<td width="50px"><?= $key->order_details_id?></td>
			<td width="75px"><img src="<?= base_url('upload/'). $this->action->get('product',['product_id' => $key->product_id])->row()->img?>" alt=""></td>
			<td width="150px"><?= $this->action->get('product',['product_id' => $key->product_id])->row()->name?></td>
			<td width="75px"><?= $key->size?></td>
			<td width="75px"><?= $key->qty?></td>
			<td width="75px"><?= $key->price?></td>
			<td width="250px"><?= $key->delivery_date?></td>
			<td width="250px"><?= $key->delivered_date?></td>
			<td width="150px">
				<a href="<?= base_url('seller/edit_items/').$key->order_details_id?>" class="fas fas fa-pencil-alt user"></a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>