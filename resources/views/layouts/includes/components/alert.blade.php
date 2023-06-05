@if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span><br>
                            @endforeach
                    </div>
                    <script>
                        $(document).ready(function(){
                            Snackbar.show({text: 'An Error Occured. Please check errors above form.', actionTextColor: '#fff', backgroundColor: '#e7515a'});
                        });
                    </script>
                @endif

                @if (session('success'))
                    <script>
                        $(document).ready(function(){
                            Snackbar.show({text: 'Success!', actionTextColor: '#fff', backgroundColor: '#00ab55'});
                        });
                    </script>
                @endif
                            
                @if(isset($_GET['payment']))
                    <script>
                        $(document).ready(function(){
                            Snackbar.show({text: 'Success!', actionTextColor: '#fff', backgroundColor: '#00ab55'});
                        });
                    </script>
                @endif