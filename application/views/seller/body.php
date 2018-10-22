	<div id="main_body">
		<div id="breadcrumb">
			<p>Dashboard / Overview</p>
		</div>
		<div id="overview">
			<div>
				<i class="fas fa-comments"></i>
				<p>26 New Messages!</p>
				<a href="">View Details <b>&gt</b></a>
			</div>
			<div>
				<i class="fas fa-tasks"></i>
				<p>11 New Tasks!</p>
				<a href="">View Details <b>&gt</b></a>
			</div>
			<div>
				<i class="fas fa-users"></i>
				<p>123 New Users!</p>
				<a href=""><span>View Details</span> <b>&gt</b></a>
			</div>
			<div>
				<i class="fas fa-truck"></i>
				<p>15 New Sellers!</p>
				<a href="">View Details <b>&gt</b></a>
			</div>
		</div>
		<div id="data_table_container">
			
		</div>
		<section id="container">
			<section id="data_table_container">
				<div><i class="fas fa-table"></i> Data Table</div>
				<section id="data_table_length">
					<span>
						<select name="sort_by" id="sort_by">
							<option value="" selected="selected">All</option>
							<option value="1">Active</option>
							<option value="0">Not active</option>
						</select>
					</span>
					<section id="table_switch">
						Products<input type="checkbox" id="switch" name="table" /><label for="switch">Toggle</label> &nbsp;Orders
					</section>
					<input id="search_table" class="product" type="text" placeholder="Search">
				</section>
				<section id="data_table">
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
				</section>
			</section>
		</section>
		<section id="modal_body"></section>
	</div>
	<a href="<?= base_url('seller/add_items')?>" class="add_items show">
		<i class="fa fa-plus add_items_float"></i>
	</a>