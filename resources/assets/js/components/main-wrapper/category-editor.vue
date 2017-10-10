<template>
	<div>{{message}}</div>
	<form>
		Name: <br>
		<input type="text"  v-model="name" name="name" value="{{name}}" size="50"><br>

		<input type="button" value="Submit" @click="editUser(id)">
	</form>
</template>

<script>
	export default{
		data(){
			return{
				message: '',
				id: null,
				name: '',
			}
		},
		methods:{
			getCategory: function(id) {
				this.$http.get('/api/categories/' + id).then(function (response) {
					this.name = response.data.data.name;
				});
			},

			editUser: function(id) {
				this.$http.post('/api/categories/' + id, {name: this.name}).then(function (response) {
					this.message = "updated";
					this.getUser(id);
				});
			},
		},

		ready: function(){
			this.id = this.$route.params.id;
			this.getCategory(this.id);
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