@extends('layouts.front')

@section('title')
仮プロフページ
@endsection
<p> --プロフテスト中-- </p>

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="body mt-3">
                                    <label class="col-md-2" for="name">名前</label>
                                    {{ \Str::limit($post->name, 100) }}
                                </div>
                                <div class="body mt-3">
                                    <label class="col-md-2" for="email">メール</label>
                                    {{ \Str::limit($post->email, 200) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
@endsection