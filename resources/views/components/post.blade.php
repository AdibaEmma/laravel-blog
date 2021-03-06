@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user)}}" class="font-bold">{{ $post->user->name }}</a>
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }} </span>

    
</div>

    <p class="mb-2">{{ $post->body  }}</p>

    <div class="flex items-center">
        @auth
                @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500"><i class="fas fa-thumbs-up"></i></button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="ml-2 mr-2 mt-1">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="text-blue-500"><i class="fas fa-thumbs-down"></i></button>
                </form>
            @endif
        @endauth
        

        <span class="text-gray-600 text-sm">{{ $post->likes->count()}} {{ Str::plural('like', $post->likes->count())}}</span>
        
                <span class="text-gray-400 ml-2 mr-2 inline"><a href="{{ route('posts.show', $post->id) }}"><i class="fas fa-eye"></i></a></span>
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="ml-2 inline">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </form>
                @endcan
            
    </div>