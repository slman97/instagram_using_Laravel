@extends('layouts.app')
@section('title','Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center pb-2">
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->ProfileImage()}}" class="w-100 rounded-circle" style="max-width: 50px">
                        </div>
                        <div>
                            <a class="font-weight-bold text-dark" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a>

                        </div>

                        @can('update',$post)
                            <div class="pl-4">
                                <a href="#" data-toggle="dropdown" aria-label="Open Menu"><img src="/svg/lnr-cog.svg" class="pr-2"></a>


                                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                                    <li class="dropdown-item">
                                        <a href="{{ route('posts.edit', $post->id)}}"><img src="/svg/lnr-pencil.svg" class="pr-2"></a>

                                    </li>
                                    <li class="dropdown-item">

                                        <form action ="{{ route('posts.destroy', $post->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" name="submit" value="🗑" class="btn btn-danger">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                    </div>
                    <hr>
                </div>
                <div class="w-25">
                    <p><span>
                            <a class="font-weight-bold text-dark pr-2" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a>
                        </span>
                        {{ $post->caption }}</p><hr>
                    <div class="pr-5 d-flex">
                        @guest
                             <a href="javascript:void(0);" onclick="{
                                  closeButton: true,
                                   progressBar: true,
                              })">🖤{{ $post->favorite_to_users->count() }} sadsadas</a>
                              @else
                            <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                             class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

                         <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                                 @csrf
                             </form>
                         @endguest
                        <strong>{{ $post->comments->count() }}</strong>
                        <a>comments</a>
                    </div>
                    <hr>
                </div>
                <br>
                <div>
                    @foreach ($post->comments as $comment)
                     <div class="">
                         <a href="/profile/{{ $comment->user->id }}">   <img src="{{ $comment->user->profile->ProfileImage()}}" class="w-100 rounded-circle" style="max-width: 50px"></a>
                         <a class="font-weight-bold text-dark pl-3" href="/profile/{{ $comment->user->id }}">{{ $comment->user->username }}</a>
                         <a class="date pl-4 pt-1">on {{ $comment->created_at->diffForHumans()}}</a>
                     </div>
                        <p>{{ $comment->body }}</p><form method="POST" action="{{ route('comments.destroy', [$comment->id]) }}">
                            {{ csrf_field() }}

                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                        <hr>
                    @endforeach

                </div>

                <form method="POST" action="/posts/{{ $post->id }}/store">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="body">WRITE COMMENT</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="primar-btn banner-btn">ADD COMMENT</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
