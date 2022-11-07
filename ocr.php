<?php define('URL','http://localhost/Rosheta-project/'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>OCR</title>
  <script src='https://unpkg.com/tesseract.js@v2.1.0/dist/tesseract.min.js'></script>
  <link rel="stylesheet" href="content/css/vendors/all.css">
  <style>
    body{
        text-align: center;
        padding: 20px;
        background-color: honeydew;
    }
    input{
        margin-bottom: 2%;
        margin-left: 10%;
    }
    #myImg{
        max-width: 25%;
        max-height: 25%;
        margin-bottom: 2%;
    }
    textarea{
        text-align: center;
        resize: none;
        max-width: 50%;
    }
    .logout_ocr{
        position: absolute;
        top: 20px;
        left: 20px;
        font-size:25px;
    }



  </style>
</head>

<body>
    <div class="logout_ocr">
        <a href="<?php echo URL ?>pharmacy.php">
            <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
        </a>
    </div>
  <input type='file' />
  <br>
  <img id="myImg" src="">
  <br>
  <textarea id="predect" cols="50" rows="20" wrap="hard" disabled></textarea>
  <!--font js-->
  <script src="content/js/vendors/all.min.js"></script>
</body>
</html>
<script>
window.addEventListener('load', function () {
    document.querySelector('input[type="file"]').addEventListener('change', function () {
        if (this.files && this.files[0]) {
        var img = document.querySelector('img');
        img.onload = () => {
            URL.revokeObjectURL(img.src);
            console.log(URL.revokeObjectURL(img.src))  // no longer needed, free memory
        }

        img.src = URL.createObjectURL(this.files[0]); // set src to blob url
        }
        const reader = new FileReader();
        reader.addEventListener('load', () => {
        Tesseract.recognize(
            reader.result,
            'eng',
            { logger: m => console.log(m) }
        ).then(({ data: { text } }) => {
            console.log(text);
            document.querySelector('textarea').innerHTML = text;
        })

        })
        reader.readAsDataURL(this.files[0]);
    });
});

</script>