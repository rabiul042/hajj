@extends('admin.layouts.app')

@section('content')

    <div id="main" role="main">
        <div id="ribbon">
				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>
                <ol class="breadcrumb">
                    <li>Home</li><li>Edit Package</li>
                </ol>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-edit fa-fw "></i>
                        Edit Package
                    </h1>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="allert-message alert-success-message pgray  alert-lg" role="alert">
                    <p class=""> {{ Session::get('message') }}</p>
                </div>
            @endif


            <!-- widget grid -->
            <section id="widget-grid" class="">

                    <article class="">
                        <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Edit Package </h2>
                            </header>
                            <div>
                                <div class="widget-body">
                                    {!! Form::open(['action'=>['Admin\PackageController@update',$package->id],'method'=>'PUT','files'=>true]) !!}
                                    <div class="row">
                                        <div class="col-md-8">


                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" value="{{$package->title}}" required name="title">
                                            </div>

                                            <div class="form-group field_wrapper">
                                                <label>Features</label>
                                                @php $feature = unserialize($package->features) @endphp
                                                @for($i=0;$i<count($feature);$i++)
                                                    <div class="fields">
                                                        <div class="col-md-11">
                                                            <input type="text" required class="form-control" value="{{$feature[$i]}}"  name="feature[]"/>
                                                        </div>
                                                        @if($i==0)
                                                            <a href="javascript:void(0);" class="add_button" title="Remove field"><i class="fa fa-plus"></i></a>
                                                        @else
                                                            <a href="javascript:void(0);" class="remove_button" title="Add field"><i class="fa fa-minus"></i></a>
                                                        @endif
                                                    </div>
                                                @endfor
                                            </div>

                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" value="{{  $package->price }}" class="form-control" required name="price">
                                            </div>

                                            <div class="form-group ckeditor">
                                                <label>Description</label>
                                                <textarea class="editor"  rows="20" name="detail" class="custom-scroll form-control">{{ $package->detail }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Packege Type</label>
                                                {!! Form::select('package_type', ['Hajj' => 'Hajj','Umrah' => 'Umrah'], $package->package_type,['class'=>'form-control']) !!}<i></i>
                                            </div>



                                            <div class="form-group">
                                                <label>Status</label>
                                                {!! Form::select('status', ['Active' => 'Active','InActive' => 'InActive'], $package->status,['class'=>'form-control']) !!}<i></i>
                                            </div>



                                        </div>

                                        <div class="col-md-4">


                                            <div class="form-group">
                                                <img id="holder_image" src="{{asset($package->image)}}" style="margin-top:15px;margin-bottom:5px;max-width:100%;">
                                                @php $file_array = explode('/',$package->image); @endphp
                                                <p class="image_name">{{end($file_array)}}</p>
                                                <div class="input-group">
                                                      <span class="input-group-btn">
                                                        <a  data-input="thumbnail_image" data-preview="holder_image" style="width: 100%" class="lfm btn btn-primary">
                                                          <i class="fa fa-picture-o"></i> {{($package->image)?'Change Image':'Choose Image'}}
                                                        </a>
                                                      </span>
                                                    <input id="thumbnail_image" class="form-control" type="hidden" value="{{$package->image}}" name="image">
                                                </div>
                                            </div>

                                        </div>



                                    </div>
                                        <footer>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a  class="btn btn-default" href="{{url('admin/package')}}">Back</a>
                                        </footer>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </article>

            </section>



        </div>


    </div>
@endsection

@section('js')


    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script type="text/javascript">


        $(document).ready(function() {


            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div  class="fields"> <div class="col-md-11">\n' +
                '                                            <input type="text" required class="form-control" name="feature[]" value=""/>\n' +
                '                                        </div><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });


            var editor_config ={
                path_absolute : "/",
                selector: "textarea.editor",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern",
                    "textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };
            tinymce.init(editor_config);

            $.fn.filemanager_image = function(type, options) {
                type = type || 'file';

                this.on('click', function(e) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    localStorage.setItem('target_input', $(this).data('input'));
                    localStorage.setItem('target_preview', $(this).data('preview'));
                    window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (url, file_path) {
                        //set the value of the desired input to image url
                        var target_input = $('#' + localStorage.getItem('target_input'));
                        target_input.val(file_path).trigger('change');

                        // view file name
                        file_path_arr = file_path.split('/');
                        file_name = file_path_arr[file_path_arr.length-1];
                        $('.image_name').text(file_name).trigger('change');

                        //set or change the preview image src
                        var target_preview = $('#' + localStorage.getItem('target_preview'));
                        target_preview.attr('src', url).trigger('change');
                    };
                    return false;
                });
            }

            $('.lfm').filemanager_image('image');

            $('.ckeditor').show();
            $('iframe').css('height','300px');



        })
    </script>

@endsection