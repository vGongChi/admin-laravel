<div class="box box-default" style="min-height: 500px;">
    <div class="box-header with-border">
        <h3 class="box-title">新回收订单</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                @foreach($orders as $order)
                <tr>
                    <td style="width: auto">
                        <a href="{{ url('admin/orders/' . $order->id . '/edit') }}">
                            <p>订单号: {{ $order->order_no }}</p>
                            <p>创建时间: {{ $order->created_at }}</p>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>