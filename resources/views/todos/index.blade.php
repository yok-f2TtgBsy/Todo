<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
</head>
<body>
    <div class="container mt-3">
        <h1>Todoリスト</h1>
    </div>
    <div class="container mt-3">
        <div class="container mb-4">
            {!! Form::open(['route' => 'todos.store', 'method' => 'POST']) !!}
            {{ csrf_field() }}
                <div class="row">
                    {{ Form::text('newTodo', null, ['class' => 'form-control col-8 mr-5']) }}
                    {{ Form::date('newDeadline', null, ['class' => 'mr-5']) }}
                    {{ Form::submit('新規追加', ['class' => 'btn btn-primary']) }}
                </div>
            {!! Form::close() !!}
        </div>

        {{-- エラー表示 ここから --}}
        @if ($errors->has('newTodo'))
            <p class="alert alert-danger">{{ $errors->first('newTodo') }}</p>
        @endif
        @if ($errors->has('newDeadline'))
            <p class="alert alert-danger">{{ $errors->first('newDeadline') }}</p>
        @endif
        {{-- エラー表示 ここまで --}}

        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    @foreach ($todos ?? '' as $todo)
                        <div class="card col-md-3">
                            <h3 scope="row" class="todo">{{ $todo->todo }}</ｈ3>
                            <h5 class="description">期限：{{ $todo->deadline }}</h5>
                            <table>
                                <tr>
                                    <td><p><a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-info">編集</a></p></td>
                                    {!! Form::open(['route' => ['todos.destroy', $todo->id], 'method' => 'POST']) !!}
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <td><p>{{ Form::submit('削除', ['class' => 'btn btn-danger']) }}</p></td>
                                    {!! Form::close() !!}
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}