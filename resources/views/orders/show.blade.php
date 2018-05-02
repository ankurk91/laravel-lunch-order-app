@extends('_layouts.app')

@section('pageTitle','View order')

@section('content')

  @component('components.breadcrumb',[
        'links' => [
          'orders' => route('orders.index')
        ]
      ])
    View order
  @endcomponent

  @include('alert::bootstrap')

  <div class="row">
    <aside class="col-md-4">
      <div class="card mb-4">
        <div class="card-body text-center">
          @switch($order->status)
            @case('pending')
            <i class="fas fa-8x fa-exclamation-circle text-muted"></i>
            @break
            @case('completed')
            <i class="fas fa-8x fa-check-circle text-success"></i>
            @break
            @case('cancelled')
            <i class="fas fa-8x fa-times-circle text-danger"></i>
            @break
            @default
            <i class="fas fa-8x fa-question-circle"></i>
          @endswitch
          <p class="my-3 h5 text-capitalize">Status - {{$order->status}}</p>
          <p class="my-2">For day - @date($order->for_date)</p>
          <p class="my-2">Created at - @datetime($order->created_at)</p>
          <p class="my-2 text-truncate">Created by - {{$order->createdByUser->email}}</p>
        </div>
      </div>
    </aside>

    <section class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Order details</h5>

          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Unit price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
              </thead>
              <tbody>
              @foreach($order->orderProducts as $item)
                <tr>
                  <th scope="row">{{$loop->iteration}}</th>
                  <td>{{$item->product->name}}</td>
                  <td>{{money($item->unit_price)}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{money($item->total)}}</td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <td colspan="4" class="text-right">Grand total</td>
                <td><b>{{money($order->total)}}</b></td>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">Order notes</h5>
          {{$order->customer_notes ?? 'NA'}}
        </div>
      </div>
    </section>
  </div>

@endsection
