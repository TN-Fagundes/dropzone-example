<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dropzone File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    @isset($success)
    @endisset

    <section style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        Dropzone File Upload
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dropzone.store') }}" enctype="multipart/form-data"
                            class="dropzone dz-clickable" id="image-upload">
                            @csrf
                            <div>
                                <h3 class="text-center">Upload Image By Click On Box</h3>
                                <div class="dz-default dz-message"> <span>Drop files here to upload</span> </div>
                            </div>
                            <button type="button" class="btn btn-success" id="ver-fila">Ver Fila</button>
                            {{-- <button type="button" class="btn btn-primary" id="upload-button">Upload Files</button> --}}
                            <button type="submit" class="btn btn-primary">Upload Files</button>
                            <input type="text" name="teste">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"
        integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#image-upload", {
            url: "{{ route('dropzone.store') }}",
            autoProcessQueue: false, // Desativa o upload automático ao soltar os arquivos na área de upload
            paramName: "file", // Nome do parâmetro para o arquivo enviado
            maxFilesize: 100, // Tamanho máximo do arquivo em MB
            acceptedFiles: ".jpeg,.jpg,.png", // Tipos de arquivos aceitos
            addRemoveLinks: true, // Adiciona links para remover os arquivos adicionados

            success: function(file, response) {
                console.log(response.success);
            }
        });

        // Manipulador de evento de clique do botão de upload
        document.getElementById("image-upload").addEventListener("submit", function() {
            var form = this;
            var dropzone = Dropzone.forElement("#image-upload");

            if (dropzone.getQueuedFiles().length > 0) {
                event.preventDefault(); // Impede o envio do formulário

                dropzone.on("queuecomplete", function() {
                    form.submit(); // Envia o formulário após o envio dos arquivos
                });

                dropzone.processQueue(); // Inicia o envio dos arquivos
            }
        });

        Dropzone.options.imageUpload = {
            success: function(file, response) {
                if (this.getQueuedFiles().length === 0 && this.getUploadingFiles().length === 0) {
                    this.removeAllFiles(); // Remove todos os arquivos da fila
                }
            }
        };


        document.getElementById("ver-fila").addEventListener("click", function() {
            var myDropzone = Dropzone.forElement("#image-upload");
            var queuedFiles = myDropzone.getQueuedFiles();

            console.log(queuedFiles);
        });
    </script>




</body>

</html>
