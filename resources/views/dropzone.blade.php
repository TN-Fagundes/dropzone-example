<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dropzone File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

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

                            {{-- <button class="btn btn-primary" type="button" id="submit-button">Enviar</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"
        integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.options.imageUpload = {
            maxFiles: null, // Define como null para permitir um número ilimitado de arquivos            
            addRemoveLinks: true, // Habilita os links de remoção
            dictDefaultMessage: 'Arraste e solte os arquivos aqui ou clique para fazer o upload',
            dictInvalidFileType: 'Este tipo de arquivo não é permitido.',
            init: function() {
                var myDropzone = this;

                // Configura a ação a ser executada após o envio dos arquivos
                this.on('complete', function(file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        // Aqui você pode realizar alguma ação após o envio de todos os arquivos
                    }
                });

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Defina o cabeçalho X-CSRF-TOKEN em todas as solicitações Ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                // Função para excluir o arquivo usando Ajax
                function deleteFile(fileName) {
                    $.ajax({
                        url: '/dropzone', // Substitua pela URL da sua rota para exclusão do arquivo
                        type: 'DELETE',
                        data: {
                            file_name: fileName
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

                // Configura o evento de clique para cada link de remoção
                this.on("removedfile", function(file) {
                    // Remove o arquivo do "dropzone" quando o link de remoção é clicado
                    deleteFile(file.name);
                });
            }
        };
    </script>



</body>

</html>
