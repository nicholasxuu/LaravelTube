@extends('layouts.app')

@section('htmlheader_title')
    User Editor
@endsection

@section('customs_scripts')
    <script src="{{ asset('js/user-editor.js') }}"></script>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10">
                <div id="response"></div>
                <meta name="user-id" content="{{$id}}">
                <div class="user-editor" id="user-editor">
                    <div>@{{message}}</div>
                    <form>
                        Name: <br>
                        <input type="text"  v-model="name" name="name" value="@{{name}}" size="50"><br>
                        email: <br>
                        <input type="text" v-model="email" name="email" value="@{{email}}" size="50"><br>
                        level: <br>
                        <input type="text" v-model="level" name="level" value="@{{level}}" size="50"><br>
                        password: <br>
                        <input type="text" v-model="password" name="password" value="" size="50"><br>

                        <input type="button" value="Submit" @click="editUser(userId)">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
