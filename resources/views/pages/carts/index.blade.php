<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table" id="cartTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Your table body content will be filled by DataTables -->
            </tbody>
        </table>

        <div class="text-end mt-3">
            <h5>Total Price: <span id="totalPrice">Rp0</span></h5>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cartTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('carts.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'product.nama_products',
                        name: 'product.nama_products'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'product.price',
                        name: 'product.price'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return 'Rp' + (row.product.price * row.amount).toLocaleString();
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<form action="{{ route('carts.destroy', '') }}/' + row.id +
                                '" method="POST">' +
                                '@csrf' +
                                '@method('DELETE')' +
                                '<button type="submit" class="btn btn-danger btn-sm">Remove</button>' +
                                '</form>';
                        }
                    }
                ],
                drawCallback: function() {
                    // Calculate and display total price
                    var table = $('#cartTable').DataTable();
                    var totalPrice = table.column(4).data().reduce(function(acc, val) {
                        // Access product price and quantity directly from the object
                        var productPrice = parseFloat(val.product.price) || 0;
                        var quantity = parseInt(val.amount, 10) || 0;

                        // Calculate total price for each row
                        var rowTotal = productPrice * quantity;

                        // Add the row total to the accumulator
                        acc += rowTotal;

                        return acc;
                    }, 0);

                    $('#totalPrice').text('Rp' + totalPrice.toLocaleString());
                }
            });
        });
    </script>
</body>

</html>
