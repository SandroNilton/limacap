<div class="h-screen w-full overflow-hidden flex flex-nowrap text-center" id="slider">
    <div class="slider flex-none bg-cover h-full w-full flex-col items-center justify-center" lazy style="background-image: url(`../../../../assets/Barranca.jpg`)">
    </div>
  </div>

  @push('css')
    <style>
      .slider {
        animation: animate 13s infinite;
      }
      @keyframes animate {
        10% {
          background-image: url('../../../../assets/Cajatambo.jpg');
          background-size: cover;
        }
        20% {
          background-image: url('../../../../assets/Callao.jpg');
          background-size: cover;
        }
        30% {
          background-image: url('../../../../assets/Canta.jpg');
          background-size: cover;
        }
        40% {
          background-image: url('../../../../assets/Chosica.jpg');
          background-size: cover;
        }
        50% {
          background-image: url('../../../../assets/Huancaya_Yauyos.jpg');
          background-size: cover;
        }
        60% {
          background-image: url('../../../../assets/Huaral.jpg');
          background-size: cover;
        }
        70% {
          background-image: url('../../../../assets/Lunahuana.jpg');
          background-size: cover;
        }
        80% {
          background-image: url('../../../../assets/Matucana.jpg');
          background-size: cover;
        }
        90% {
          background-image: url('../../../../assets/Miraflores.jpg');
          background-size: cover;
        }
        100% {
          background-image: url('../../../../assets/Oyon.jpg');
          background-size: cover;
        }
      }
    </style>
  @endpush
