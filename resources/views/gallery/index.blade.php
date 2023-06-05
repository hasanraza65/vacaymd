@extends('layouts.layout')
@section('title','Image Gallery')
@section('content') 
 


        <!-- BREADCRUMB -->
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Gallery</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Images</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->

        <div class="row layout-top-spacing">
        <form action="gallery" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
            <input type="file" name="file" required class="form-control" id="" accept="image/*,.pdf,audio/*">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
               
                
            <input type="submit" value="Upload" class="btn btn-success">
              
            </div>

        </div>
            
         </form>
        </div>
        
        <div class="row">
            @foreach($images as $image)
             <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card style-2 mb-md-0 mb-4">
                    <?php
                    $pdf='/src/assets/img/default_pdf.png';
                    $audio='/src/assets/img/default_audio.png';
                    $file='/src/assets/img/default_file.png';
                    if (strpos($image->filepath, 'pdf') == false && strpos($image->filepath, 'mp3') == false )
                    {
                        $fpath=$image->filepath;
                    }else if (strpos($image->filepath, 'pdf') != false){
                        $fpath=$pdf;

                    }else if (strpos($image->filepath, 'mp3') != false ){
                        
                        $fpath=$audio;
                    }else{
                        $fpath=$file;
                    }
                    ?>
                    <img src="{{$fpath}}" class="card-img-top" alt="...">
                    
                    <div class="card-body px-0 pb-0">
                        <h5 class="card-title mb-3">{{$image->filename}}</h5>
                        <div class="media mt-4 mb-0 pt-1">
                        <?php
                          $url='/src/assets/img/default_pic.webp';
                          if($image->userDetail?->profile_pic!=null){
                            $url=$image->userDetail?->profile_pic;
                          }
                        ?>
                            <img src="{{$url}}" class="card-media-image me-3" alt="">
                            <div class="media-body">
                                <h4 class="media-heading mb-1">{{$image->userDetail?->name}}</h4>
                                <p class="media-text">{{date('m/d/Y',strtotime($image->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                        </div>
            </div>
            @endforeach
        </div> 


       
@endsection