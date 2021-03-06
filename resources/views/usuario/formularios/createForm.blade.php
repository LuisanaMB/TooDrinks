{!! Form::open(['route' => 'usuario.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre de Usuario') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de Usuario'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electrónico') !!}
			{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo Electrónico'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Contraseña') !!}
			{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('nombre', 'Nombre') !!}
			{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('apellido', 'Apellido') !!}
			{!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Apellido'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('direccion', 'Dirección') !!}
			{!! Form::textarea('direccion', null, ['class' => 'form-control', 'placeholder' => 'Dirección', 'rows' => '5'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('codigo_postal', 'Código Postal') !!}
			{!! Form::text('codigo_postal', null, ['class' => 'form-control', 'placeholder' => 'Código Postal'] ) !!}
		</div>
		
		<div class="form-group">
			<select name="pais_id" class="form-control">
				@foreach ($paises as $pais )
					<option value="{{ $pais->id }}">{{ $pais->pais }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<select name="provincia_region_id" class="form-control">
				@foreach ($provincias as $provincia )
					<option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<select name="estado_datos" class="form-control">
				<option value="0">Sin Actualizar</option>
				<option value="1">Actualizados</option>
			</select>
		</div>

		<div class="form-group">
			{!! Form::label('telefono', 'Teléfono') !!}
			{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('telefono_opcional', 'Teléfono') !!}
			{!! Form::text('telefono_opcional', null, ['class' => 'form-control', 'placeholder' => 'Teléfono Opcional'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::label('avatar', 'Imagen / Avatar') !!}
			{!! Form::file('avatar', ['class' => 'form-control', 'required'] ) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Agregar Usuario', ['class' => 'btn btn-primary']) !!}
		</div>
		
	{!! Form::close() !!}
