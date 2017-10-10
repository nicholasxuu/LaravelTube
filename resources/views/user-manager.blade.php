@extends('layouts.app')

@section('htmlheader_title')
	User Manager
@endsection

@section('customs_scripts')
	<script src="{{ asset('js/user-manager.js') }}"></script>
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10">
				<div id="response"></div>
				<div class="user-manager" id="user-manager">
					<table style="width:100%" class="table table-hover table-bordered">
						<thead class="thead-inverse">
							<tr>
								<th>id</th>
								<th>name</th>
								<th>email</th>
								<th>level</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="user in users">
								<td>@{{user.id}}</td>
								<td>@{{user.name}}</td>
								<td>@{{user.email}}</td>
								<td>@{{user.level}}</td>
								<td><a href="/user/editor/@{{user.id}}">edit</a></td>
								<td><a @click="deleteUser(user.id, user.name, user.email)">delete</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection