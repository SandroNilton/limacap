@switch($value)
  @case('natural')
    <a class="text-[13px] py-0.5 bg-[#b81502] rounded-[3px] px-1.5 text-white" title="Natural">
      Natural
    </a>
    @break
  @case('juridico')
    <a class="text-[13px] py-0.5 bg-[#0264b9] rounded-[3px] px-1.5 text-white" title="Jurídica">
      Jurídica
    </a>
    @break
  @case('agremiado')
    <a class="text-[13px] py-0.5 bg-[#c1a13f] rounded-[3px] px-1.5 text-white" title="Agremiada">
      Agremiada
    </a>
    @break
@endswitch
