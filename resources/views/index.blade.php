<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="icon" href="{{ asset('img/logosenavv.png?v=1') }}" type="image/png" >
    <title>CONTROL FESTO</title>

</head>
<body>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="10000" data-bs-ride="carousel">

        <div class="carousel-inner" style="text-align: justify;">
            <div class="carousel-item active" style="background-color: #39a900">
                <div class="d-flex h-100" >
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-lg-6 d-flex flex-column justify-content-center" style="background-color: #39a900">
                    <h4 class=" fw-semibold">El servicio nacional de aprendizaje (SENA) ofrece una formación que abarca conocimientos 
                        teóricos y prácticos en diversos campos, permitiendo a los aprendices desarrollar habilidades sólidas para 
                        desempeñarse en el mercado laboral.</h4>

                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card d-flex justify-content-center align-items-center p-4">
                    <div class="card image-transition card-1" style="height: 100%; border-radius: 15px; background: url('img/crspl/sena1.jpeg') no-repeat center center; background-size: cover;">
                    <div class="card-body position-relative bottom-0 start-0">
                                <h5 class="card-title mb-2 fw-bold" style="color: white;">Formación profesional integral</h5>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="color: white; opacity: 10;">
                                    <i class="fas fa-circle-arrow-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item carousel bg-white">
                <div class="d-flex h-100">
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-lg-6 d-flex flex-column justify-content-center" style="background-color: white">
                    <h4 class=" fw-semibold" id="text" style="color: #39a900">El ambiente de FESTO es un sector especializado de la industria que se especializa 
                    en las áreas de electricidad, automatización industrial, hidráulica y neumática.</h4>

                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card  d-flex justify-content-center align-items-center p-4">
                    <div class="card image-transition card-2" style="height: 100%; border-radius: 15px; background: url('img/crspl/sena2.jpeg') no-repeat center center; background-size: cover;">
                    <div class="card-body position-relative bottom-0 start-0 ">
                               <h5 class="card-title mb-2 fw-bold" style="color: white;">Especializado en automatización</h5>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="color: white;   opacity: 10;">
                                        <i class="fas fa-circle-arrow-right" aria-hidden="true"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" style="background-color: #39a900">
                <div class="d-flex h-100">
                    <!-- Columna izquierda: texto y botones -->
                    <div class="carousel-text col-lg-6 d-flex flex-column justify-content-center " style="background-color: #39a900;">
                        <h4 class=" fw-semibold">El SENA es una institución pública de Colombia que ofrece educación gratuita a través de programas técnicos, tecnológicos y complementarios. Está adscrito al Ministerio de Trabajo de Colombia y goza de autonomía administrativa.
                </h4>

                    </div>
                    <!-- Columna derecha: card -->
                    <div class="carousel-card  d-flex justify-content-center align-items-center p-4">
                    <div class="card image-transition card-3" style="height: 100%; border-radius: 15px; background: url('img/crspl/sena3.jpg') no-repeat center center; background-size: cover;">
                    <div class="card-body position-relative bottom-0 start-0 ">
                               <h5 class="card-title mb-2 fw-bold" style="color: white;">Educación gratuita</h5>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="color: white;   opacity: 10;">
                                        <i class="fas fa-circle-arrow-right" aria-hidden="true"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item carousel bg-white">
                <div class="d-flex h-100">
                    <div class="carousel-text col-lg-6 d-flex flex-column justify-content-center" style="background-color: white">
                        <h4 class="fw-semibold" id="text" style="color: #39a900">La certificación internacional otorgada por Festo tiene alcance para 66 países ubicados en Europa y América...</h4>
                    </div>
                    <div class="carousel-card d-flex justify-content-center align-items-center p-4">
                        <div class="card image-transition card-4" style="height: 100%; border-radius: 15px; background: url('img/crspl/sena4.jpg') no-repeat center center; background-size: cover;">
                            <div class="card-body position-relative bottom-0 start-0">
                                <h5 class="card-title mb-2 fw-bold" style="color: white;">Preparación técnica</h5>
                                <a href="/home" class="carousel-control-next text-decoration-none" role="button" style="color: white; opacity: 10;">
                                    <i class="fas fa-circle-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <button class="btn btn-light fw-semibold px-4" type="button"> 
            <a href="/home" class="text-decoration-none" style="color: gray;">Omitir</a>
        </button>        
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const cardsConfig = {
        'card-1': [
            'img/crspl/sena1.jpeg',
            'img/crspl/1.1.jpg',
            'img/crspl/1.2.jpg'
        ],
        'card-2': [
            'img/crspl/sena2.jpeg',
            'img/crspl/2.1.jpg',
            'img/crspl/2.2.jpg'
        ],
        'card-3': [
            'img/crspl/sena3.jpeg',
            'img/crspl/3.1.jpg',
            'img/crspl/3.2.jpg'
        ],
        'card-4': [
            'img/crspl/sena4.jpeg',
            'img/crspl/4.1.jpg',
            'img/crspl/4.2.jpg'
        ]
    };

    Object.keys(cardsConfig).forEach(cardClass => {
        const cardElement = document.querySelector(`.${cardClass}`);
        const images = cardsConfig[cardClass];
        let currentIndex = 0;

        if (cardElement) {
            // Configura la primera imagen
            cardElement.style.setProperty('--current-image', `url('${images[currentIndex]}')`);

            setInterval(() => {
                // Calcula el índice de la siguiente imagen
                const nextIndex = (currentIndex + 1) % images.length;

                // Actualiza las imágenes de transición
                cardElement.style.setProperty('--next-image', `url('${images[nextIndex]}')`);
                cardElement.classList.add('fade-in');

                // Después de la transición, actualiza la imagen actual y prepara la siguiente
                setTimeout(() => {
                    cardElement.classList.remove('fade-in');
                    cardElement.style.setProperty('--current-image', `url('${images[nextIndex]}')`);
                    currentIndex = nextIndex; // Actualiza el índice actual
                }, 1000); // Tiempo de la transición en CSS (1s)
            }, 5000); // Cambia cada 5 segundos
        }
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const carouselElement = document.querySelector('#carouselExampleIndicators');
    const carouselItems = carouselElement.querySelectorAll('.carousel-item');
    const targetIndex = 3; // Índice del cuarto elemento (0-based index)

    let currentIndex = 0;

    const interval = setInterval(() => {
        currentIndex++;

        if (currentIndex < targetIndex + 1) {
            // Avanzar al siguiente slide
            $(carouselElement).carousel('next');
        } else {
            // Redirigir cuando llegue al cuarto elemento
            clearInterval(interval); // Detener el intervalo
            window.location.href = '/home';
        }
    }, 7000); // Cambiar slide cada 5 segundos
});





</script>

<style>
.image-transition {
    position: relative;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    overflow: hidden; /* Evita que las imágenes se desborden */
}

.image-transition::before, .image-transition::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: opacity 2s ease-in-out;
}

.image-transition::before {
    background-image: var(--current-image);
    opacity: 1; /* Imagen activa */
}

.image-transition::after {
    background-image: var(--next-image);
    opacity: 0; /* Imagen de transición */
}

.image-transition.fade-in::before {
    opacity: 0; /* Oculta la imagen actual */
}

.image-transition.fade-in::after {
    opacity: 1; /* Muestra la siguiente imagen */
}

</style>
</body>
</html>
