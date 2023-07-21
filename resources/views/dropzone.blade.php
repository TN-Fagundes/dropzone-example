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

                            <button class="btn btn-primary" type="button" id="submit-button">Enviar</button>
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
            Dropzone.autoDiscover = false; // Desabilita o autoDiscover para evitar que o Dropzone seja anexado a todos os elementos com a classe 'dropzone'
        
            // Inicializa o Dropzone
            var myDropzone = new Dropzone("#image-upload", {
                url: "{{ route('dropzone.store') }}",
                addRemoveLinks: true, // Habilita os links de remoção
                maxFilesize: 5, // Define o tamanho máximo do arquivo em MB
                acceptedFiles: 'image/*', // Permite apenas o upload de arquivos de imagem
                autoProcessQueue: false, // Desabilita o processamento automático para permitir o gerenciamento manual dos arquivos
                init: function() {
                    var submitButton = document.querySelector('#submit-button');
                    var myDropzone = this;
        
                    // Evento de clique no botão de envio
                    submitButton.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue(); // Inicia o processamento manual dos arquivos na fila
                    });
        
                    // Evento de sucesso do upload
                    this.on('success', function(file) {
                        // Este evento é acionado quando o arquivo foi enviado com sucesso para o servidor
                        // Aqui você pode adicionar a lógica personalizada, se necessário, após o upload bem-sucedido do arquivo.
                        console.log("Arquivo enviado com sucesso: " + file.name);
                    });
        
                    // Evento de remoção de arquivo
                    this.on('removedfile', function(file) {
                        // Este evento é acionado sempre que um arquivo é removido da fila
                        // Aqui você pode adicionar a lógica personalizada, como excluir o arquivo do servidor
        
                        // Para fins de demonstração, apenas registramos o nome do arquivo removido no console.
                        console.log("Arquivo removido: " + file.name);
                    });
                }
            });
        </script>
             


</body>

</html>
