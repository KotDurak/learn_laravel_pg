@props(['total', 'pageCount'])
@php
$currentPage = request()->get('page', 1);
$perPage = request()->get('per-page', 10);
$currentPath = request()->path();
$startPage = $currentPage - 1;
if ($startPage === 0) {
    $startPage = 1;
}




@endphp
<div class="pagination">
  @for($i = $startPage; $i <= $startPage + 5 && $i <= $pageCount; $i++)
      @php
        $pageUrl = url()->current() . '?page=' . $i . '&per-page=' . $perPage;
      @endphp
        <a href="{{$pageUrl}}">
            {{$i}}
        </a>
  @endfor
</div>
