@if ($sortField !== $field)
    <i class="fa fa-sort text-primary"></i>
@elseif ($sortAsc)
    <i class="fa fa-sort-asc text-primary"></i>
@else
    <i class="fa fa-sort-desc text-primary"></i>
@endif
