@extends('admin.template.main')

@section('title','Inicio')

@section('content')

<h1>Rest Api Services</h1>

<hr>
<h4>Listado de Practicantes</h4>
<a href="/api/practicantes">/api/practicantes</a>
<p> <a href="/api/practicantes/1">/api/practicantes/1</a>
<i style="font-size: 11px; color: grey;">Adding the ID bring you only the selected practicante (ie. /api/practicantes/1)</i></p>

<h4>Listado de Artículos por categoria</h4>
<a href="/api/articlesCat/6">/api/articlesCat/6</a>
<p><i style="font-size: 11px; color: grey;">the ID correspond to the Category ID of the articles</i></p>

<h4>Listado de Categorías</h4>
<a href="/api/categories">/api/categories</a>

<h4>Listado de Artículos por Tags</h4>
<a href="/api/articlesTag/6">/api/articlesTag/6</a>
<p><i style="font-size: 11px; color: grey;">This Api brings the articles who have this tag selected</i></p>

<h4>Listado de Tags</h4>
<a href="/api/tags">/api/tags</a>

<h4>Listado de Usuarios Registrados</h4>
<a href="/api/users">/api/users</a>
<p><a href="/api/users/1">/api/users/1</a> 
<i style="font-size: 11px; color: grey;">Adding the ID bring you only the selected user (ie. /api/users/1)</i></p>

<h4>Listado de Grados o Cinturones</h4>
<a href="/api/ranks">/api/ranks</a>

<h4>Listado de Dojos</h4>
<a href="/api/dojos">/api/dojos</a>


@endsection
