@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($articles as $article)
            <?php /**
             * @var \App\Models\Article $article
             */ ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('article.show', $article->id) }}">
                        {{ $article->title }}
                    </a>
                    <span class="pull-right">{{ $article->created_at }}</span>
                </div>
                <div class="panel-body">
                    {{ str_limit($article->desc) }}
                </div>
            </div>
        @endforeach
        {{ $articles->links() }}
    </div>
@endsection