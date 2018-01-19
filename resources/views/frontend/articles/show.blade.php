@extends('layouts.app')
@section('content')
    <div class="container">
        <?php /**
         * @var \App\Models\Article $article
         */ ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ \Illuminate\Support\Facades\URL::previous() }}" class="btn btn-success">
                    Back
                </a>
                {{ $article->title }}
                <span class="pull-right">{{ $article->created_at }}</span>
            </div>
            <div class="panel-body">
                {{ $article->desc }}
            </div>
        </div>
    </div>
@endsection