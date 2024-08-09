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
            margin: 15px auto;
            padding: 10px;
            background: #fff;
        }



        .button {
            background-color: #5558AF;

            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #40447a;

        }

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  font-size: 14px;
}

th {
  background-color: #f2f2f2;
  color: #555;
}

tr:hover {
  background-color: #f5f5f5;
}

.header {
  background-color: #5558AF;
  color: #fff;
  padding: 5px;
  text-align: center;
  font-size: 24px;
}


.content {
  padding: 5px;
  text-align: left;
}

.footer {
  background-color: #f55d5d;
  color: #fff;
  padding: 10px;
  text-align: center;
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
            <table>
                <thead>
                    <tr>
                        <th>รหัสลูกค้า</th>
                        <th>ลูกค้า</th>
                        <th>ลักษณะงาน</th>
                        <th>สถานะงาน</th>
                        <th>Days passed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customersData as $data)
                        <tr>
                            <td>{{ $data['customer']->cus_no }}</td>
                            <td>{{ $data['customer']->cus_name }}</td>
                            <td>{{ $data['customer']->notify_ref->name }}</td>
                            <td>{{ $data['customer']->status }}</td>
                            <td>{{ $data['daysDiff'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>ผู้เกี่ยวข้องโปรดดำเนินการ....</p>
            <hr>
            <p>Regards,<br>
                Broker-Const. System</p>
        </div>
    </div>
</body>

</html>
