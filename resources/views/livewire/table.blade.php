<h2>@lang('page.title')</h2>
<div>
    <div class="row my-3">
        <div class="col-5 d-flex">
            <span class="input-group-text d-inline-block align-self-center" >@lang('page.created_date')</span>
            <input wire:model="dateStart" class="date form-control" type="date" >
            <input wire:model="dateEnd" class="date form-control" type="date" >
        </div>
        <div class="col input-group">
            <span class="input-group-text" >@lang('page.voucher')#</span>
            <input wire:model="voucher"  class='form-control' type="text">
        </div>
        <div class="col input-group">
            <span class="input-group-text" >@lang('page.account')</span>
            <input wire:model="account" class='form-control' type="text">
        </div>
        <div class="col-4 m-2">
            <span class="input-group-text d-inline-block" >Brand</span>
            <select wire:model="brand" class="w-50 d-inline-block form-select" placeholder="Menu">
                <option value="">@lang('page.select')</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <button wire:click="search" class="btn btn-primary">@lang('page.btn_filter')</button>
            <button wire:click.prevent="export" class="btn btn-success">@lang('page.btn_export')</button>
            <button wire:click="clear" class="btn btn-danger">@lang('page.btn_delete_filter')</button>
        </div>
    </div>

    <table class="table table-primary table-striped table-hover">
        <thead class="bg-light ">
            <th>@lang('page.voucher')#</th>
            <th>@lang('page.cba')</th>
            <th>@lang('page.brand')</th>
            <th>@lang('page.account_name')</th>
            <th>@lang('page.voucher_status')</th>
            <th>@lang('page.customer_last_name')</th>
            <th>@lang('page.confirmation')</th>
            <th>@lang('page.issue_iata')</th>
            <th>@lang('page.groos_amount')</th>

        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
                <tr class="">
                    <td class="">{{$voucher->voucher}}</td>
                    <td class="">{{$voucher->cba}}</td>
                    <td class="">{{$voucher->brand}}</td>
                    <td class="">{{$voucher->account_name}}</td>
                    <td class="">{{$voucher->voucher_status}}</td>
                    <td class="">{{$voucher->customer_last_name}}</td>
                    <td class="">{{$voucher->confirmation}}</td>
                    <td class="">{{$voucher->issue_iata}}</td>
                    <td class="">{{$voucher->gross_amount}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
    @if( $vouchers->count())
        <div>
            {!! $vouchers->links() !!}
        </div>
    @else
        <div class="bg-white px-4 py-3 border-t border-warning">
            <h4>No hay resultados para la busqueda</h4>
        </div>
    @endif
</div>

