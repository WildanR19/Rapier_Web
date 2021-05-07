@extends('layout.dash')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('admin.attendance.filter_tab')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table width="100%" border="0">
                                <tr>
                                    <td width="40%">
                                <select class="form-control" id="f_bulan" name="f_bulan">
                                <?php
                                for($i=1;$i<=12;$i++){
                                    if($i == 1){
                                       $i_name = "Januari";
                                    }elseif($i == 2){
                                       $i_name = "Februari";
                                    }elseif($i == 3){
                                       $i_name = "Maret";
                                    }elseif($i == 4){
                                       $i_name = "April";
                                    }elseif($i == 5){
                                       $i_name = "Mei";
                                    }elseif($i == 6){
                                       $i_name = "Juni";
                                    }elseif($i == 7){
                                       $i_name = "Juli";
                                    }elseif($i == 8){
                                       $i_name = "Agustus";
                                    }elseif($i == 9){
                                       $i_name = "September";
                                    }elseif($i == 10){
                                       $i_name = "Oktober";
                                    }elseif($i == 11){
                                       $i_name = "November";
                                    }else{
                                       $i_name = "Desember";
                                    }
                                    $selected = ($i == date('m')) ? 'selected' : '';
                                  echo"
                                <option value='".$i."' ".$selected.">".$i_name."</option>";
                                }?>
                                </select>
                                </td>
                                    <td width="40%">
                                       <select class="form-control" id="f_tahun" name="f_tahun">
                                {{-- <option value="2020" selected>2020</option>
                                <option value="2021">2021</option> --}}
                                           @foreach ($years as $y)
                                              <option value="{{$y}}" @if ($y == date("Y")) selected="" @endif >{{ $y }}</option>
                                           @endforeach
                                        </select>
                                     </td>
                                <td width="20%"><a href="#!" class="btn btn-primary" onclick="filter_tabel()"><i class="fa fa-search"></i> Search</a>
                                </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive mt-3" id="tmpAjax">
                                <table id="empTable" class="table table-bordered table-striped table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <?php
                                            $bulan = request()->segment(3);
                                            $tahun = request()->segment(4);
                                            $d = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
                                            for($i=1;$i<=$d;$i++){
                                                ?>
                                            <th><?php echo $i;?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $datas !!}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function filter_tabel(){
        $('#tmpAjax').html("Mohon Tunggu ...");
        var f_bulan = $('#f_bulan').val();
        var f_tahun = $('#f_tahun').val();
        var token = '{{ csrf_token() }}';
        $.ajax({
                type: 'POST',
                data: 'f_bulan='+f_bulan+'&f_tahun='+f_tahun,
                url: '{{route("admin.attendance.filter")}}',
                headers: {'X-CSRF-TOKEN': token},
                success: function(response) {
                  $('#tmpAjax').html(response);

            }
          }); 
    }
    //datatable
    $(function () {
        $('#empTable').DataTable({
            "ordering": false,
            "info": false,
            "responsive": true,
        });
    });
</script>
@endsection