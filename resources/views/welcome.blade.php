<x-app-layout>

    @foreach($posts as $post)
       <div>
              <h1>{{ $post->title }}</h1>
              <p>{!! $post->body !!}</p>
       </div>
    @endforeach
</x-app-layout>
