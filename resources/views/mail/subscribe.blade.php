<h1>Hello {{ $name }}. We have interesting news!</h1>
<p>Follow the link to read the <a href="{{route('api.article.show', ['id' => $article_id])}}">new article</a></p>
<p>Thank you for using our application!</p>