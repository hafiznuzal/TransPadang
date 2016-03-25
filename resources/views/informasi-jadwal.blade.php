@extends('maintemplate')

@section('breadcrumb')
	<li>Informasi Koridor</li>
@endsection

@section('page-header')
	Informasi Jadwal Kedatangan dan Keberangkatan
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-8">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#koridor1">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Koridor 1
						</a>

						
					</li>

					<li>
						<a data-toggle="tab" href="#koridor2">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							koridor 2							
						</a>
					</li>

					<li class>
						<a data-toggle="tab" href="#koridor3">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Koridor 3
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#koridor4">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							koridor 4							
						</a>
					</li>

					<li class>
						<a data-toggle="tab" href="#koridor5">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Koridor 5
						</a>
					</li>

					<li>
						<a data-toggle="tab" href="#koridor6">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							koridor 6							
						</a>
					</li>

					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							Dropdown &nbsp;
							<i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
						</a>

						<ul class="dropdown-menu dropdown-info">
							<li>
								<a data-toggle="tab" href="#dropdown1">@fat</a>
							</li>

							<li>
								<a data-toggle="tab" href="#dropdown2">@mdo</a>
							</li>
						</ul>
					</li>
				</ul>

				<div class="tab-content">
					<div id="koridor1" class="tab-pane fade in active">
						<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>

						<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
														<th>Asal</th>
														<th>Tujuan</th>
														<th> 
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Kedatangan
														</th>														
														<th>Status</th>
														
													</tr>
												</thead>

												<tbody>
													

													<tr>
														

														<td>
															<a href="#">share.com</a>
														</td>
														<td>$30</td>
														<td>Feb 11</td>

														<td>
															asasasa
														</td>

													</tr>

													<tr>
														

														<td>
															<a href="#">share.com</a>
														</td>
														<td>$30</td>
														<td>Feb 11</td>

														<td>
															asasasa
														</td>
													</tr>

											
												</tbody>
											</table>
						</div>
					</div>

					<div id="koridor2" class="tab-pane fade">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
					</div>
					<div id="koridor3" class="tab-pane fade">
						<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
					</div>

					<div id="koridor4" class="tab-pane fade">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
					</div>
					<div id="koridor5" class="tab-pane fade">
						<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
					</div>

					<div id="koridor6" class="tab-pane fade">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
					</div>

					<div id="dropdown1" class="tab-pane fade">
						<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
					</div>

					<div id="dropdown2" class="tab-pane fade">
						<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin.</p>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection