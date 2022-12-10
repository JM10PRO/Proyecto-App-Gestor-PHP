@extends('_template')

@section('cuerpo')
<div style="background: #47cc4b; margin:1em; border:1px solid #999; border-radius:5px; margin:1em 5em">
    <h3 style="text-align: center;">{{$descripcion}}</h3>
</div>
<a class="btn btn-secondary" href="<?= BASE_URL ?>operariolistar?pagina={{$pagina}}">Volver al listado</a>
@endsection
