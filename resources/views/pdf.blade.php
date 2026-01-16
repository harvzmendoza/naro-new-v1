<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
    <style>
        body { 
            font-family: Calibri, sans-serif; 
        }
        .invoice-details { width: 100%; margin-bottom: 8px; }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th, .items-table td { border: .01px solid; padding-left: 4px; padding-right: 4px;}
        th, td {
            text-align:center;
            font-size: 12px;
            padding: 20px;
        }
        .bulletin-title { text-align: center; padding: 20px; margin-bottom: 20px; margin-top: 20px;  font-size: 14px; background-color: maroon; color: white; }
        .bulletin-header { text-align: center; padding: 15px; margin-bottom: 10px;  background-color: maroon; color: white; }

        .column {
        float: left;
        padding: 10px;
        }

        .left {
        font-family:Palatino Linotype;
        width: 30%;
        font-size: 30px;
        border-bottom: 10px solid white;
        }

        .right {
        width: 70%;
        font-size: 15px;
        }

        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        .text-danger {
            color:rgb(255, 17, 17); /* This is the green color */
        }
    </style>
</head>
<body>
    <div class="invoice-details">
        <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(asset('images/header-new-onar1.png')))}}" alt="ONAR Logo" style="width: 100%; height: auto;">
        <div class="row bulletin-header">
            <div class="column left">
                @php
                    $string = $bulletin->volume_name;
                    $words = explode(' ', $string);
                    $secondWord = $words[1] ?? ''; 
                @endphp
                <label>Vol. {{$secondWord}} No. {{$bulletin->book_name}}</label>
           </div>
            <div class="column right">
                <label>Weekly Update of Rules and Regulations filed with the <br>Office of the National Administrative Register (ONAR)</label>
            </div>
        </div>
        <div class="bulletin-title">
            <label>Issuances Filed with ONAR <br>
            {{date('j F Y', strtotime($bulletin->issuance_from))}} to {{date('j F Y', strtotime($bulletin->issuance_to))}}
            </label> 
        </div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Agency</th>
                    <th>Date Filed</th>
                    <th>Reg No.</th>
                    <th>Subject No.</th>
                    <th width="40%">Subject Title</th>
                    <th>Date Adopted</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                <tr>
                    <td><b>{{$document->agency->name ?? ''}}</b></td>
                    <td>{{ $document->date_filed ? date('M j, Y', strtotime($document->date_filed)) : '-' }}</td>
                    <td>{{$document->onar_no}}</td>
                    <td>{{$document->issuance_no}}</td>
                    <td>
                    @if(auth()->check() && auth()->user()->role == 'ADMIN')
                        @if($document->file == NULL)
                            <a href='{{ url("/admin/documents/$document->id/edit/") }}' class="text-danger" target="_blank">{{$document->title}}</a>
                        @else
                            <a href="{{ url('storage/' . $document->file) }}" target="_blank">{{$document->title}}</a>
                        @endif
                    @else
                        <a href="{{ url('storage/' . $document->file) }}" target="_blank">{{$document->title}}</a>
                    @endif

                    </td>
                    <td>{{ $document->doc_date ? date('M j, Y', strtotime($document->doc_date)) : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="bulletin-title">
            <label>
            OFFICE OF THE NATIONAL ADMINISTRATIVE REGISTER <br>
            Bocobo Hall, University of the Philippines Law Complex,<br>
            Diliman, Quezon City<br>
            Tel. No. 89205514 loc. 211; Email: onar_law.upd@up.edu.ph<br>
            </label>
        </div>
    </div>
</body>
</html>
