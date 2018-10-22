<table>
	<thead> 
		<tr>
			<th>#</th>
			<th>Img</th>
			<th>Name</th>
			<th>Price</th>
			<th>Mrp</th>
			<th>Category</th>
			<th>Sub_Category</th>
			<th>Size</th>
			<th>qty</th>
			<th>Date Created</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="tbody">
	<?php foreach ($products as $key) { ?>
		<tr>
			<td width="50px"><?= $key->product_id?></td>
			<td width="75px"><img src="<?= base_url('upload/').$key->img?>" alt=""></td>
			<td width="200px"><?= $key->name?></td>
			<td width="200px"><?= $key->price?></td>
			<td width="200px"><?= $key->mrp?></td>
			<td width="100px"><?= $this->action->join('catagory.name as catagory_name','product','catagory','catagory.catagory_id = product.catagory',['product_id' => $key->product_id])->row()->catagory_name;?></td>
			<td width="150px"><?= $this->action->join('sub_catagory.name as sub_catagory_name','product','sub_catagory','sub_catagory.sub_catagory_id = product.sub_catagory',['product_id' => $key->product_id])->row()->sub_catagory_name;?></td>
			<td width="20px"><?= $key->size?></td>
			<td width="50px"><?= $key->qty?></td>
			<td width="250px"><?= $key->date_created?></td>
			<td width="100px">
				<a href="<?= base_url('seller/edit_items/').$key->product_id?>" class="fas fas fa-pencil-alt user"></a>
				<button class="fas fa-trash-alt user" value="<?= $key->product_id ?>"></button>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>