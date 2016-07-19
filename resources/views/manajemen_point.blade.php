
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
				     <option <?php if($id==1)echo "selected"; ?> value="1">Koridor 1</option>
				    <option <?php if($id==2)echo "selected"; ?> value="2">Koridor 2</option>
				    <option <?php if($id==3)echo "selected"; ?> value="3">Koridor 3</option>
				    <option <?php if($id==5)echo "selected"; ?> value="5">Koridor 5</option>
				    <option <?php if($id==6)echo "selected"; ?> value="6">Koridor 6</option>
				  </select>

				</div>



				<thead>
					<tr>
						
						<th>Id</th>
						<th>Nomor</th>
						
						<th class="hidden-480">Longitude</th>

						<th>
							<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
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
						
						<td class="hidden-480"><?php echo $value->longitude?></td>
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
