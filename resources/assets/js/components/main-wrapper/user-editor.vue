<template>
	<div>{{message}}</div>
	<form>
		Name: <br>
		<input type="text"  v-model="name" name="name" value="{{name}}" size="50"><br>
		email: <br>
		<input type="text" v-model="email" name="email" value="{{email}}" size="50"><br>
		level: <br>
		<input type="text" v-model="level" name="level" value="{{level}}" size="50"><br>
		password: <br>
		<input type="text" v-model="password" name="password" value="" size="50"><br>

		<input type="button" value="Submit" @click="editUser(userId)">
	</form>
</template>

<script>
	export default{
		data(){
			return{
				message: '',
				userId: null,
				name: '',
				email: '',
				level: '',
			}
		},
		methods:{
			getUser: function(userId) {
				this.$http.get('/api/users/' + userId).then(function (response) {
					this.name = response.data.data.name;
					this.email = response.data.data.email;
					this.level = response.data.data.level;
				});
			},

			editUser: function(userId) {
				this.$http.post('/api/users/' + userId, {name: this.name, email: this.email, level: this.level, password: this.password}).then(function (response) {
					this.message = "updated";
					this.getUser(userId);
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
			this.userId = this.$route.params.id;
			this.getUser(this.userId);
		},
	}
</script>

<style>
	.list {

	}

	.list > li {

	}

	input {
		color: black;
	}
</style>