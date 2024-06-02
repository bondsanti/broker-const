<!DOCTYPE html>
<html>
<head>
    <title>Customer SLA Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
        }
        .header {
            background-color: #5558AF; /* Dark blue color */
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .footer {
            background-color: #f55d5d; /* Dark blue color */
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .button {
            background-color: #5558AF; /* Dark blue color */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #40447a; /* A slightly darker blue */
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            แจ้งเตือน
        </div>
        <div class="content">
            <h2>สวัสดี!!</h2>
            <p>รหัสลูกค้า: {{ $customer->cus_no }}</p>
            <p>ลูกค้า: {{ $customer->cus_name }}</p>
            <p>ลักษณะงาน: {{ $customer->notify_ref->name }}</p>
            <p>สถานะงาน: {{ $customer->status }}</p>
            <p>Days passed: {{ $daysDiff }}</p>
            <p>ผู้เกี่ยวข้องโปรดดำเนินการ....</p>
            <hr>
            <h3>Regards,<br>
                Broker-Const. System</h3>
        </div>

    </div>

</body>
</html>
