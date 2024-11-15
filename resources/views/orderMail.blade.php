<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: #1CA9E2;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .header h2 {
            margin: 0;
        }
        .details {
            margin: 20px 0;
        }
        .details p {
            margin: 5px 0;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .products-table th, .products-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .products-table th {
            background-color: #1CA9E2;
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            font-size: 14px;
            color: #888;
        }
        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Order Confirmation</h2>
        </div>
        <div class="details">
            <p><strong>Dear {{ auth()->user()->name }},</strong></p>
            <p>Thank you for your order! Here are the details:</p>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Delivery Address:</strong> {{ $order->adresse_livraison }}</p>
            <p><strong>Phone Number:</strong> {{ $order->phone }}</p>
            <p><strong>Total Amount:</strong> {{ number_format($order->montant_total, 2) }} DT</p>
        </div>
         
        <div class="footer">
            <p>We will notify you once your order is shipped.</p>
            <p>Thank you for shopping with us!</p>
        </div>
    </div>
</body>
</html>
