@extends('template-manajemen')
@section('judul')
Halte
<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Edit
</small>
@endsection
@section('content-tabel')
	<form class="form-horizontal" role="form" method="post" action="<?php echo $halte_terpilih->id?>">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
			<div class="col-sm-9">
				<input type="text" name="Nama" placeholder="Nama" class="col-xs-10 col-sm-5" value="<?php echo $halte_terpilih->nama?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Longitude </label>
			<div class="col-sm-9">
				<input type="text" name="Longitude" placeholder="Longitude" class="col-xs-10 col-sm-5" value="<?php echo $halte_terpilih->longitude?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Latitude </label>
			<div class="col-sm-9">
				<input type="text" name="Latitude" placeholder="Latitude" class="col-xs-10 col-sm-5" value="<?php echo $halte_terpilih->latitude?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Warna </label>
			<div class="col-sm-9">
				<input type="text" name="Warna" placeholder="Warna Halte" class="col-xs-10 col-sm-5" value="<?php echo $halte_terpilih->warna?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Keterangan </label>
			<div class="col-sm-9">
				<input type="text" name="Keterangan" placeholder="null" class="col-xs-10 col-sm-5" value="<?php echo $halte_terpilih->keterangan?>" />
			</div>
		</div>
	<!-- 	<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor Id</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control "  name="Koridor" data-placeholder="Koridor Id">
				<?php foreach ($koridor as $key => $value){ ?>
					<?php if ($halte_terpilih->koridor_id==$value->id) { ?>
					<option selected value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } else{ ?>
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php }}?>
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
					<?php if ($halte_terpilih->relasi==$value->id) { ?>
					<option selected value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } else{ ?>
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php }} ?>
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