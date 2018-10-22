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
						Users <input type="checkbox" id="switch" name="table" /><label for="switch">Toggle</label> &nbsp;Sellers
					</section>
					<input id="search_table" class="user" type="text" placeholder="Search">
				</section>
				<section id="data_table">
					<table>
						<thead> 
							<tr>
								<th width="5%" class=""><i class="fas"></i> #</th>
								<th width="15%" class="" name="name"><i class="fas"></i> Name</th>
								<th width="20%" class="" name="email"><i class="fas"></i> Email</th>
								<th width="12.5%" class="" name="contact_no"> <i class="fas"></i>Contact No</th>
								<th width="10%" class="" name="dob"> <i class="fas"></i>DOB</th>
								<th width="15%" class="" name="dob"> <i class="fas"></i>Date Created</th>
								<th width="10%" class="" name="status"><i class="fas"></i>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tbody">
						<tr>
							<td colspan="8" id="num_rows">Total <?= count($user)?> results found</td>
						</tr>
						<?php foreach ($user as $key) {
							?>
							<tr <?= ($key->status !=1) ? 'style="background-color: #F5F5F5"' : '' ?>>
								<td><?= $key->user_id ?></td>
								<td><?= $key->name ?></td>
								<td><?= $key->email ?></td>
								<td><?= $key->contact_no ?></td>
								<td><?= $key->dob ?></td>
								<td><?= $key->date_created ?></td>
								<td><?= ($key->status !=1) ? 'off' : 'on' ?></td>
								<td>
									<button class="fas fas fa-pencil-alt user" value="<?= $key->user_id ?>"></button>
									<button class="fas fa-trash-alt user" value="<?= $key->user_id ?>"></button>
									<button class="fas fa-power-off user" <?= ($key->status !=1) ? 'style="color: red"' : '' ?> value="<?= $key->user_id ?>"></button>
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
	