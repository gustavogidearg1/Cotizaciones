
text/x-generic show.blade.php ( HTML document, UTF-8 Unicode text, with CRLF line terminators )
@extends('layouts.app')

@section('title','Cotizacion' . ' ' . $cotizacion->cotizacion)

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-orange {
            background-color: #FF9900 !important;
        }

        .imagen-logo {
            height: 40px;
        }



    body {
        margin: 0;
        font-size: 12pt;
    }

    .card {
        box-shadow: none !important;
    }

    .table td, .table th {
        padding: 4px !important;
    }

.product-thumb{
  width: 42px;
  height: 42px;
  object-fit: cover;
  border-radius: 10px;
  border: 1px solid rgba(0,0,0,.15);
  cursor: pointer;
  transition: transform .2s ease;
}
.product-thumb:hover{
  transform: scale(1.05);
}
.modal-img{
  max-width: 100%;
  height: auto;
}


    </style>

    <div class="container">
        <div class="card">
            <div class="card-header bg-orange text-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <img src="{{ asset('images/Isologotipo con anclaje. Negro CMYK.png') }}" alt="Logo"
                            height="50">
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="mb-0">Lista de costo #{{ $cotizacion->cotizacion }}</h2>
                    </div>
                </div>
            </div>

<div class="row m-2 d-flex justify-content-between align-items-start">
    <div class="col-md-6">
        <p>LISTA DE PRECIO SIN IVA</p>
        <p>EQUIPOS: +IVA 10,5%</p>
        <p>EQUIPOS CON OPCIONALES: +IVA 10,5%</p>
        <p>OPCIONALES SUELTOS: +IVA 21%</p>

    </div>
    <div class="col-md-6 text-end">
        <p><strong>FECHA VIGENCIA:</strong>
            {{ $cotizacion->vencimiento ? \Carbon\Carbon::parse($cotizacion->vencimiento)->format('d/m/Y') : 'N/A' }}
        </p>

        <p><strong>MONEDA:</strong>
    <strong style="color: red">{{ strtoupper($cotizacion->moneda->moneda ?? 'N/A') }}</strong>
</p>

        <p>
            <img src="{{ asset('images/logo-iram-iso.jpg') }}" alt="Logo" height="100">
        </p>
    </div>
</div>




        </div>

        @if ($cotizacion->subCotizaciones && $cotizacion->subCotizaciones->count() > 0)
            <div class="table-responsive mt-3">
@php
  $items = $cotizacion->subCotizaciones
    ->filter(fn($item) => $item->producto);

  // Orden global:
  // 1) Tipo por ID
  // 2) Familia por nombre
  // 3) Producto por nombre
  $items = $items->sort(function($a, $b) {
      $ta = (int)($a->producto->tipo->id ?? 0);
      $tb = (int)($b->producto->tipo->id ?? 0);
      if ($ta !== $tb) return $ta <=> $tb;

      $fa = (string)($a->producto->familia->nombre ?? 'Sin familia');
      $fb = (string)($b->producto->familia->nombre ?? 'Sin familia');
      $c1 = strcasecmp($fa, $fb);
      if ($c1 !== 0) return $c1;

      $pa = (string)($a->producto->nombre ?? '');
      $pb = (string)($b->producto->nombre ?? '');
      return strcasecmp($pa, $pb);
  });

  // Agrupar por Tipo ID (para poder ordenar por id sin depender del nombre)
  $agrupados = $items
    ->groupBy(fn($i) => (int)($i->producto->tipo->id ?? 0))
    ->sortKeys() // ordena por tipo_id asc
    ->map(function($grupoTipo){
        return $grupoTipo->groupBy(fn($i) => $i->producto->familia->nombre ?? 'Sin familia');
    });
@endphp

@foreach ($agrupados as $tipoId => $familias)
  @php
    // Nombre del tipo desde el primer item del grupo
    $nombreTipo = optional($familias->first()?->first()?->producto?->tipo)->nombre ?? 'Sin tipo';
  @endphp

  <div class="card mt-4">
    <div class="card-header bg-orange text-white">
      <h2 class="mb-0">{{ $nombreTipo }}</h2>
    </div>

    {{-- Familias por ABC --}}
    @foreach ($familias->sortKeysUsing(fn($a,$b) => strcasecmp($a,$b)) as $nombreFamilia => $subCotizaciones)
      <div class="card-header bg-white border-bottom">
        <h3 class="mb-0"><strong>{{ $nombreFamilia }}</strong></h3>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th style="width:60px;">Img</th>
              <th style="width:110px;">Código</th>
              <th>Producto</th>
              <th style="width:90px;">Moneda</th>
              <th style="width:140px;">Precio</th>
            </tr>
          </thead>
          <tbody>
            {{-- Productos por ABC dentro de la familia --}}
            @foreach ($subCotizaciones->sortBy(fn($i) => strtolower($i->producto->nombre ?? '')) as $subCotizacion)
              @php
                $p = $subCotizacion->producto;

                // Tomamos la primera imagen disponible como en productos.show
                $imgPath = $p->img ?? $p->img_1 ?? $p->img_2 ?? $p->img_3 ?? null;
                $imgUrl = $imgPath ? asset($imgPath) : null;
              @endphp

              <tr>
                <td class="text-center">
                  @if($imgUrl)
                    <img
  src="{{ $imgUrl }}"
  alt="img"
  class="product-thumb"
  onclick="showImageModal('{{ $imgUrl }}')"
/>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>

                <td>{{ $p->codigo ?? 'N/A' }}</td>

                <td>
                  <strong>{{ $p->nombre ?? 'N/A' }}</strong>

                  {{-- opcional: mostrar detalle de subcotizacion abajo si existe --}}
                  @if(!empty($subCotizacion->detalle))
                    <div class="text-muted small">{{ $subCotizacion->detalle }}</div>
                  @endif
                </td>

                <td>{{ $subCotizacion->moneda->moneda ?? 'N/A' }}</td>

                <td>${{ number_format((float)$subCotizacion->precio, 2, ',', '.') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endforeach
  </div>
@endforeach


            <div class="row m-2">

                <div class="col-md-6">
                    <p><strong>Descripción:</strong> {{ $cotizacion->descripcion }}</p>
                    <p><strong>Observaciones:</strong> {{ $cotizacion->observacion ?? 'N/A' }}</p>

                </div>

                <div class="col-md-6">
                    <p><strong>Creada por:</strong> {{ $cotizacion->user->name ?? 'N/A' }}</p>
                    <p><strong>Fecha creación:</strong> {{ $cotizacion->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>

                </div>


            </div>
            </div>
        @else
            <div class="alert alert-info mt-3">No hay productos asociados a esta cotización</div>
        @endif

        <div class="mt-4 d-flex gap-2 flex-wrap">
            <a href="{{ route('cotizaciones.edit', $cotizacion->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="#" onclick="printCotizacion()" class="btn btn-info">
                <i class="fas fa-print"></i> Imprimir Cotización
            </a>
        </div>
    </div>

    <script>
        function printCotizacion() {
            const header = document.querySelector('header');
            const nav = document.querySelector('nav');
            const footer = document.querySelector('footer');
            const buttons = document.querySelectorAll('.btn');

            if (header) header.style.display = 'none';
            if (nav) nav.style.display = 'none';
            if (footer) footer.style.display = 'none';
            buttons.forEach(btn => btn.style.display = 'none');

            window.print();

            setTimeout(() => {
                if (header) header.style.display = '';
                if (nav) nav.style.display = '';
                if (footer) footer.style.display = '';
                buttons.forEach(btn => btn.style.display = '');
            }, 1000);
        }

          function showImageModal(src) {
    const img = document.getElementById('modalImage');
    img.src = src;

    const modalEl = document.getElementById('imageModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
  }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal para mostrar imagen ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="modal-img" alt="Vista ampliada">
      </div>
    </div>
  </div>
</div>


@endsection
