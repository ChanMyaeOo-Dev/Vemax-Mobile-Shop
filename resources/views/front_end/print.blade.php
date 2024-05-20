<div>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ public_path() . '/storage/logo.png' }}
                        <img src="{{ public_path() . '/storage/logo.png' }}" alt="">
                        <p>{{ $order->product->title }}</p>
                        <p>
                            {{ $order->product->price . ' MMK x ' . $order->qty }}
                        </p>
                    </td>

                    <td>
                        {{ $order->product->price * $order->qty . ' MMK' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
