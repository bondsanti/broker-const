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



        .button {
            background-color: #5558AF;
            /* Dark blue color */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #40447a;
            /* A slightly darker blue */
        }



     /* เริ่มต้นการสร้างตาราง */
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd; /* เส้นขอบล่าง */
}

th {
  background-color: #f2f2f2; /* สีพื้นหลังสำหรับหัวข้อคอลัมน์ */
  color: #555; /* สีข้อความของหัวข้อคอลัมน์ */
}

tr:hover {
  background-color: #f5f5f5; /* สีพื้นหลังเมื่อนำเม้าส์ไปวางบนแถว */
}
/* สิ้นสุดการสร้างตาราง */

/* สไตล์สำหรับ header ของเอกสาร */
.header {
  background-color: #5558AF; /* สีพื้นหลังสำหรับ header */
  color: #fff; /* สีข้อความของ header */
  padding: 10px;
  text-align: center;
  font-size: 24px;
}

/* สไตล์สำหรับ content ของเอกสาร */
.content {
  padding: 20px;
  text-align: left;
}

/* สไตล์สำหรับ footer ของเอกสาร */
.footer {
  background-color: #f55d5d; /* สีพื้นหลังสำหรับ footer */
  color: #fff; /* สีข้อความของ footer */
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
