@extends('layouts.admin_app')

@section('content')

    <div id="page-wrapper" style="width: 99%">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Super Mario admin</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?= DB::table('comments')->count() ?>
                                </div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/forum')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Posts</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= DB::table('transactions')->count() ?></div>
                                <div>Transactions</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/admin/transactions') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
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
                                        <?php
                                        $transactions = DB::table('transactions')->orderBy('created_at', 'desc')->take(10)->get();
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
                                                $mario += 1 * $object[1];
                                            }
                                            if($object[3] > 0) {
                                                $objects .= "Mushroom: " . $object[3] . ", ";
                                                $total += $prices[1]->price * $object[3];
                                                $mushroom += 1 * $object[3];
                                            }
                                            if($object[5] > 0) {
                                                $objects .= "Shooting: " . $object[5] . ", ";
                                                $total += $prices[2]->price * $object[5];
                                                $shooting += 1 * $object[5];
                                            }
                                            if($object[7] > 0) {
                                                $objects .= "Double Jump: " . $object[7] . ", ";
                                                $total += $prices[3]->price * $object[7];
                                                $double_jump += 1 * $object[7];
                                            }
                                            if($object[9] > 0) {
                                                $objects .= "Low Gravity: " . $object[9];
                                                $total += $prices[4]->price * $object[9];
                                                $low_gravity += 1 * $object[9];
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
                    <!-- /.panel-body -->
                    <div class="panel-body">
                        <a href="{{ url('/admin/transactions') }}" class="btn btn-default btn-block">View All Transactions</a>
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-shopping-cart fa-fw"></i> Sales by Power Up
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="{{ url('/shop') }}" class="list-group-item">
                                <i></i> Mario
                                    <span class="pull-right text-muted small"><em>{{ $mario }}</em>
                                    </span>
                            </a>
                            <a href="{{ url('/shop') }}" class="list-group-item">
                                <i></i> Mushroom
                                    <span class="pull-right text-muted small"><em>{{ $mushroom }}</em>
                                    </span>
                            </a>
                            <a href="{{ url('/shop') }}" class="list-group-item">
                                <i></i> Shooting
                                    <span class="pull-right text-muted small"><em>{{ $shooting }}</em>
                                    </span>
                            </a>
                            <a href="{{ url('/shop') }}" class="list-group-item">
                                <i></i> Double Jump
                                    <span class="pull-right text-muted small"><em>{{ $double_jump }}</em>
                                    </span>
                            </a>
                            <a href="{{ url('/shop') }}" class="list-group-item">
                                <i></i> Low Gravity
                                    <span class="pull-right text-muted small"><em>{{ $low_gravity }}</em>
                                    </span>
                            </a>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>

@endsection