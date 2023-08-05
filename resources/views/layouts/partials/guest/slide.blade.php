<div class="h-screen w-full overflow-hidden flex flex-nowrap text-center" id="slider">
    <div class="slider flex-none bg-cover h-full w-full flex-col items-center justify-center" lazy style="background-image: url('{{ asset('images/Barranca.jpg') }}')">
    </div>
  </div>
  @push('css')
    <style>
      .slider {
        animation: animate 45s infinite;
      }
      @keyframes animate {
        10% {
          background-image: url("{{ asset('images/Cajatambo.jpg') }}");
          background-size: cover;
        }
        20% {
          background-image: url("{{ asset('images/Callao.jpg') }}");
          background-size: cover;
        }
        30% {
          background-image: url("{{ asset('images/Canta.jpg') }}");
          background-size: cover;
        }
        40% {
          background-image: url("{{ asset('images/Chosica.jpg') }}");
          background-size: cover;
        }
        50% {
          background-image: url("{{ asset('images/Huancaya_Yauyos.jpg') }}");
          background-size: cover;
        }
        60% {
          background-image: url("{{ asset('images/Huaral.jpg') }}");
          background-size: cover;
        }
        70% {
          background-image: url("{{ asset('images/Lunahuana.jpg') }}");
          background-size: cover;
        }
        80% {
          background-image: url("{{ asset('images/Matucana.jpg') }}");
          background-size: cover;
        }
        90% {
          background-image: url("{{ asset('images/Miraflores.jpg') }}");
          background-size: cover;
        }
        100% {
          background-image: url("{{ asset('images/Oyon.jpg') }}");
          background-size: cover;
        }
      }
    </style>
  @endpush
