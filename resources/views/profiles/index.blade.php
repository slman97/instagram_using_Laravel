@extends('layouts.app')
@section('title', $user->profile->title )
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-3 p-4">
            <img src="{{ $user->profile->ProfileImage() }}" class="rounded-circle w-100" >
        </div>
        <div class="col-xl-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->profile->title }}</h1>

                <div class="d-flex align-items-center pb-3">
                    <!-- follow button -->


                    @cannot('update',$user->profile)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        <a href="/messinger/{{$user->id}}" class="primar-btn banner-btn">messinger</a>
                    @endcannot
                </div>

                @can('update',$user->profile)
                    <a href="/p/create" class="primar-btn banner-btn">Add anew post</a>
                @endcan


            </div>
           
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong>Post</div>
                <div class="pr-5"><strong>{{ $user->profile->followers->count() }}</strong>Followers</div>
                <div class="pr-5"><strong>{{ $user->following->count() }}</strong>following</div>
            </div>
            <div class="pt-2">
                <a>@</a>
                <a>{{ $user->username }}</a>
            </div>
            <div class="pt-2">
               <p>{{ $user->profile->description }}</p>
            </div>
            <div class="pt-1 pb-5">
                <a href="#">{{ $user->profile->url }}</a>
                </div>
        </div>
    </div>

    <div class="row pt-6 ">
     @foreach($user->posts as $post)
         <div class="col-xl-4 pb-4 con">
                 <a href="/p/{{ $post->id }}">
                     <img src="/storage/{{ $post->image }}" alt="Avatar"  class="imag w-100">
                 </a>
                 <div class="middl">
                     <div class="texts">
                         <a>{{ $post->favorite_to_users->count() }} <img src="/svg/heart.svg"></a>
                         <a>{{$post->comments->count()}} <img src="/svg/bubble.svg"></a>
                         <br>
                         <a>on {{ $post->created_at->diffForHumans()}}</a>
                     </div>
                 </div>
         </div>
         @endforeach
    </div>
</div>
@endsection
