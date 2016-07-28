
@extends('template-manajemen')
@section('content-tabel')
	<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">Basis Data Point</h3>

		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Point
			<a class="white pull-right" style="padding-right:5px" href="#" onclick="add_point();"> Tambah Point
				<i class="fa fa-plus-circle fa-2x"></i>
			</a>
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div>
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<div class="id_100">
				  <select id="selectBox" onchange="changekor_point();">
				     <option <?php if($id==1)echo "selected"; ?> value="1">Koridor id 1</option>
				    <option <?php if($id==2)echo "selected"; ?> value="2">Koridor id 2</option>
				    <option <?php if($id==3)echo "selected"; ?> value="3">Koridor id 3</option>
				    <option <?php if($id==5)echo "selected"; ?> value="5">Koridor id 5</option>
				    <option <?php if($id==6)echo "selected"; ?> value="6">Koridor id 6</option>   
				    <option <?php if($id==7)echo "selected"; ?> value="7">Koridor id 7</option>
				    <option <?php if($id==8)echo "selected"; ?> value="8">Koridor id 8</option>
				    <option <?php if($id==9)echo "selected"; ?> value="9">Koridor id 9</option>
				    <option <?php if($id==10)echo "selected"; ?> value="10">Koridor id 10</option>
				  </select>

				</div>



				<thead>
					<tr>
						
						<th>Id</th>
						<th>Nomor</th>
						
						<th>Longitude</th>

						<th>
							Latitude
						</th>
						<th class="hidden-480">Keterangan</th>
						

						<th>Aksi</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach ($halte as $key => $value) {?>
					<tr>  	
						
						<td>
							<?php echo $value->id?>
						</td>

						<td>
							<?php echo $value->nomor?>
						</td>
						
						<td><?php echo $value->longitude?></td>
						<td><?php echo $value->latitude?></td>

						<td class="hidden-480">
							<?php echo $value->keterangan?>
						</td>
						
						<td>
							<div class="hidden-sm hidden-xs action-buttons">
									

								<a class="green" href="#" onclick="edit_point(<?php echo $value->id?>);">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
								</a>

								<a class="red" href="#" onclick="delete_point(<?php echo $value->id?>);">
									<i class="ace-icon fa fa-trash-o bigger-130"></i>
								</a>
							</div>

							<div class="hidden-md hidden-lg">
								<div class="inline pos-rel">
									<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
										<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
									</button>

									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
											<input type="hidden" class="id-tersembunyi" value="<?php echo $value->id?>">
										<li>
											<a href="#"  class="tooltip-info" data-rel="tooltip" title="View">
												<span class="blue">
													<i class="ace-icon fa fa-search-plus bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>


					<?php } ?>
					
		
				</tbody>
			</table>
		</div>
	</div>
	</div>

@endsection
