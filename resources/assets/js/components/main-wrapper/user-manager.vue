<template>
	<table style="width:100%">
		<tr>
			<th>id</th>
			<th>name</th>
			<th>email</th>
			<th>level</th>
			<th></th>
			<th></th>
		</tr>
		<tr v-for="user in users">
			<td>{{user.id}}</td>
			<td>{{user.name}}</td>
			<td>{{user.email}}</td>
			<td>{{user.level}}</td>
			<td><a v-link="{ path: '/users/editor/' + user.id}">edit</a></td>
			<td><a @click="deleteUser(user.id, user.name, user.email)">delete</a></td>
		</tr>
	</table>
</template>

<script>
	export default{
		data(){
			return{
				users:[],
			}
		},
		methods:{
			getUserList: function() {
				this.$http.get('/api/users/').then(function (response) {
					this.users = response.data.data;
				});
			},

			deleteUser: function(id, name, email) {
				const confirmDelete = confirm(`sure to delete ${name} | ${email}?`);
				if (confirmDelete) {
					this.$http.delete('/api/users/' + id).then(function (response) {
						this.getUserList();
					});
				}
			},
		},

		ready: function(){
			this.getUserList();
		},
	}
</script>

<style>
</style>