<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-kZAyZR6UxpnJ+KryoMmUz5l/6en8XCp+HHAAK5GSLf2xlYtvJ8U2Q4U+9cuEnJoa3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

<style>
    .textarea-container {
        position: relative;
    }

    textarea {
        padding-right: 2.5rem;
    }

    .attach-icon {
        position: absolute;
        bottom: 0.5rem;
        right: 0.5rem;
        width: 1.5rem;
        height: 1.5rem;
        cursor: pointer;
    }
</style>

<div class="widget-content widget-content-area br-8 p-4">
    <b>Chat</b>
    
    <div class="messages">
        @foreach($data->messages as $m)
         <!-- message 1 -->
         <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
         <?php
           $url='/src/assets/img/default_pic.webp';
           if($m->userDetail?->profile_pic!=null){
             $url=$m->userDetail?->profile_pic;
           }
         ?>
            <img class="rounded" src="{{$url}}" alt="pic1">
            <div class="media-body">
                <h4 class="media-heading">{{$m->userDetail?->name}}</h4>
                <p class="media-text">{{$m->message}}</p>
                <?php 
                      if($m->attachment){
                        if (strpos($m->attachment, 'mp3') != false ){
                                        
                                        ?>
                                        
                                        <div class="m-2">
                                        <audio src="{{$m->attachment}}" controls></audio>
                                        </div>
                                        <?php
                         }
                    }
                    ?>
            </div>
        </div>
        <!--- message 1 ending --->


        @endforeach
        
       

        

        <!--- textarea ---> 
        <!---
        <div class="textarea-container mt-4">
            <textarea class="form-control" rows="5" placeholder="Write your message here..."></textarea>

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attach-icon"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>

        </div>
        <input type="submit" class="btn btn-primary mt-2 mb-2" value="Send Message">
        --->
        <!--- ending textarea --->
    
    </div>
    

</div>