@extends('layouts.app')

@section('htmlheader_title')
	Category Editor
@endsection

@section('customs_scripts')
	<script src="{{ asset('js/category-editor.js') }}"></script>
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10">
				<div id="response"></div>
				<meta name="category-id" content="{{$id}}">
				<div class="category-editor" id="category-editor">
					<div>@{{message}}</div>
					<form>
						Name: <br>
						<input type="text"  v-model="name" name="name" value="@{{name}}" size="50"><br>

						<input type="button" value="Submit" @click="editCategory(id)">
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection