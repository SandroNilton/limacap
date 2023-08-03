<div class="h-screen w-full overflow-hidden flex flex-nowrap text-center" id="slider">
    <div class="slider flex-none bg-cover h-full w-full flex-col items-center justify-center" lazy style="background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.1&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe')">
    </div>
  </div>

  @push('css')
    <style>
      .slider {
        animation: animate 16s infinite;
      }
      @keyframes animate {
        10% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.2&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        20% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.3&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        30% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.4&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        40% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.5&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        50% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.6&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        60% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.7&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        70% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.8&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        80% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.9&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        90% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.10&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
        100% {
          background-image: url('https://mail.google.com/mail/u/0?ui=2&ik=6926fdcb78&attid=0.12&permmsgid=msg-f:1770633730702637580&th=18928dff31dafa0c&view=att&disp=safe');
          background-size: cover;
        }
      }
    </style>
  @endpush
