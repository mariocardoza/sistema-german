@extends('layouts.app')

@section('migasdepan')
<h1>
	Registro de cuentas
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/cuentas') }}"><i class="fa fa-dashboard"></i>Catalogo</a></li>
	<li class="active">Registro</li> </ol>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11" >
			<div class="panel panel-primary">
				<div class="panel-heading">Planilla de salarios</div>
				<div class="panel-body">
            {{ Form::open(['action'=> 'PlanillaController@store', 'class' => 'form-horizontal']) }}
            @include('planillas.planilla')
            <div class="form-group">
  						<div class="col-md-6 col-md-offset-4">
  							<button type="submit" class="btn btn-success">
  								<span class="glyphicon glyphicon-floppy-disk">Registrar</span>
  							</button>
  						</div>
  					</div>
            {{ Form::close() }}


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
