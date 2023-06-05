<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-kZAyZR6UxpnJ+KryoMmUz5l/6en8XCp+HHAAK5GSLf2xlYtvJ8U2Q4U+9cuEnJoa3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

<style>
    .textarea-container {
        position: relative;
    }

    textarea {
        padding-right: 2.5rem;
    }
     .selectedImage{
        border:2px solid green;
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
        
        <div class="msgs_appending_div">
        @foreach($messages as $messages_data)
        <div id="row_{{$messages_data->id}}" data-id="{{$messages_data->id}}" class="messages_texts_div">
            
            <!-- message box -->
            <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
                <img class="rounded" src="{{ empty($messages_data->userDetail->profile_pic) ? '/src/assets/img/default_pic.webp' : $messages_data->userDetail->profile_pic }}" alt="pic1">
                <div class="media-body">
                <?php $messageRole=App\Http\Controllers\AuthController::getUserRole($messages_data->user_id);
                    if($messageRole->user_role==2){
                        $sendername='Doctor';
                    }else if($messageRole->user_role==4){
                        $sendername='Patient';
                    }else{
                        $sendername='';
                    }
                    
                    ?>
                    <h4 class="media-heading"><?=$sendername;?>: {{$messages_data->userDetail->name}}</h4>
                    <span class="message_date mb-4">{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</span>
                    <p id="media-text{{$messages_data->id}}" class="media-text mt-2">{{$messages_data->message}}</p>
                </div>
                @if($messages_data->user_id == Auth::user()->id)
                <div id="action_btn_div{{$messages_data->id}}" class="action_btn_div d-none">
                    
                    <span onclick="editMessage('{{$messages_data->message}}',{{$messages_data->id}})" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                    <span onclick="deleteFunction({{$messages_data->id}},'/doctor/messages/{{$messages_data->id}}')" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> 

                </div>
                @endif
            </div>
            <!--- message box ending --->
            
        </div>
        @endforeach
        </div>

        <!--- textarea ---> 

        <div class="textarea-container mt-4">
            <textarea name="message" id="message_text" class="form-control" rows="5" placeholder="Write your message here..."></textarea>

               <!--- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attach-icon"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                --->
        </div>
        @if(Auth::user()->profile_pic == null || Auth::user()->profile_pic == "")
        @php 
        $profile_pic = '/src/assets/img/default_pic.webp';
        @endphp
        @else
        @php 
        $profile_pic = Auth::user()->profile_pic;
        @endphp
        @endif
        <input onclick="sendMessage('{{$profile_pic}}', '{{Auth::user()->name}}',{{$data->id}},{{Auth::user()->user_role}})" type="button" class="btn btn-primary mt-2 mb-2" value="Send Message">
         <button onclick="getMessage({{$data->id}},{{Auth::user()->user_role}})" class="btn btn-outline-success">Refresh</button>
        <!--- ending textarea --->

        <!-- ///////  Notes -->
        <!-- <button data-bs-toggle="modal" data-bs-target="#noteModal" class="btn btn-outline-warning" type="button" id="button-addon2">Save Note</button> -->

        <!-- ///////  Notes end -->
    
    </div>

</div>


<!-- ///// Notes -->

<div class="widget-content widget-content-area br-8 m-2 p-4">
    <b>Patient Notes</b>
    <div class="notes_appending_div">
        @foreach($notes as $note)
        <div id="row_{{$note->id}}" data-id="{{$note->id}}" class="notes_texts_div">
            
            <!-- message box -->
            <div style="border-radius: 10px" class="media shadow-sm p-4 m-2">
               
                <div class="media-body">
                  
                    <span class="message_date mb-4">{{ \Carbon\Carbon::parse($note->created_at)->format('m/d/Y') }}</span>
                    <p id="media-text{{$note->id}}" class="media-text mt-2">{{$note->message}}</p>
                    <?php
                    $pdf='/src/assets/img/default_pdf.png';
                    $audio='/src/assets/img/default_audio.png';
                    $file='/src/assets/img/default_file.png';
                    ?>

                    <table>
                        <tr>
                            <td>
                                <?php
                                if($note->filepath){

                    
                                    if (strpos($note->filepath, 'pdf') == false && strpos($note->filepath, 'mp3') == false )
                                    {
                                        $fpath=$note->filepath;
                                        ?>
                                        <input type="hidden" value="{{$note->filepath}}" name="" id="">
                                         
                                          <a href="{{$note->filepath}}">
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                         </a>
                                        <?php
                                    }else if (strpos($note->filepath, 'pdf') != false){
                                        $fpath=$pdf;
                                        ?>
                                         <a href="{{$note->filepath}}">
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                         </a>
                                        <?php
                
                                    }else if (strpos($note->filepath, 'mp3') != false ){
                                        
                                        $fpath=$audio;
                                        ?>
                                        <audio controls style="width:200px;" controlsList="nodownload noplaybackrate">
                                           <source src="{{$note->filepath}}" class="form-control">
                                        </audio>
                                        
                                        <?php
                                    }else{
                                        $fpath=$file;
                                        ?>
                                        <input type="hidden" value="{{$note->filepath}}" name="" id="">
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                        <?php
                                    }
                
                                   }
                                ?>
                            </td>


                            <td>
                                <?php
                                if($note->attachment){

                    
                                    if (strpos($note->attachment, 'pdf') == false && strpos($note->attachment, 'mp3') == false )
                                    {
                                        $fpath=$note->attachment;
                                        ?>
                                        <input type="hidden" value="{{$note->attachment}}" name="" id="">
                                         
                                          <a href="{{$note->attachment}}" download>
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                         </a>
                                        <?php
                                    }else if (strpos($note->attachment, 'pdf') != false){
                                        $fpath=$pdf;
                                        ?>
                                         <a href="{{$note->attachment}}" download>
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                         </a>
                                        <?php
                
                                    }else if (strpos($note->attachment, 'mp3') != false ){
                                        
                                        $fpath=$audio;
                                        ?>
                                        
                                        <audio src="{{$note->attachment}}" controls></audio>
                                        <?php
                                    }else{
                                        $fpath=$file;
                                        ?>
                                        <input type="hidden" value="{{$note->attachment}}" name="" id="">
                                         <img src="{{$fpath}}" class="card-img-top" alt="...">
                                        <?php
                                    }
                
                                   }
                                
                                ?>
                            </td>
                        </tr>
                    </table> 
                </div>
                @if($note->doctor_id == auth()->user()->id)
                <div id="action_btn_div{{$note->id}}" class="action_btn_div ">
                    
                    <span onclick="deleteFunction({{$note->id}},'/doctor/patient-notes/{{$note->id}}')" class="action_btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> 

                </div>
                @endif
                
            </div>
            <!--- message box ending --->
            
        </div>
        @endforeach
        </div>

    <div class="messages">
        <form action="/doctor/send-note" method="post" enctype="multipart/form-data">
            @csrf
        <!--- textarea ---> 
        <div class="textarea-container mt-4">
            <textarea name="message" id="message_text" class="form-control" rows="5" placeholder="Write your message here..."></textarea>
        </div>
        <!--- ending textarea --->
        
        <!-- ///////  Notes -->
        <input type="file" name="file" id="" accept="image/*,.pdf,audio/*" class="form-control mt-2">
        <input type="hidden" name="order_id" value="{{$data->id}}" id="">
        <input type="hidden" name="user_id" value="{{$data->user_id}}" id="">
        <input type="hidden" name="attachment" value="" id="attachment_path">
        <input type="submit" class="btn btn-primary mt-2 mb-2" value="Save Note">
        <button data-bs-toggle="modal" data-bs-target="#noteModal" class="btn btn-outline-warning mt-2 mb-2" type="button" id="button-addon2">Attach File</button>
        </form>
        <!-- ///////  Notes end -->
    
    </div>

</div>



<!-- Modal -->
<div class="modal fade" id="editMsgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/doctor/updatemessage" method="POST">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Message</h5>
                <button style="color:black" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> X </svg>
                </button>
            </div>
            <div class="modal-body">
                
                <textarea name="message" id="update_message_text" class="form-control" rows="5" placeholder="Write your message here..."></textarea>
                <input type="hidden" value="" name="message_id" id="message_id">

            </div>
            <div class="modal-footer">
                <button class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
    </div>
</div>





<!-- ////////////////////////////////////   Note Modal -->

<div class="modal modal-lg fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save Note</h5>
                <button style="color:black" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> X </svg>
                </button>
            </div>
            <div class="modal-body">


            <div class="simple-pill">

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-icon-tab" data-bs-toggle="pill" data-bs-target="#pills-home-icon" type="button" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Gallery
            </button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-icon-tab" data-bs-toggle="pill" data-bs-target="#pills-profile-icon" type="button" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Upload
            </button>
        </li> -->
        
    </ul>
    <div class="tab-content" id="pills-tabContent">



         <!-- ////////////////  galllery  -->
        <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-icon-tab" tabindex="0">
        <div class="row">
            <?php
            $images=App\Http\Controllers\GalleryController::getimages();
            ?>
            
           
            @foreach($images as $image)
             <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card style-2 mb-md-0 mb-4" id="selection_{{$image->id}}" onclick="selectImage({{$image->id}})">
                
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
                     <input type="hidden" value="{{$image->filepath}}" name="" id="selection_path_{{$image->id}}">
                     <img src="{{$fpath}}" class="" alt="...">
                      <p>

                     <?php
                     
                     $parts = explode("_", $image->filename);
                     $filenameOnly = end($parts);
                     echo $filenameOnly; // Output: HANGOVER.mp3
                     ?>
                     </p>

                 </div>
            </div>
           
            @endforeach
            <input type="hidden" name="" id="selected_path">
            <input type="hidden" name="" id="selected_id">

        </div> 
        </div>





        <!-- ///////////Upload File  -->
        <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-icon-tab" tabindex="0">
            <div class="row layout-top-spacing">
        <form action="/gallery" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-4">
               <div class="col-12 text-center myborder2">
                             
                        
                <input type="file" name="file" class="form-control" accept="image/*,.pdf,audio/*" >   
                           
		       </div>
               <div class="col-lg-3 col-md-3 col-sm-3 mb-4">
               
                
            <input type="submit" value="Upload" class="btn btn-success">
              
            </div>
               </div>

        </div>
            
        
        </div>

        </div>
        
    </div>

</div>
                
                

            </div>
            <div class="modal-footer">
                <button onclick="discardImage()" class="btn btn btn-light-dark" data-bs-dismiss="modal" type="button"><i class="flaticon-cancel-12"></i> Discard</button>
                <button onclick="doneImage()" class="btn btn btn-light-success" data-bs-dismiss="modal" type="button">Done</button>
               
            </div>
        </div>
        </form>
    </div>
</div>