<ul class="d-flex w-100 list-unstyled justify-content-center fixed-bottom mb-0">
  @foreach ($share as $key => $value)
  <a href="{{ $value }}" target="_blank" class="text-decoration-none text-white w-100
  @switch($key)
      @case('facebook')
          bg-primary
          @break
  
      @case('whatsapp')
          bg-success
          @break
        
      @case('twitter')
          bg-info
          @break
  
      @case('telegram')
          bg-telegram
          @break
  @endswitch
  ">
    <li class="py-1 text-center fs-4">
      <i class="bi bi-{{ $key }}"></i>
    </li>
  </a>
  @endforeach
</ul>