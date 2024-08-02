@php
    $startDate = request()->input('startDate', null);
    $endDate = request()->input('endDate', null);
    $type = request()->input('type', null);
@endphp
<div class="input-group mb-3">
    <input type="date" class="form-control " name="startDate" value="{{ $startDate }}" />
    <span class="input-group-text">s/d</span>
    <input type="date" class="form-control " name="endDate" value="{{ $endDate }}" />
    <select name="type" id="type">
        <option value="all">All</option>
        <option {{ request('type') == 'masuk' ? 'selected' : '' }} value="masuk">Masuk</option>
        <option {{ request('type') == 'keluar' ? 'selected' : '' }} value="keluar">Keluar</option>
    </select>
    <input type="submit" value="Filter" class="btn btn-secondary">
    @if (request()->has('startDate'))
        <a href="{{ route(Route::currentRouteName()) }}" class="btn btn-danger">&times;</a>
        <a href="{{ route(Route::currentRouteName())."/print?startDate=$startDate&endDate=$endDate&type=$type" }}" target="_blank" class="btn btn-secondary"><i class="fa fa-print"></i></a>
    @endif
</div>
