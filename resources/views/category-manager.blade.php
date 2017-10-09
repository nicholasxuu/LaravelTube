@extends('layouts.app')

@section('htmlheader_title')
	Category Manager
@endsection

@section('customs_scripts')
	<script src="{{ asset('js/category-manager.js') }}"></script>
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10">
				<div id="response"></div>
				<div class="category-manager" id="category-manager">
					<table style="width:100%">
						<tr>
							<th>id</th>
							<th>name</th>
							<th></th>
							<th></th>
						</tr>
						<tr v-for="category in categories">
							<td>@{{category.id}}</td>
							<td>@{{category.name}}</td>
							<td><a href="/category/editor/@{{category.id}}">edit</a></td>
							<td><a @click="deleteCategory(category.id, category.name)">delete</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection