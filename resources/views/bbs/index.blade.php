@extends('layouts.front')

@section('title')
仮ページ
@endsection
<header>
    <div class="container">
        <div class="header-title-area">
            <h1 class="logo">制作中</h1>
            <p class="text-sub">表示テスト中。</p>
        </div>
    </div>
</header>

@section('content')
@auth
    <div class="container">
        <div class="row">
            <h2>質問一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('User\BbsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('User\BbsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-bbs col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $bbs)
                                <tr>
                                    <th>{{ $post->updated_at->format('Y年m月d日') }}</th>
                                    <td>{{ \Str::limit($bbs->title, 100) }}</td>
                                    <td>{{ \Str::limit($bbs->body, 250) }}</td>
                                    <td>
                                        @can('edit', $bbs)
                                        <div>
                                            <a href="{{ action('User\BbsController@edit', ['id' => $bbs->id]) }}">編集</a>
                                                @component('components.btn-del')
                                                @slot('controller', 'posts')
                                                @slot('id', $bbs->id)
                                                @slot('name', $bbs->title)
                                                @endcomponent
                                        </div>
                                        @endcan
                                        
                                        @can('edit', $post)
                                        <div>
                                            <<a href="{{ action('User\BbsController@delete', ['id' => $bbs->id]) }}">削除</a>
                                            @component('components.btn-del')
                                            @slot('controller', 'posts')
                                            @slot('id', $post->id)
                                            @slot('name', $post->title)
                                            @endcomponent
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endauth
@endsection