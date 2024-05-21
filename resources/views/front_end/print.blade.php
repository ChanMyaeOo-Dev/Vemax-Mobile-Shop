<style>
    /* Basic table styling */
    * {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .styled-table {
        border-collapse: collapse;
        /* margin: 25px 0; */
        font-size: 0.9em;
        width: 100%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    /* Table header styling */
    .styled-table thead tr {
        background-color: #343434;
        color: #ffffff;
    }

    /* Table cell padding and border */
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        border: 1px solid #dddddd;
    }

    /* Table row hover effect */
    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    /* Last row styling */
    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #343434;
    }

    .styled-table th {
        text-align: left;
    }

    .currency {
        text-align: right !important;
    }

    .logo {
        width: 100px;
        margin-bottom: -20px;
    }

    .header_box {
        margin-bottom: 40px;
    }

    .header_box .invoice_text {
        font-weight: bold;
        font-size: 2em;
        margin-bottom: -10px;
    }

    .header_box .fade_text {
        color: #606060;
    }

    .header_box .customer-info-text {
        font-weight: 700;
        margin-bottom: -10px;
    }
</style>
<div>
    <div class="header_box">
        <img src="{{ public_path() . '/storage/logo.png' }}" alt="product_image" class="logo">
        <p class="invoice_text">Invoice</p>
        <p class="fade_text">Shipping and billing to:</p>
        <p class="customer-info-text">
            Name :
            {{ $customer_name }}
        </p>

        <p class="customer-info-text">
            Phone :
            {{ $customer_phone }}
        </p>

        <p class="customer-info-text">
            Address :
            {{ $customer_address }}
        </p>
    </div>

    <table width="100%" cellspacing="0" class="styled-table">
        <thead>
            <tr>
                <th>Product</th>
                <th class="currency">Price * Qty</th>
                <th class="currency">Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="product_box">
                        {{-- <img src="{{ public_path() . '/storage/logo.png' }}" alt="product_image" class="product_image"> --}}
                        {{ $order->product->title }}
                    </td>

                    <td class="currency">
                        {{ $order->product->price . ' MMK x ' . $order->qty }}
                    </td>


                    <td class="currency">
                        {{ $order->product->price * $order->qty . ' MMK' }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">Sub-Total</td>
                <td class="currency">{{ $total_cost . ' MMK' }}</td>
            </tr>
            <tr>
                <td colspan="2">Delivery Fee</td>
                <td class="currency">{{ $delivery_fee . ' MMK' }}</td>
            </tr>
            <tr>
                <td colspan="2">Total Cost</td>
                <td class="currency">{{ $all_total . ' MMK' }}</td>
            </tr>
            <tr>
                <td colspan="2">Payment Type</td>
                <td class="currency">COD</td>
            </tr>

        </tbody>
    </table>
</div>
