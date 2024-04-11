<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Phiếu kho</title>
    <style>
    @font-face {
        font-family: 'times new roman';
        font-style: normal;
        font-weight: normal;
        src: url('C:/xampp/htdocs/CaoBacManage/vendor/dompdf/dompdf/lib/fonts/times.ufm') format('truetype');
    }

    body {
        font-family: "dejavu sans"
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 2px;
    }

    th {
        background-color: #f2f2f2;
    }

    .container {
        
    }

    .left-content {
        text-align: left;
    }

    .right-content {
        text-align: center;
    }

    .company-info{
        font-size: 14px;
    }

    .text-title{
        text-align: center;
    }

    .info{
        padding-left: 0;
        padding-right: 0;
        padding-top: 20px;
        line-height: 2;
    }

    .inline-block {
        display: flex;
    }
    .date{
        text-align: right;
        padding-top: 5px;
    }
    

        
    </style>
</head>
<body>
    @php
        class amountInWords
        {
            private $ChuSo = array(" không ", " một ", " hai ", " ba ", " bốn ", " năm ", " sáu ", " bảy ", " tám ", " chín ");
            private $Tien = array("", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");
        
            private function docSo3ChuSo($baso)
            {
                $tram = (int)($baso / 100);
                $chuc = (int)(($baso % 100) / 10);
                $donvi = $baso % 10;
        
                $KetQua = "";
        
                if ($tram == 0 && $chuc == 0 && $donvi == 0) return "";
        
                if ($tram != 0) {
                    $KetQua .= $this->ChuSo[$tram] . " trăm ";
                    if (($chuc == 0) && ($donvi != 0)) $KetQua .= " linh ";
                }
        
                if (($chuc != 0) && ($chuc != 1)) {
                    $KetQua .= $this->ChuSo[$chuc] . " mươi";
                    if (($chuc == 0) && ($donvi != 0)) $KetQua .= " linh ";
                }
        
                if ($chuc == 1) $KetQua .= " mười ";
        
                switch ($donvi) {
                    case 1:
                        if (($chuc != 0) && ($chuc != 1)) {
                            $KetQua .= " mốt ";
                        } else {
                            $KetQua .= $this->ChuSo[$donvi];
                        }
                        break;
                    case 5:
                        if ($chuc == 0) {
                            $KetQua .= $this->ChuSo[$donvi];
                        } else {
                            $KetQua .= " lăm ";
                        }
                        break;
                    default:
                        if ($donvi != 0) {
                            $KetQua .= $this->ChuSo[$donvi];
                        }
                        break;
                }
        
                return $KetQua;
            }
        
            public function doc($SoTien)
            {
                $lan = 0;
                $i = 0;
                $so = 0;
                $KetQua = "";
                $tmp = "";
                $soAm = false;
                $ViTri = array();
        
                if ($SoTien < 0) $soAm = true;
        
                if ($SoTien == 0) return "Không Việt Nam đồng";
        
                if ($SoTien > 8999999999999999) {
                    return "";
                }
        
                $ViTri[5] = floor($SoTien / 1000000000000000);
                if (is_nan($ViTri[5]))
                    $ViTri[5] = "0";
                $SoTien = $SoTien - (int)$ViTri[5] * 1000000000000000;
        
                $ViTri[4] = floor($SoTien / 1000000000000);
                if (is_nan($ViTri[4]))
                    $ViTri[4] = "0";
                $SoTien = $SoTien - (int)$ViTri[4] * 1000000000000;
        
                $ViTri[3] = floor($SoTien / 1000000000);
                if (is_nan($ViTri[3]))
                    $ViTri[3] = "0";
                $SoTien = $SoTien - (int)$ViTri[3] * 1000000000;
        
                $ViTri[2] = (int)($SoTien / 1000000);
                if (is_nan($ViTri[2]))
                    $ViTri[2] = "0";
        
                $ViTri[1] = (int)(($SoTien % 1000000) / 1000);
                if (is_nan($ViTri[1]))
                    $ViTri[1] = "0";
        
                $ViTri[0] = $SoTien % 1000;
                if (is_nan($ViTri[0]))
                    $ViTri[0] = "0";
        
                if ($ViTri[5] > 0) {
                    $lan = 5;
                } else if ($ViTri[4] > 0) {
                    $lan = 4;
                } else if ($ViTri[3] > 0) {
                    $lan = 3;
                } else if ($ViTri[2] > 0) {
                    $lan = 2;
                } else if ($ViTri[1] > 0) {
                    $lan = 1;
                } else {
                    $lan = 0;
                }
        
                for ($i = $lan; $i >= 0; $i--) {
                    $tmp = $this->docSo3ChuSo($ViTri[$i]);
            
                    // Chỉ chuyển đổi chữ cái đầu tiên của chuỗi chữ số
                    $tmp = ucfirst($tmp);
            
                    $KetQua .= $tmp;
                    if ($ViTri[$i] > 0) $KetQua .= $this->Tien[$i];
                    if (($i > 0) && (strlen($tmp) > 0)) $KetQua .= '';
                }
            
                if (substr($KetQua, -1) == ',') {
                    $KetQua = substr($KetQua, 0, -1);
                }
            
                // Giữ nguyên chữ cái đầu tiên của chuỗi chữ số
                $KetQua = ucfirst(substr($KetQua, 1, 2)) . substr($KetQua, 2);
            
                if ($soAm) {
                    return "Âm " . $KetQua . " Việt Nam Đồng";
                } else {
                    $KetQua = substr($KetQua, 0, 1) . substr($KetQua, 2);
                    return $KetQua . " Việt Nam Đồng";
                }
            }
        }
        // Split string into array with "-" sign
        $dateParts = explode('-',  $recievenote->datetime);

        $ngayThangNam = "Ngày " . $dateParts[2] . " tháng " . $dateParts[1] . " năm " . $dateParts[0];

        // Convert string to array using explode() function to separate each value separately
        $perDiscountArray = explode(', ', $recievenote->document_quantity);
        $actualAuantityArray = explode(', ', $recievenote->actual_quantity);
        $priceArray = explode(', ', $recievenote->amountper_product);
        $totalAmount = 0;
    @endphp
        <table class="w-100">
            <tr>
                <td style="border: 0px;">
                    <div class="left-content">
                        CÔNG TY CỔ PHẦN TRANG SỨC LẺ CÁO BẠC
                        <br>
                        Địa chỉ: Số 1 ngõ 121 Chùa Láng, Láng Thượng, Đống Đa, Hà Nội
                    </div>
                </td>
                <td style="border: 0px;">
                    <div class="right-content">
                       <b>Mẫu số: 01 - VT</b>
                       <br>
                        (Ban hành theo Thông tư số 113/2016//TT-BTC
                        <br>
                        Ngày 26/08/2016 của Bộ Tài Chính)
                    </div>
                </td>
            </tr>
        </table>

    <div class="text-title">
        <h2>PHIẾU NHẬP KHO</h2>
        <h4>        
            @php  
            echo $ngayThangNam;
            @endphp
        </h4>
        Số: {{$recievenote->note_id}}
    </div>

    <div class="info">
        Họ và tên người giao: {{$recievenote->deliver_name}}
        <br>
        Theo hoá đơn số {{$recievenote->order_num}} @php  echo lcfirst($ngayThangNam); @endphp {{$recievenote->company_name}}
        <div style="display: flex; justify-content: space-between;">
            Nhập tại kho:{{$recievenote->warehouse}}
            <div>Địa chỉ:...................................................................... </div>
        </div>

        <table>
            <thead>
              <tr class="">
                <th rowspan="2">STT</th>
                <th rowspan="2">Tên sản phẩm</th>
                <th rowspan="2">Mã sản phẩm</th>
                <th colspan="2">Số lượng</th>
                <th rowspan="2">Đơn giá</th>
                <th rowspan="2">Thành tiền</th>
              </tr>
              <tr>
                <th>SL chứng từ</th>
                <th>SL thực nhập</th>
              </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $item)
                <tr>
                    <td style="text-align: left;">{{$index + 1}}</td>
                    <td style="max-width: 250px; text-align: left;" >{{$item->product_name}}</td>
                    <td style="text-align: left;">{{$item->product_id}}</td>
                    <td style="text-align: right;">{{$perDiscountArray[$index]}}</td>
                    <td style="text-align: right;">{{$actualAuantityArray[$index]}}</td>
                    <td style="text-align: right;">{{ number_format($priceArray[$index], 0, ",", ",");}}</td>
                    <td style="text-align: right;">{{ number_format($perDiscountArray[$index] * $priceArray[$index], 0, ",", ",");}}</td>
                </tr>
                @php
                    $totalAmount += $perDiscountArray[$index] * $priceArray[$index];
                @endphp
                @endforeach
            </tbody>
            <tfoot>
              <tr >
                <td colspan="1"></td>
                <td colspan="4"><b>Tổng</b></td>
                <td colspan="2" style="text-align: right;"><b>{{ number_format($totalAmount, 0, ",", ",");}} đồng.</b></td>
              </tr>
            </tfoot>
        </table>

        <span class="inline-block">
            Tổng số tiền bằng chữ:
            <strong><em>                
                @php
                echo (new amountInWords())->doc($totalAmount);
                @endphp</em></strong>
        </span>
        Số chứng từ gốc kèm theo: ..........................................................................................
        
    </div>
    <div class="date">
        @php  
        echo $ngayThangNam;
        @endphp
    </div>

    <table class="w-100">
        <tr>
            <td style="border: 0px;">
                <div class="right-content">
                    <b>Người giao hàng</b>
                    <br>
                    <i>(Ký, họ tên)</i>
                </div>
            </td>
            <td style="border: 0px;">
                <div class="right-content">
                    <b>Kế toán trưởng</b>
                    <br>
                    <i>(Ký, họ tên)</i>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>