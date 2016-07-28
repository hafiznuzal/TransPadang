@extends('template-manajemen')
@section('judul')
Halte
<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Tambah Baru
</small>
@endsection
@section('content-tabel')
	<form class="form-horizontal" role="form" method="post" action="tambah_halte">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
			<div class="col-sm-9">
				<input type="text" name="Nama" placeholder="Nama" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Longitude </label>
			<div class="col-sm-9">
				<input type="text" name="Longitude" placeholder="Longitude" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Latitude </label>
			<div class="col-sm-9">
				<input type="text" name="Latitude" placeholder="Latitude" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Keterangan </label>
			<div class="col-sm-9">
				<input type="text" name="Keterangan" placeholder="Nama Point" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Warna </label>
			<div class="col-sm-9">
				<input type="text" name="Warna" placeholder="Warna Halte" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor Id</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control "  name="Koridor" data-placeholder="Koridor Id">
				<?php foreach ($koridor as $key => $value){ ?>
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } ?>
				</select>
				</div>
				</div>
		</div> -->
	<!-- 	<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control " name="Halte" data-placeholder="Id Halte Seberang">
				
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					
				</select>
				</div>
				</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Relasi</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control " name="Halte" data-placeholder="Id Halte Seberang">
				<?php foreach ($halte as $key => $value){ ?>
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } ?>
				</select>
				</div>
				</div>
		</div>
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Submit
				</button>

				&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					<a href="manajemen_point">Reset</a>					
				</button>
			</div>
		</div>
	</form>
@endsection