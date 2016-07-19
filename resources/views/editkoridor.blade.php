@extends('template-manajemen')
@section('judul')
Koridor
<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Edit
</small>
@endsection
@section('content-tabel')
	<form class="form-horizontal" role="form" method="post" action="<?php echo $koridor_terpilih->id?>">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nomor </label>
			<div class="col-sm-9">
				<input type="text" name="Nomor" placeholder="Nomor Urutan Point"  class="col-xs-10 col-sm-5" value="<?php echo $koridor_terpilih->nomor?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
			<div class="col-sm-9">
				<input type="text" name="Nama" placeholder="Nama" class="col-xs-10 col-sm-5" value="<?php echo $koridor_terpilih->nama?>" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Keterangan </label>
			<div class="col-sm-9">
				<input type="text" name="Keterangan" placeholder="null" class="col-xs-10 col-sm-5" value="<?php echo $koridor_terpilih->keterangan?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Simbol </label>
			<div class="col-sm-9">
				<input type="text" name="Simbol" placeholder="null" class="col-xs-10 col-sm-5" value="<?php echo $koridor_terpilih->simbol?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Line </label>
			<div class="col-sm-9">
				<input type="text" name="Line" placeholder="null" class="col-xs-10 col-sm-5" value="<?php echo $koridor_terpilih->line?>" />
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