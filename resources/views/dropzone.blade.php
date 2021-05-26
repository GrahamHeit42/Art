<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Next and Previous Button</title>
    <link rel="stylesheet" href="">
</head>

<body>

    <img src="{{asset('assets/images/user.png')}}" id="imgDemo" alt="HTML5 Icon" width="128" height="128">

    <button onclick="nxt()" id="btnOne">next</button>
    <button onclick="prvs()" id="btnTwo">previous</button>

    <script>
        var img = new Array("user.png", "profile.png", "logo.png");

        var imgElement = document.getElementById("imgDemo");
        var i = 0;
        var imgLen = img.length;

        function nxt() {
            if (i < imgLen - 1) {
                i++;
            } else {
                i = 0;
            }

            imgElement.src = img[i];
        }

        function prvs() {
            if (i > 0) {
                i--;
            } else {
                i = imgLen - 1;
            }
            imgElement.src = img[i];
        }
    </script>

</body>

</html>
<!-- <!DOCTYPE html>
<html>

<head>
    <title>Drag & Drop File Uploading using Laravel 8 Dropzone JS</title>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Drag & Drop File Uploading using Laravel 8 Dropzone JS</h1>

                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                    @csrf
                    <div>
                        <h3>Upload Multiple Image By Click On Box</h3>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
    </script>

</body>

</html> -->