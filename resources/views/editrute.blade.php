@extends('template-manajemen')
@section('judul')
Rute
<small>
	<i class="ace-icon fa fa-angle-double-right"></i>
	Edit
</small>
@endsection
@section('content-tabel')
	<form class="form-horizontal" role="form" method="post" action="<?php echo $rute_terpilih->id?>">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor Asal</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control "  name="Koridor_Asal" data-placeholder="Id Koridor Asal">
				
				<?php foreach ($koridor as $key => $value){ ?>
				<?php if ($rute_terpilih->koridor_asal==$value->id) { ?>
					<option selected value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } else{ ?>	
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } }?>
				</select>
				</div>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor Tujuan</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control "  name="Koridor_Tujuan" data-placeholder="Id Koridor Tujuan">
				
				<?php foreach ($koridor as $key => $value){ ?>
				<?php if ($rute_terpilih->koridor_tujuan==$value->id) { ?>
					<option selected value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } else{ ?>	
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php }} ?>
				</select>
				</div>
				</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Koridor Via</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control "  name="Koridor_Via" data-placeholder="Id Koridor Via">
				
				<?php foreach ($koridor as $key => $value){ ?>
				<?php if ($rute_terpilih->koridor_via==$value->id) { ?>
					<option selected value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } else{ ?>
					<option value="<?php echo $value->id?>"><?php echo $value->id?> : <?php echo $value->nama?></option>
					<?php } }?>
				</select>
				</div>
				</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Halte Transisi</label>

				<div class="col-sm-9">
				<div class="col-xs-10 col-sm-5 no-padding">
				<select class="chosen-select form-control " name="Halte_Transisi" data-placeholder="Id Halte Penghubung">
				
				<?php foreach ($halte as $key => $value){ ?>
				<?php if ($rute_terpilih->halte_transisi==$value->id) { ?>
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