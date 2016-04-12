@extends('layouts.admin_app')

@section('content')

    <div id="page-wrapper" style="width: 99%">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Super Mario admin</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- /.panel -->
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-heading">
                        <i class="fa fa-paypal"></i> Transactions
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Items</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $transactions = DB::table('transactions')->orderBy('created_at', 'desc')->get();
                                        $prices = DB::table('objects')->select('price')->get();

                                        $mario = 0;
                                        $mushroom = 0;
                                        $shooting = 0;
                                        $double_jump = 0;
                                        $low_gravity = 0;

                                        ?>
                                        @foreach($transactions as $transaction)
                                            <?php
                                            $items = explode(',', substr($transaction->objects, 1, -1));

                                            sort($items);
                                            $count = 1;
                                            $object = ['Mario', 0, 'Mushrooom', 0, 'Shooting', 0, 'Double Jump', 0, 'Low Gravity', 0];

                                            foreach ($items as $item) {
                                                switch ($item) {
                                                    case 1:
                                                        $object[1]++;
                                                        break;
                                                    case 2:
                                                        $object[3]++;
                                                        break;
                                                    case 3:
                                                        $object[5]++;
                                                        break;
                                                    case 4:
                                                        $object[7]++;
                                                        break;
                                                    case 5:
                                                        $object[9]++;
                                                        break;
                                                }
                                            }
                                            $objects = '';
                                            $total = 0;

                                            if($object[1] > 0) {
                                                $objects .= "Mario: " . $object[1] . ", ";
                                                $total += $prices[0]->price * $object[1];
                                                $mario =+ 1 * $object[1];
                                            }
                                            if($object[3] > 0) {
                                                $objects .= "Mushroom: " . $object[3] . ", ";
                                                $total += $prices[1]->price * $object[3];
                                                $mushroom =+ 1 * $object[3];
                                            }
                                            if($object[5] > 0) {
                                                $objects .= "Shooting: " . $object[5] . ", ";
                                                $total += $prices[2]->price * $object[5];
                                                $shooting =+ 1 * $object[5];
                                            }
                                            if($object[7] > 0) {
                                                $objects .= "Double Jump: " . $object[7] . ", ";
                                                $total += $prices[3]->price * $object[7];
                                                $double_jump =+ 1 * $object[7];
                                            }
                                            if($object[9] > 0) {
                                                $objects .= "Low Gravity: " . $object[9];
                                                $total += $prices[4]->price * $object[9];
                                                $low_gravity =+ 1 * $object[9];
                                            }
                                            $buyer = DB::table('users')->where('id', $transaction->buyer_id)->first()->name;
                                            ?>
                                        <tr>
                                            <td>{{ $transaction->id }}</td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>{{ $buyer }}</td>
                                            <td>{{ $objects }}</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>

                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.row -->
    </div>

@endsection