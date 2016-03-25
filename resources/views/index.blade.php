@extends('maintemplate')

@section('breadcrumb')
	<li>Dashboard</li>
@endsection

@section('page-header')
	Dashboard
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="map-responsive">
    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6709.195556985042!2d100.35660316641659!3d-0.9132147346254299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b942e2b117bb%3A0xb8468cb5c3046ba5!2sPadang%2C+Kota+Padang%2C+Sumatera+Barat!5e0!3m2!1sid!2sid!4v1458891427914" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		
			</div>
		</div>
		<div class="col-sm-4">
			<form class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Keberangkatan </label>

				<div class="col-sm-8">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" />
						<i class="ace-icon fa fa-bus blue"></i>
					</span>
				</div>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Kedatangan </label>

				<div class="col-sm-8">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" />
						<i class="ace-icon fa fa-bus blue"></i>
					</span>
				</div>		
				<!-- <div class="col-sm-9">
					<input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" />
				</div> -->
			</div>
			</form>
		</div>
	</div>
@endsection
