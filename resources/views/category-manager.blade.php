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
					<table style="width:100%" class="table table-hover table-bordered">
						<thead class="thead-inverse">
							<tr>
								<th>id</th>
								<th>name</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="category in categories">
								<td>@{{category.id}}</td>
								<td>@{{category.name}}</td>
								<td><a href="{{url('/category/editor/')}}/@{{category.id}}">edit</a></td>
								<td><a @click="deleteCategory(category.id, category.name)">delete</a></td>
							</tr>
						</tbody>
					</table>

					<div>
						Add - Name: <br>
						<input type="text"  v-model="newCategoryName" size="50"><br>

						<input type="button" value="Submit" @click="addCategory()">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection