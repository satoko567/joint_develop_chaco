            @if(Auth::check() && Auth::user()->id !== $post->user_id )
                @if(!Auth::user()->following->contains($post->user->id))                  
                    <form method="POST" action="{{ route('follow', $post->user) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            @if($post->user->following->contains(Auth::user()->id))
                                Follow back
                            @else
                                Follow
                            @endif
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('unfollow', $post->user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                    </form>
                @endif
            @endif