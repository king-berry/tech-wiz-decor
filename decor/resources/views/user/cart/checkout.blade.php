@extends('layouts.user_main')

@section('content')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <h2 class="h3 mb-3 text-black">Chi tiết đơn hàng</h2>
                </div>
            </div>

            <form method="post" action="{{ route('cart.placeOrder') }}">
                @csrf
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $details)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}"
                                            class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $details['name'] }}</h2>
                                    </td>
                                    <td>${{ $details['price'] }}</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td>${{ $details['price'] * $details['quantity'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mã giảm giá -->
                <div class="row">
                    <div class="col-md-6">
                        <br>
                        <br>
                        <!-- Địa chỉ giao hàng -->
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="text-black h4" for="address_id">Địa chỉ giao hàng</label>
                                <div id="selected-address">
                                    @php
                                        $defaultAddress = $savedAddresses->firstWhere('default', 1);
                                    @endphp

                                    @if ($defaultAddress)
                                        
                                        {{ $defaultAddress->address }} - {{ $defaultAddress->ward->name }},
                                        {{ $defaultAddress->ward->district->name }},
                                        {{ $defaultAddress->ward->district->province->name }}
                                    @else
                                        <p>Chưa chọn địa chỉ giao hàng.</p>
                                    @endif
                                    <br>
                                    <button type="button"  class="btn btn-primary mt-2" id="change-address-btn">Chọn địa chỉ
                                        khác</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="address_id" id="address_id"
                            value="{{ old('address_id', $defaultAddress ? $defaultAddress->id : '') }}">
                            <div class="row mb-5">
                                <label class="text-black h4" for="voucher_code">Mã giảm giá</label>
                                <p>Nhập mã giảm giá nếu bạn có.</p>
                                <input type="text" name="voucher_code" class="form-control py-3" id="voucher_code"
                                value="{{ old('voucher_code') }}" placeholder="Coupon Code">
                            </div>

                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <span id="old-subtotal-price" class="text-muted" style="text-decoration: line-through;">
                                        ${{ array_sum(
                                            array_map(function ($item) {
                                                return $item['price'] * $item['quantity'];
                                            }, $cart),
                                        ) }}
                                    </span>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Discount</span>
                                    </div>
                                    <span id="discount-amount" class="text-success" style="display: none;">
                                        - $0.00
                                    </span>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black" id="subtotal-price">
                                            ${{ array_sum(
                                                array_map(function ($item) {
                                                    return $item['price'] * $item['quantity'];
                                                }, $cart),
                                            ) }}
                                        </strong>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup chọn địa chỉ -->
    <div class="modal" id="address-popup" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chọn Địa Chỉ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($savedAddresses as $address)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="address-text">
                                    {{ $address->address }} - {{ $address->ward->name }},
                                    {{ $address->ward->district->name }},
                                    {{ $address->ward->district->province->name }}
                                </span>
                                <button type="button" class="btn btn-primary btn-sm select-address"
                                    data-id="{{ $address->id }}"
                                    data-address="{{ $address->address }} - {{ $address->ward->name }}, {{ $address->ward->district->name }}, {{ $address->ward->district->province->name }}">
                                    Chọn
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const changeAddressBtn = document.getElementById('change-address-btn');
            const addressPopup = document.getElementById('address-popup');
            const selectedAddress = document.getElementById('selected-address');
            const addressIdInput = document.getElementById('address_id');
            const voucherCodeInput = document.getElementById('voucher_code');
            const subtotalPrice = document.getElementById('subtotal-price');
            const oldSubtotalPrice = document.getElementById('old-subtotal-price');
            const discountAmount = document.getElementById('discount-amount');


            if (changeAddressBtn) {
                changeAddressBtn.addEventListener('click', function() {
                    addressPopup.style.display = 'block';
                });
            }

            if (changeAddressBtn) {
                changeAddressBtn.addEventListener('click', function() {
                    addressPopup.style.display = 'block';
                });
            }

            if (addressPopup) {
                addressPopup.addEventListener('click', function(event) {
                    if (event.target.classList.contains('select-address')) {
                        const addressId = event.target.getAttribute('data-id');
                        const addressText = event.target.getAttribute('data-address');

                        selectedAddress.innerHTML = `
                        <p>${addressText}</p>
                        <button type="button" class="btn btn-primary mt-2" id="change-address-btn">Chọn địa chỉ khác</button>
                    `;
                        addressIdInput.value = addressId;

                        addressPopup.style.display = 'none';

                        document.getElementById('change-address-btn').addEventListener('click', function() {
                        addressPopup.style.display = 'block';
                    });
                    }
                });
            }

            document.querySelector('.close').addEventListener('click', function() {
                addressPopup.style.display = 'none';
            });
            if (voucherCodeInput) {
                voucherCodeInput.addEventListener('input', function() {
                    const voucherCode = voucherCodeInput.value;

                    if (voucherCode) {
                        fetch('{{ route('cart.applyCoupon') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    voucher_code: voucherCode
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const originalTotal = parseFloat(oldSubtotalPrice.textContent
                                        .replace('$', ''));
                                    const newTotal = data.new_total;
                                    const discount = originalTotal - newTotal;

                                    subtotalPrice.textContent = `$${newTotal.toFixed(2)}`;
                                    discountAmount.textContent = `- $${discount.toFixed(2)}`;
                                    discountAmount.style.display = 'inline';
                                    oldSubtotalPrice.style.textDecoration = 'line-through';
                                } else {
                                    console.error(data.message);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        const originalTotal =
                            {{ array_sum(
                                array_map(function ($item) {
                                    return $item['price'] * $item['quantity'];
                                }, $cart),
                            ) }};
                        subtotalPrice.textContent = `$${originalTotal.toFixed(2)}`;
                        discountAmount.style.display = 'none';
                        oldSubtotalPrice.style.textDecoration = 'none';
                    }
                });
            }
        });
    </script>
@endsection

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-dialog {
        background: #fff;
        border-radius: 0.375rem;
        width: 80%;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
    }
</style>
