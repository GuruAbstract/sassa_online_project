@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>
<section class="artical-sec main-sec">
        <div class="container">
            <div class="row">
                <div class="main-content-sec">
                    <h2>{{$post->title}}</h2>
                    <div class="post-item full-post">
                        <div class="img-sec">
                            <img src="/storage/cover_images/{{$post->cover_image}}" alt="h1">
                            <a href="#" class="category-ttl green">health & Fitness</a>
                        </div>
                        <h3><a href="/posts/{{$post->slug=''}}">{{$post->title}}</a></h3>
                        <ul class="post-tools">
                            <li class="admin"><a href="#"> {{$post->user->name}}</a></li>
                            <li class="date">{{$post->created_at}}</li>
                            <li class="comment">(0) Comments</li>
                        </ul>
                    </div>
                    {!!$post->body!!}

                    <div class="share-sec">
                         <div class="share align-middle">
                            <span class="text">Share On :</span>
                            <span class="fb"><i class="fa fa-facebook-official"></i></span>
                            <span class="instagram"><i class="fa fa-instagram"></i></span>
                            <span class="twitter"><i class="fa fa-twitter"></i></span>
                            <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                            <span class="google"><i class="fa fa-google-plus"></i></span>
                        </div>
                    </div>
                        @if(!Auth::guest())
                        @if(Auth::user()->id == $post->user_id)
                           <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                
                            <p>{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}</p>
                        @endif
                    @endif
                    <div class="similar-posts">
                            <h3>Similar Posts</h3>
                           <div class="row small-posts">
                            
                                <div class="col-md-6 col-sm-6">
                                    <div class="post-item">
                                        <div class="img-sec">
                                            <a href="#"><img src="images/t2.jpg" alt="h1"></a>
                                        </div>
                                        <h3><a href="#">Girl doing yoga on the beach in early morning</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="comment">(0) Comments</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="post-item">
                                        <div class="img-sec">
                                            <a href="#">  <img src="images/t3.jpg" alt="h1"></a>
                                        </div>
                                        <h3><a href="#">Girl doing yoga on the beach in early morning</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="comment">(0) Comments</li>
                                        </ul>
                                    </div>
                                </div>
                             </div>
                            </div>
                </div>
                    <aside>
                            <div class="ad-sec">
                                <img src="images/vertical-ads.jpg" alt="add">
                            </div>
                            <div class="top-stores">
                                <h2>Top Stories</h2>
                                <div id="demo" class="carousel slide" data-ride="carousel">
                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="post-item">
                                                <div class="img-sec">
                                                    <a href="#">  <img src="images/ts1.jpg" alt="h1"></a>
                                                    <a href="#" class="category-ttl red">Photography</a>
                                                </div>
                                                <h3><a href="#">Man jogging on the streets of america in early morning</a></h3>
                                                <ul class="post-tools">
                                                    <li class="admin"><a href="#">Admin</a></li>
                                                    <li class="date">23 Jan 2018</li>
                                                    <li class="comment">(0) Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="post-item">
                                                <div class="img-sec">
                                                    <a href="#">  <img src="images/ts1.jpg" alt="h1"></a>
                                                    <a href="#" class="category-ttl red">Photography</a>
                                                </div>
                                                <h3><a href="#">Man jogging on the streets of america in early morning</a></h3>
                                                <ul class="post-tools">
                                                    <li class="admin"><a href="#">Admin</a></li>
                                                    <li class="date">23 Jan 2018</li>
                                                    <li class="comment">(0) Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="post-item">
                                                <div class="img-sec">
                                                    <a href="#">  <img src="images/ts1.jpg" alt="h1"></a>
                                                    <a href="#" class="category-ttl red">Photography</a>
                                                </div>
                                                <h3><a href="#">Man jogging on the streets of america in early morning</a></h3>
                                                <ul class="post-tools">
                                                    <li class="admin"><a href="#">Admin</a></li>
                                                    <li class="date">23 Jan 2018</li>
                                                    <li class="comment">(0) Comments</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev nav-btn" href="#demo" data-slide="prev">
                                        <span class="carousel-control-prev-icon">
                                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>previous post
                                        </span>
                                      </a>
                                    <a class="carousel-control-next nav-btn" href="#demo" data-slide="next">
                                        <span class="carousel-control-next-icon">
                                            Next post <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </span>
                                      </a>
                                </div>
                            </div>
                            <div class="other-stories">
                                <h2>other stories</h2>
                                <div class="post-item row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="img-sec">
                                            <a href="#">  <img src="images/os1.jpg" alt="h1"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <h3><a href="#">Girl ramp walking on the streets</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="fashion"><a href="#">Fashion</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="post-item row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="img-sec">
                                            <a href="#">  <img src="images/os2.jpg" alt="h1"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <h3><a href="#">Girl ramp walking on the streets</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="fashion"><a href="#">Fashion</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="post-item row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="img-sec">
                                            <a href="#">  <img src="images/os3.jpg" alt="h1"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <h3><a href="#">Girl ramp walking on the streets</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="fashion"><a href="#">Fashion</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="post-item row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="img-sec">
                                            <a href="#">  <img src="images/os1.jpg" alt="h1"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <h3><a href="#">Girl ramp walking on the streets</a></h3>
                                        <ul class="post-tools">
                                            <li class="admin"><a href="#">Admin</a></li>
                                            <li class="date">23 Jan 2018</li>
                                            <li class="fashion"><a href="#">Fashion</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </aside>       
        </div>
        </div>
    </section>
   
@endsection