@extends('admin/layout')

@section('content')

@include('admin/companies/form', ['target' => 'update'])

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">受講者一覧</h3>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>削除</th>
          </tr>
          @foreach($company->participants() as $participant)
          <tr>
            <td>{{ $participant->id }}</td>
            <td><a href="/admin/users/{{$participant->id}}/edit">{{$participant->name}}</a></td>
            <td>{{ $participant->email }}</td>
            <td>
                <form action="/admin/users/{{ $participant->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
            </td>
          </tr>
          @endforeach
        </table>
        <div><a href="/admin/users/create?type=1&companyId={{$company->id}}" class="btn btn-default">新規作成</a></div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3 class="ops-title">人事担当者一覧</h3>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-1">
        <table class="table table-hover">
          <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>削除</th>
          </tr>
          @foreach($company->managers() as $manager)
          <tr>
            <td>{{ $manager->id }}</td>
            <td><a href="/admin/users/{{$manager->id}}/edit">{{$manager->name}}</a></td>
            <td>{{ $manager->email }}</td>
            <td>
                <form action="/admin/users/{{ $manager->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
            </td>
          </tr>
          @endforeach
        </table>
        <div><a href="/admin/users/create?type=2&companyId={{$company->id}}" class="btn btn-default">新規作成</a></div>
      </div>
    </div>
</div>
@endsection
