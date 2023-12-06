<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Comentarios</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <div>
    @if ($procedure->state == 4 || $procedure->state == 5)
    @else
      <form wire:submit.prevent="addComment" class="flex w-full gap-x-2.5 mb-3">
        <x-text-input type="text" wire:model="comment" name="comment" placeholder="Ingrese un mensaje"/>
        <x-primary-button wire:ignore>
          <ion-icon name="checkmark-circle-outline" class="text-lg"></ion-icon>
        </x-primary-button>
      </form>
      <x-input-error :messages="$errors->get('comment')" class="mt-2" />
    @endif
    <hr class="my-4">
    <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px] scroll">
      @forelse ($comments as $comment)
        <div class="flex items-center mb-2 group gap-x-3">
          <div class="flex items-end">
              <div class="flex flex-col space-y-2 max-w-xs mx-2 order-2 items-start">
                <div>
                  <span class="px-4 py-2 rounded-lg rounded-bl-none bg-gray-100 text-[rgb(17,24,39)] grid">
                    <span class="text-xs">{{ $comment->user->name }} - {{ $comment->created_at->format('d/m/Y h:i a') }}</span>
                    <span class="text-sm">{{ $comment->description }}</span>
                  </span>
                </div>
              </div>
              <img src="https://c1.klipartz.com/pngpicture/823/765/sticker-png-login-icon-system-administrator-user-user-profile-icon-design-avatar-face-head.png" alt="My profile" class="w-7 h-7 rounded-full order-1">
          </div>
        </div>
      @empty
        <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
          No hay comentarios
        </div>
      @endforelse
    </div>
  </div>
</div>