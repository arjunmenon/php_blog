<div class="form-group">
	{{Form::label('title', "Title")}}
	{{Form::text("title", $post->title ?? '', ['class' => 'form-control', 'placeholder' => 'Enter a post title'])}}
</div>

<div class="form-group">
	{{Form::label('body', "Body")}}
	{{Form::textarea("body", $post->body ?? '', ['class' => 'form-control', 'placeholder' => 'Write the post body'])}}
</div>