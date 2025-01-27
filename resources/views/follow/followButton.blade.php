            @if(Auth::check() && Auth::user()->id !== $user->id )
                @if(!Auth::user()->following->contains($user->id))                  
                    <form method="POST" action="{{ route('follow', $user) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            @if($user->following->contains(Auth::user()->id))
                                Follow back
                            @else
                                Follow
                            @endif
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('unfollow', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Unfollow
                        </button>
                    </form>
                @endif
            @endif