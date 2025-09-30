<?php

class PaymentController {
    
    private function processOrder($paymentMethod) {
        if (!empty($_POST)) {
            $order = [
                'id' => 0,
                'customer' => escape($_POST['name']),
                'province' => escape($_POST['province']),
                'address' => escape($_POST['address']),
                'phone' => escape($_POST['phone']),
                'cart_total' => $_POST['cart_total'],
                'createtime' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                'message' => escape($_POST['message']),
                'user_id' => intval($_POST['user_id']),
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending'
            ];
            
            $orderId = save('orders', $order);
            
            $cart = cart_list();
            foreach ($cart as $product) {
                $orderDetail = [
                    'id' => 0,
                    'order_id' => $orderId,
                    'product_id' => $product['id'],
                    'quantity' => $product['number'],
                    'price' => $product['price'],
                ];
                save('order_detail', $orderDetail);
            }
            
            return $orderId;
        }
        return false;
    }

    public function momo() {
        $amount = isset($_GET['amount']) ? intval($_GET['amount']) : 0;
        
        // TODO: Replace with actual MoMo API credentials
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMOXXX";
        $accessKey = "xxx";
        $secretKey = "xxx";
        $orderInfo = "Payment for Sierra Shop Order";
        $redirectUrl = PATH_URL . "payment/callback/momo";
        $ipnUrl = PATH_URL . "payment/ipn/momo";
        $requestId = time() . "";
        $requestType = "captureWallet";
        $extraData = "";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $requestId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $requestId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'requestType' => $requestType,
            'extraData' => $extraData,
            'signature' => $signature
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit;
        } else {
            echo "Error creating MoMo payment";
        }
    }

    public function vnpay() {
        $amount = isset($_GET['amount']) ? intval($_GET['amount']) : 0;
        
        // TODO: Replace with actual VNPay API credentials
        $vnp_TmnCode = "VNPXXX";
        $vnp_HashSecret = "xxx";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = PATH_URL . "payment/callback/vnpay";

        $vnp_TxnRef = time();
        $vnp_OrderInfo = "Payment for Sierra Shop Order";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $amount * 100;
        $vnp_Locale = "vn";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        header('Location: ' . $vnp_Url);
        exit;
    }

    public function callback($provider) {
        switch($provider) {
            case 'momo':
                $this->momoCallback();
                break;
            case 'vnpay':
                $this->vnpayCallback();
                break;
            default:
                header('Location: ' . PATH_URL . 'cart/error');
                exit;
        }
    }

    private function momoCallback() {
        if (isset($_GET['resultCode']) && $_GET['resultCode'] == '0') {
            // Payment successful
            $orderId = $_GET['orderId'];
            // Update order payment status
            $this->updatePaymentStatus($orderId, 'completed', 'momo');
            header('Location: ' . PATH_URL . 'cart/success');
        } else {
            header('Location: ' . PATH_URL . 'cart/error');
        }
        exit;
    }

    private function vnpayCallback() {
        if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
            // Payment successful
            $orderId = $_GET['vnp_TxnRef'];
            // Update order payment status
            $this->updatePaymentStatus($orderId, 'completed', 'vnpay');
            header('Location: ' . PATH_URL . 'cart/success');
        } else {
            header('Location: ' . PATH_URL . 'cart/error');
        }
        exit;
    }

    private function updatePaymentStatus($orderId, $status, $method) {
        $order = [
            'payment_status' => $status,
            'payment_method' => $method,
            'payment_time' => gmdate('Y-m-d H:i:s', time() + 7 * 3600)
        ];
        update('orders', $orderId, $order);
    }

    private function execPostRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
